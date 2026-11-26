<?php
/**
 * Comment handler.
 *
 * Validates and archives comments to a protected local log. There is no CMS
 * behind this site, so accepted comments are stored for manual publication.
 */

require_once __DIR__ . '/form-security.php';
require_once __DIR__ . '/mailer.php';

const COMMENT_LOG = __DIR__ . '/../assets/storage/comments.log';

/**
 * Processes a comment submission. Safe to call when no POST arrived.
 *
 * @return bool true when a comment was accepted.
 */
function handle_comment_submission()
{
    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        return false;
    }
    if (!isset($_POST['form_type']) || $_POST['form_type'] !== 'comment') {
        return false;
    }

    $data = array(
        'username' => isset($_POST['username']) ? trim((string) $_POST['username']) : '',
        'email'    => isset($_POST['email']) ? trim((string) $_POST['email']) : '',
        'message'  => isset($_POST['message']) ? trim((string) $_POST['message']) : '',
    );
    $honeypot = isset($_POST['website']) ? trim((string) $_POST['website']) : '';

    $errors = array();

    if (!csrf_verify()) {
        $errors['form'] = 'Your session expired. Please reload the page and try again.';
    } elseif ($honeypot !== '') {
        $errors['form'] = 'Your comment could not be processed.';
    }
    if (!isset($errors['form'])) {
        if ($data['username'] === '' || mb_strlen($data['username']) < 2) {
            $errors['username'] = 'Please enter your name.';
        } elseif (mb_strlen($data['username']) > 80) {
            $errors['username'] = 'Name is too long.';
        }
        if ($data['email'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        if ($data['message'] === '' || mb_strlen($data['message']) < 5) {
            $errors['message'] = 'Please write a comment of at least 5 characters.';
        } elseif (mb_strlen($data['message']) > 4000) {
            $errors['message'] = 'Comment is too long.';
        }
    }

    if (!empty($errors)) {
        $_SESSION['comment_errors'] = $errors;
        $_SESSION['comment_data'] = $data;
        return false;
    }

    $line = implode("\t", array(
        gmdate('Y-m-d H:i:s'),
        str_replace(array("\r", "\n", "\t"), ' ', $data['username']),
        str_replace(array("\r", "\n", "\t"), ' ', $data['email']),
        str_replace(array("\r", "\n", "\t"), ' ', $data['message']),
        isset($_SERVER['HTTP_REFERER']) ? substr((string) $_SERVER['HTTP_REFERER'], 0, 200) : '',
    ));

    @file_put_contents(COMMENT_LOG, $line . "\n", FILE_APPEND | LOCK_EX);

    $text = 'A new comment was posted on ' . SITE_NAME . ".\n\n"
        . 'Name:    ' . $data['username'] . "\n"
        . 'Email:   ' . $data['email'] . "\n"
        . 'Message: ' . $data['message'] . "\n";

    $html = '<p><strong>A new comment was posted on ' . htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') . '.</strong></p>'
        . '<p><strong>Name:</strong> ' . htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8') . '<br>'
        . '<strong>Email:</strong> <a href="mailto:' . rawurlencode($data['email']) . '">' . htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') . '</a><br>'
        . '<strong>Message:</strong><br>' . nl2br(htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8')) . '</p>';

    mail_send(MAIL_TO_ADDRESS, '[' . SITE_NAME . '] New comment', $html, $data['email'], $text);

    $_SESSION['comment_sent'] = true;
    return true;
}
