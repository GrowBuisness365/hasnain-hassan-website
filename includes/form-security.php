<?php
/**
 * Session bootstrap, CSRF tokens and form helpers.
 */

// Buffer the output from the very first line of the request. The session
// cookie and the redirect headers below are then always sendable, even when a
// page prints something before this file is included.
@ob_start();

if (session_status() === PHP_SESSION_NONE) {
    if (!headers_sent()) {
        @session_start();
    }
}

require_once __DIR__ . '/config.php';

const CSRF_FIELD      = 'csrf_token';
const CSRF_SESSION_KEY = 'csrf_token';
const FORM_TTL_SECONDS = 7200;

/**
 * Returns the URL a form on the current page should post back to.
 *
 * The pretty URLs (/contact) are turned into the matching file (/contact.php),
 * so the form works the same on the local Apache setup and on a host that
 * routes every request through a front controller.
 */
function form_action()
{
    $uri  = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $path = parse_url($uri, PHP_URL_PATH);

    if (!is_string($path) || $path === '') {
        return '';
    }

    $path = str_replace('\\', '/', $path);
    $dir  = rtrim(dirname($path), '/');
    $file = basename($path);

    if (substr($file, -4) !== '.php') {
        $file .= '.php';
    }

    if ($dir === '' || $dir === '.') {
        return $file;
    }

    return $dir . '/' . $file;
}

/** Returns the current CSRF token, generating one if needed. */
function csrf_token()
{
    if (empty($_SESSION[CSRF_SESSION_KEY])) {
        $_SESSION[CSRF_SESSION_KEY] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_SESSION_KEY];
}

/** Outputs a hidden CSRF input. */
function csrf_field()
{
    echo '<input type="hidden" name="' . CSRF_FIELD . '" value="' . htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
}

/** Verifies the submitted token. Returns true when valid. */
function csrf_verify()
{
    $submitted = isset($_POST[CSRF_FIELD]) ? (string) $_POST[CSRF_FIELD] : '';
    return !empty($_SESSION[CSRF_SESSION_KEY])
        && is_string($submitted)
        && hash_equals($_SESSION[CSRF_SESSION_KEY], $submitted);
}

/** Renders one inline validation error message. */
function field_error($errors, $key)
{
    if (empty($errors[$key])) {
        return;
    }
    echo '<span class="form-error" style="color:#e04b4b;font-size:13px;display:block;margin-top:5px;">'
        . htmlspecialchars($errors[$key], ENT_QUOTES, 'UTF-8')
        . '</span>';
}

/** Writes a submitted value back into a form field. */
function old_value($data, $key)
{
    return isset($data[$key]) ? htmlspecialchars((string) $data[$key], ENT_QUOTES, 'UTF-8') : '';
}

/** Redirects and stops execution, guarding against header injection. */
function redirect_to($path)
{
    $path = preg_replace('/[\r\n]/', '', $path);
    header('Location: ' . $path, true, 303);
    exit;
}
