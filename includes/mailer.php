<?php
/**
 * Outgoing mail.
 *
 * A small SMTP client built on PHP stream functions, so it also works on
 * hosts without the sockets extension. It supports implicit TLS (port 465)
 * and STARTTLS (port 587), which is what Gmail needs.
 *
 * Every mail the site sends (contact form, comments, newsletter) goes through
 * mail_send() so the From address and the transport stay in one place.
 */

require_once __DIR__ . '/config.php';

/** Delivery result of the last mail_send() call. */
$GLOBALS['mail_last_error'] = '';

/**
 * Reads one SMTP reply, joining the continuation lines of a multi-line reply.
 *
 * @param  resource $socket
 * @return string   the raw reply, e.g. "250 OK"
 */
function smtp_read_reply($socket)
{
    $reply = '';

    while (true) {
        $line = fgets($socket, 515);

        if ($line === false) {
            throw new RuntimeException('SMTP connection closed while waiting for a reply.');
        }

        $reply .= $line;

        // A reply ends with "250 " (space). "250-" means more lines follow.
        if (strlen($line) < 4 || $line[3] !== '-') {
            break;
        }
    }

    return $reply;
}
/**
 * Sends a command and checks the reply code.
 *
 * @param  resource $socket
 * @param  string   $command
 * @param  array    $expected  accepted reply codes.
 * @param  string   $label     name shown in the error message, for commands
 *                             that carry a secret.
 * @return string   the raw reply.
 */
function smtp_command($socket, $command, $expected, $label = '')
{
    if (fwrite($socket, $command . "\r\n") === false) {
        throw new RuntimeException('Could not write to the SMTP connection.');
    }

    $reply  = smtp_read_reply($socket);
    $code   = (int) substr($reply, 0, 3);
    $wanted = (array) $expected;

    if (!in_array($code, $wanted, true)) {
        $name = ($label !== '') ? $label : $command;
        throw new RuntimeException('SMTP rejected "' . $name . '" with: ' . trim($reply));
    }

    return $reply;
}

/**
 * Reads a reply and checks its code.
 *
 * @param  resource $socket
 * @param  array    $expected  accepted reply codes.
 * @return string   the raw reply.
 */
function smtp_expect($socket, $expected)
{
    $reply  = smtp_read_reply($socket);
    $code   = (int) substr($reply, 0, 3);
    $wanted = (array) $expected;

    if (!in_array($code, $wanted, true)) {
        throw new RuntimeException('SMTP server replied: ' . trim($reply));
    }

    return $reply;
}

/**
 * Writes the whole string to the socket, even when it is larger than one write.
 */
function smtp_write($socket, $data)
{
    $length = strlen($data);
    $sent   = 0;

    while ($sent < $length) {
        $written = @fwrite($socket, substr($data, $sent));

        if ($written === false || $written === 0) {
            throw new RuntimeException('Could not write to the SMTP connection.');
        }

        $sent += $written;
    }
}

/**
 * Returns the SMTP password.
 *
 * The password is looked up in this order: the MAIL_SMTP_PASS environment
 * variable, the MAIL_SMTP_PASS constant in config.php, and the gitignored
 * includes/.mail-pass file. The first one that is filled wins, so the app
 * password never has to be committed to the repository.
 */
function mail_smtp_password()
{
    $fromEnv = getenv('MAIL_SMTP_PASS');

    if (is_string($fromEnv) && trim($fromEnv) !== '') {
        return trim($fromEnv);
    }

    $fromConfig = (string) MAIL_SMTP_PASS;

    if (trim($fromConfig) !== '') {
        return trim($fromConfig);
    }

    $fromFile = __DIR__ . '/.mail-pass';

    if (is_file($fromFile) && is_readable($fromFile)) {
        $lines = preg_split('/\R/', (string) @file_get_contents($fromFile));

        foreach ($lines as $line) {
            $line = trim($line);

            // Comment lines are ignored, so the file can carry a note.
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }

            return $line;
        }
    }

    return '';
}

/**
 * Opens an SMTP connection and authenticates.
 *
 * @return resource the open socket.
 */
function smtp_connect()
{
    $host   = MAIL_SMTP_HOST;
    $port   = (int) MAIL_SMTP_PORT;
    $secure = MAIL_SMTP_SECURE;

    $context = stream_context_create(array(
        'ssl' => array(
            'verify_peer'       => (bool) MAIL_SMTP_VERIFY_PEER,
            'verify_peer_name'  => (bool) MAIL_SMTP_VERIFY_PEER,
            'allow_self_signed' => !MAIL_SMTP_VERIFY_PEER,
            'peer_name'         => $host,
            'crypto_method'     => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
        ),
    ));

    $remote = ($secure === 'ssl' ? 'ssl://' : 'tcp://') . $host . ':' . $port;

    $errno  = 0;
    $errstr = '';
    $socket = @stream_socket_client($remote, $errno, $errstr, 20, STREAM_CLIENT_CONNECT, $context);

    if ($socket === false) {
        throw new RuntimeException('Could not connect to the mail server (' . $remote . '): ' . $errstr . ' (' . $errno . ')');
    }

    stream_set_timeout($socket, 20);

    smtp_read_reply($socket);

    $hostname = gethostname() ? gethostname() : 'localhost';

    smtp_command($socket, 'EHLO ' . $hostname, array(250));

    // STARTTLS is only used on the plain connection (port 587).
    if ($secure === 'tls') {
        smtp_command($socket, 'STARTTLS', array(220));

        $crypto = @stream_socket_enable_crypto(
            $socket,
            true,
            STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT
        );

        if ($crypto !== true) {
            throw new RuntimeException('Could not start TLS on the mail server connection.');
        }

        smtp_command($socket, 'EHLO ' . $hostname, array(250));
    }

    if (MAIL_SMTP_AUTH) {
        if (mail_smtp_password() === '') {
            throw new RuntimeException('No mail password is configured. Put a Google App Password in includes/.mail-pass or in MAIL_SMTP_PASS in includes/config.php.');
        }

        smtp_command($socket, 'AUTH LOGIN', array(334), 'AUTH LOGIN');
        smtp_command($socket, base64_encode(MAIL_SMTP_USER), array(334), 'AUTH username');
        smtp_command($socket, base64_encode(mail_smtp_password()), array(235), 'AUTH password');
    }

    return $socket;
}

