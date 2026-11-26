<?php
/**
 * Newsletter subscription handler (footer form).
 * Validates the address, appends it to a local log and mails the site owner.
 */
require_once __DIR__ . '/includes/form-security.php';
require_once __DIR__ . '/includes/mailer.php';

$errors = array();
$email = '';
$deliveryFailed = false;

// Only an actual submission is processed. A plain GET (crawler, bookmark,
// reload after a redirect) must never be logged as a subscription.
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim((string) $_POST['email']) : '';
    $honeypot = isset($_POST['website']) ? trim((string) $_POST['website']) : '';

    if (!csrf_verify()) {
        $errors[] = 'Your session expired. Please reload the page and try again.';
    } elseif ($honeypot !== '') {
        $errors[] = 'Your subscription could not be processed.';
    } elseif ($email === '') {
        $errors[] = 'Please enter your email address.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    } elseif (mb_strlen($email) > 190) {
        $errors[] = 'Email address is too long.';
    }

    if (empty($errors)) {
        // Archive the address first so a working mail transport is not a
        // prerequisite for keeping the subscription.
        $logFile = __DIR__ . '/assets/storage/subscribers.log';
        @file_put_contents($logFile, gmdate('Y-m-d H:i:s') . "\t" . $email . "\n", FILE_APPEND | LOCK_EX);

        $subject = '[' . SITE_NAME . '] New subscriber';

        $text = 'A new subscriber signed up for the ' . SITE_NAME . " digest.\n\n"
            . 'Email: ' . $email . "\n"
            . 'Signed up: ' . date('Y-m-d H:i:s') . "\n";

        $html = '<p><strong>New subscriber</strong> for the ' . htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') . ' digest.</p>'
            . '<p><strong>Email:</strong> <a href="mailto:' . rawurlencode($email) . '">' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</a></p>'
            . '<p style="color:#777;font-size:12px;">Signed up: ' . date('Y-m-d H:i:s') . '</p>';

        if (mail_send(MAIL_TO_ADDRESS, $subject, $html, $email, $text)) {
            redirect_to('index.php?subscribed=1#newsletter');
        }

        // Saved to the local list, but the mail had no transport. Say so rather
        // than claiming the notification went out.
        $deliveryFailed = true;
    }

    if (empty($errors)) {
        redirect_to('index.php?subscribed=saved#newsletter');
    }
} else {
    redirect_to('index.php#newsletter');
}

$_SESSION['newsletter_errors'] = $errors;
if ($deliveryFailed) {
    $_SESSION['newsletter_saved'] = true;
}
redirect_to('index.php#newsletter');
