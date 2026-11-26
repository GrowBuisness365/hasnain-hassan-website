<?php
/**
 * Newsletter form helpers, shared by all three footer layouts.
 */

require_once __DIR__ . '/form-security.php';

/** Renders the subscription status message above the newsletter form. */
function render_newsletter_status()
{
    if (isset($_GET['subscribed'])) {
        if ($_GET['subscribed'] === 'saved') {
            echo '<div class="alert alert-warning" role="alert" style="font-size:13px;padding:8px 12px;">Thank you. Your subscription was saved, but the notification email could not be sent.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert" style="font-size:13px;padding:8px 12px;">Thank you for subscribing.</div>';
        }
    }
    if (!empty($_SESSION['newsletter_errors'])) {
        echo '<div class="alert alert-danger" role="alert" style="font-size:13px;padding:8px 12px;">'
            . htmlspecialchars($_SESSION['newsletter_errors'][0], ENT_QUOTES, 'UTF-8') . '</div>';
        unset($_SESSION['newsletter_errors']);
    }
    if (!empty($_SESSION['newsletter_saved'])) {
        echo '<div class="alert alert-warning" role="alert" style="font-size:13px;padding:8px 12px;">Thank you. Your subscription was saved, but the notification email could not be sent.</div>';
        unset($_SESSION['newsletter_saved']);
    }
}

/** Renders the CSRF token for the newsletter form. */
function render_newsletter_fields($id)
{
    csrf_field();
}