/**
 * Encodes a header value that contains non-ASCII characters.
 */
function mail_encode_header($value)
{
    if (preg_match('/^[\x20-\x7E]*$/', $value)) {
        return $value;
    }

    return '=?UTF-8?B?' . base64_encode($value) . '?=';
}

/**
 * Escapes a local part for the SMTP envelope (no quoting characters).
 */
function mail_clean_address($address)
{
    $address = trim((string) $address);
    $address = str_replace(array("\r", "\n", '<', '>'), '', $address);

    return $address;
}

/**
 * Builds the raw MIME message.
 *
 * @param array $headers  extra headers, e.g. 'Reply-To' => '...'.
 * @param string $html    HTML body.
 * @param string $text    plain-text alternative.
 */
function mail_build_message($to, $subject, $html, $text, $headers)
{
    $boundary = 'b' . bin2hex(random_bytes(12));

    $lines = array(
        'Date: ' . date('r'),
        'From: ' . mail_encode_header(MAIL_FROM_NAME) . ' <' . mail_clean_address(MAIL_FROM_ADDRESS) . '>',
        'To: ' . mail_clean_address($to),
        'Subject: ' . mail_encode_header($subject),
        'Message-ID: <' . bin2hex(random_bytes(12)) . '@' . preg_replace('/[^a-z0-9.-]/i', '', MAIL_SMTP_HOST) . '>',
        'MIME-Version: 1.0',
    );

    foreach ($headers as $name => $value) {
        $lines[] = $name . ': ' . $value;
    }

    $lines[] = 'Content-Type: multipart/alternative; boundary="' . $boundary . '"';
    $lines[] = '';

    $lines[] = '--' . $boundary;
    $lines[] = 'Content-Type: text/plain; charset=UTF-8';
    $lines[] = 'Content-Transfer-Encoding: base64';
    $lines[] = '';
    $lines[] = chunk_split(base64_encode($text));

    $lines[] = '--' . $boundary;
    $lines[] = 'Content-Type: text/html; charset=UTF-8';
    $lines[] = 'Content-Transfer-Encoding: base64';
    $lines[] = '';
    $lines[] = chunk_split(base64_encode($html));

    $lines[] = '--' . $boundary . '--';

    return implode("\r\n", $lines);
}

/**
 * Sends a mail through the configured transport.
 *
 * @param string      $to       recipient address.
 * @param string      $subject  subject line.
 * @param string      $html     HTML body.
 * @param string|null $replyTo  address replies should be sent to.
 * @param string|null $text     plain-text body; derived from $html when omitted.
 * @return bool        true when the mail was handed over to the transport.
 */
function mail_send($to, $subject, $html, $replyTo = null, $text = null)
{
    $GLOBALS['mail_last_error'] = '';

    if ($text === null) {
        $text = trim(preg_replace('/\s+/', ' ', strip_tags($html)));
    }

    $headers = array();
    if (!empty($replyTo)) {
        $headers['Reply-To'] = mail_clean_address($replyTo);
    }

    if (MAIL_TRANSPORT === 'mail') {
        $plainHeaders = array(
            'From: ' . MAIL_FROM_NAME . ' <' . MAIL_FROM_ADDRESS . '>',
            'Content-Type: text/plain; charset=UTF-8',
        );
        foreach ($headers as $name => $value) {
            $plainHeaders[] = $name . ': ' . $value;
        }

        $sent = @mail($to, $subject, $text, implode("\r\n", $plainHeaders));

        if (!$sent) {
            $GLOBALS['mail_last_error'] = 'PHP mail() could not hand the message to a transport.';
        }

        return (bool) $sent;
    }

    $socket = null;

    try {
        $socket = smtp_connect();

        smtp_command($socket, 'MAIL FROM:<' . mail_clean_address(MAIL_FROM_ADDRESS) . '>', array(250));
        smtp_command($socket, 'RCPT TO:<' . mail_clean_address($to) . '>', array(250, 251));
        smtp_command($socket, 'DATA', array(354));

        $message = mail_build_message($to, $subject, $html, $text, $headers);

        // A line that starts with a dot must be escaped, and the message ends
        // with a single dot on its own line.
        $message = preg_replace('/^\./m', '..', $message);

        smtp_write($socket, $message . "\r\n.\r\n");

        smtp_expect($socket, array(250));

        smtp_command($socket, 'QUIT', array(221));

        fclose($socket);
        $socket = null;

        return true;
    } catch (Exception $e) {
        $GLOBALS['mail_last_error'] = $e->getMessage();
    }

    if (is_resource($socket)) {
        @fclose($socket);
    }

    return false;
}
