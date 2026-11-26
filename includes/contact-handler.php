<?php
/**
 * Reusable contact form processing.
 *
 * Include this file at the top of any page that should handle a contact
 * submission, then render components/contact-form.php (or your own markup)
 * inside the layout. Validation and email delivery are handled here so both
 * stay in one place.
 *
 * A submission is answered with a redirect back to the page the form is on,
 * so a page refresh never sends the same message twice.
 */

require_once __DIR__ . '/form-security.php';
require_once __DIR__ . '/mailer.php';

$contactErrors = array();
$contactData = array(
    'username' => '',
    'email'    => '',
    'phone'    => '',
    'topic'    => '',
    'message'  => '',
);

/** True once a message has been accepted. Delivery problems set $contactDeliveryFailed. */
$contactSent = false;

/** Set when validation passed but the message could not be delivered. */
$contactDeliveryFailed = false;

/** Subjects the visitor can pick on the contact form. */
$contactServices = array(
    'General Enquiry',
    'Article Correction',
    'Guest Post Proposal',
    'Sponsorship',
    'Technical Question',
);

/** The page the visitor came from, used to send them back after a submit. */
$contactReturn = isset($_POST['form_return']) ? (string) $_POST['form_return'] : '';

/**
 * Returns the URL the visitor is sent back to after a submission.
 */
function contact_return_url()
{
    global $contactReturn;

    if (preg_match('/^[a-zA-Z0-9_-]+\.php$/', (string) $contactReturn)) {
        return $contactReturn . '#contact-form';
    }

    return form_action() . '#contact-form';
}

/**
 * Prints the status messages of the last submission.
 */
function render_contact_status()
{
    global $contactErrors, $contactSent, $contactDeliveryFailed;

    if (!empty($contactErrors['form'])) {
        echo '<div class="alert alert-danger" role="alert">'
            . htmlspecialchars($contactErrors['form'], ENT_QUOTES, 'UTF-8') . '</div>';
    }

    if (!empty($contactDeliveryFailed)) {
        echo '<div class="alert alert-warning" role="alert">Thank you. Your message was received and saved, but the email could not be sent. Please write to us at '
            . htmlspecialchars(MAIL_TO_ADDRESS, ENT_QUOTES, 'UTF-8') . '.</div>';
    } elseif (!empty($contactSent)) {
        echo '<div class="alert alert-success" role="alert">Thank you. Your message has been sent successfully.</div>';
    }
}

/* Results of a submission that was posted back to this page. */

if (!empty($_SESSION['contact_errors'])) {
    $contactErrors = $_SESSION['contact_errors'];
    unset($_SESSION['contact_errors']);
}

if (!empty($_SESSION['contact_data'])) {
    $contactData = $_SESSION['contact_data'];
    unset($_SESSION['contact_data']);
}

if (!empty($_SESSION['contact_status'])) {
    $contactSent           = ($_SESSION['contact_status'] === 'sent');
    $contactDeliveryFailed = ($_SESSION['contact_status'] === 'failed');
    unset($_SESSION['contact_status']);
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['form_type']) && $_POST['form_type'] === 'contact') {

    $contactData = array(
        'username' => isset($_POST['username']) ? trim((string) $_POST['username']) : '',
        'email'    => isset($_POST['email']) ? trim((string) $_POST['email']) : '',
        'phone'    => isset($_POST['phone']) ? trim((string) $_POST['phone']) : '',
        'topic'    => isset($_POST['topic']) ? trim((string) $_POST['topic']) : '',
        'message'  => isset($_POST['message']) ? trim((string) $_POST['message']) : '',
    );

    // Honeypot: real users never fill this hidden field.
    $honeypot = isset($_POST['website']) ? trim((string) $_POST['website']) : '';

    if (!csrf_verify()) {
        $contactErrors['form'] = 'Your session expired. Please reload the page and try again.';
    } elseif ($honeypot !== '') {
        $contactErrors['form'] = 'Your submission could not be processed.';
    }

    if ($honeypot === '') {
        if ($contactData['username'] === '') {
            $contactErrors['username'] = 'Please enter your name.';
        } elseif (mb_strlen($contactData['username']) > 100) {
            $contactErrors['username'] = 'Name must be 100 characters or fewer.';
        }

        if ($contactData['email'] === '') {
            $contactErrors['email'] = 'Please enter your email address.';
        } elseif (!filter_var($contactData['email'], FILTER_VALIDATE_EMAIL)) {
            $contactErrors['email'] = 'Please enter a valid email address.';
        } elseif (mb_strlen($contactData['email']) > 190) {
            $contactErrors['email'] = 'Email address is too long.';
        }

        if ($contactData['phone'] !== '' && !preg_match('/^[0-9\s()+\-]{6,30}$/', $contactData['phone'])) {
            $contactErrors['phone'] = 'Please enter a valid phone number.';
        }

        if ($contactData['topic'] === '') {
            $contactErrors['topic'] = 'Please choose a topic.';
        } elseif (!in_array($contactData['topic'], $contactServices, true)) {
            $contactErrors['topic'] = 'Please select a valid topic.';
        }

        if ($contactData['message'] === '') {
            $contactErrors['message'] = 'Please enter a message.';
        } elseif (mb_strlen($contactData['message']) < 10) {
            $contactErrors['message'] = 'Please enter at least 10 characters.';
        } elseif (mb_strlen($contactData['message']) > 5000) {
            $contactErrors['message'] = 'Message must be 5000 characters or fewer.';
        }
    }

    if (!empty($contactErrors)) {
        // Keep what was typed so the visitor does not have to enter it again.
        $_SESSION['contact_errors'] = $contactErrors;
        $_SESSION['contact_data']   = $contactData;
        redirect_to(contact_return_url());
    }

    // Archive every accepted enquiry so nothing is lost if the mail server is
    // unreachable at that moment.
    $logFile = __DIR__ . '/../assets/storage/enquiries.log';
    @file_put_contents(
        $logFile,
        "---- " . gmdate('Y-m-d H:i:s') . " ----\n"
        . 'Name:    ' . $contactData['username'] . "\n"
        . 'Email:   ' . $contactData['email'] . "\n"
        . 'Phone:   ' . $contactData['phone'] . "\n"
        . 'Subject: ' . $contactData['topic'] . "\n"
        . 'Message: ' . $contactData['message'] . "\n\n"
        . 'Submitted: ' . date('Y-m-d H:i:s') . "\n\n"
        . 'Archive timestamp: ' . gmdate('Y-m-d H:i:s') . "\n",
        FILE_APPEND | LOCK_EX
    );

    // Also store in the CMS messages file so the admin panel can display it.
    $messagesPath = __DIR__ . '/../storage/messages.json';
    $messages = array();
    if (is_file($messagesPath)) {
        $existing = json_decode((string) @file_get_contents($messagesPath), true);
        if (is_array($existing)) {
            $messages = $existing;
        }
    }
    $messages[] = array(
        'id'          => bin2hex(random_bytes(8)),
        'name'        => $contactData['username'],
        'email'       => $contactData['email'],
        'phone'       => $contactData['phone'],
        'topic'       => $contactData['topic'],
        'message'     => $contactData['message'],
        'status'      => 'new',
        'created_at'  => gmdate('Y-m-d H:i:s'),
        'ip_address'  => isset($_SERVER['REMOTE_ADDR']) ? (string) $_SERVER['REMOTE_ADDR'] : '',
        'user_agent'  => isset($_SERVER['HTTP_USER_AGENT']) ? (string) $_SERVER['HTTP_USER_AGENT'] : '',
    );
    $messages = array_slice($messages, -500);
    $dir = dirname($messagesPath);
    if (!is_dir($dir) && !@mkdir($dir, 0755, true)) {
        // continue; mail still attempted below
    } else {
        @file_put_contents($messagesPath, json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), LOCK_EX);
    }

    $subject = '[' . SITE_NAME . '] Enquiry from ' . $contactData['username'];

    $text = "New enquiry received from the website contact form.\n\n"
        . 'Name:    ' . $contactData['username'] . "\n"
        . 'Email:   ' . $contactData['email'] . "\n"
        . 'Phone:   ' . $contactData['phone'] . "\n"
        . 'Subject: ' . $contactData['topic'] . "\n"
        . 'Message: ' . $contactData['message'] . "\n\n"
        . 'Submitted: ' . date('Y-m-d H:i:s') . "\n";

    $html = '<p><strong>New enquiry received from the website contact form.</strong></p>'
        . '<table cellpadding="6" cellspacing="0" border="0" style="font-family:Arial,sans-serif;font-size:14px;border-collapse:collapse;">'
        . '<tr><td style="border-bottom:1px solid #eee;"><strong>Name</strong></td><td style="border-bottom:1px solid #eee;">' . nl2br(htmlspecialchars($contactData['username'], ENT_QUOTES, 'UTF-8')) . '</td></tr>'
        . '<tr><td style="border-bottom:1px solid #eee;"><strong>Email</strong></td><td style="border-bottom:1px solid #eee;"><a href="mailto:' . rawurlencode($contactData['email']) . '">' . htmlspecialchars($contactData['email'], ENT_QUOTES, 'UTF-8') . '</a></td></tr>'
        . '<tr><td style="border-bottom:1px solid #eee;"><strong>Phone</strong></td><td style="border-bottom:1px solid #eee;">' . htmlspecialchars($contactData['phone'], ENT_QUOTES, 'UTF-8') . '</td></tr>'
        . '<tr><td style="border-bottom:1px solid #eee;"><strong>Subject</strong></td><td style="border-bottom:1px solid #eee;">' . nl2br(htmlspecialchars($contactData['topic'], ENT_QUOTES, 'UTF-8')) . '</td></tr>'
        . '<tr><td><strong>Message</strong></td><td>' . nl2br(htmlspecialchars($contactData['message'], ENT_QUOTES, 'UTF-8')) . '</td></tr>'
        . '</table>'
        . '<p style="color:#777;font-size:12px;">Submitted: ' . date('Y-m-d H:i:s') . '</p>';

    // Replies go straight back to the visitor, the mail itself comes from the
    // site address configured in config.php.
    if (mail_send(MAIL_TO_ADDRESS, $subject, $html, $contactData['email'], $text)) {
        $_SESSION['contact_status'] = 'sent';
    } else {
        // The enquiry is archived, but the mail could not be handed to a
        // transport. Say so rather than claiming success.
        $_SESSION['contact_status'] = 'failed';
    }

    redirect_to(contact_return_url());
}
