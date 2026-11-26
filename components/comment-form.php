<?php
/**
 * Comment form used by the article and project detail pages.
 *
 * Posts back to the current page. Success and error messages are read from
 * $_SESSION so the page can be reloaded without resubmitting.
 */

require_once __DIR__ . '/../includes/form-security.php';

$commentErrors = isset($_SESSION['comment_errors']) ? $_SESSION['comment_errors'] : array();
$commentDone = !empty($_SESSION['comment_sent']);
$commentData = isset($_SESSION['comment_data']) ? $_SESSION['comment_data'] : array();

unset($_SESSION['comment_errors'], $_SESSION['comment_sent'], $_SESSION['comment_data']);

$self = form_action();
?>
<form method="post" action="<?php echo htmlspecialchars($self, ENT_QUOTES, 'UTF-8'); ?>#comments" id="comments" novalidate>
	<input type="hidden" name="form_type" value="comment">
	<?php csrf_field(); ?>

	<div style="position:absolute;left:-9999px;" aria-hidden="true">
		<label for="comment-website">Website</label>
		<input type="text" id="comment-website" name="website" tabindex="-1" autocomplete="off">
	</div>

	<?php if ($commentDone): ?>
		<div class="alert alert-success" role="alert">Thank you. Your comment has been submitted for review.</div>
	<?php endif; ?>
	<?php if (!empty($commentErrors['form'])): ?>
		<div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($commentErrors['form'], ENT_QUOTES, 'UTF-8'); ?></div>
	<?php endif; ?>

	<div class="row clearfix">

		<div class="col-lg-6 col-md-6 col-sm-12 form-group">
			<i class="flaticon-user" aria-hidden="true"></i>
			<input type="text" name="username" value="<?php echo old_value($commentData, 'username'); ?>" placeholder="Full Name" required>
			<?php field_error($commentErrors, 'username'); ?>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 form-group">
			<i class="flaticon-mail" aria-hidden="true"></i>
			<input type="email" name="email" value="<?php echo old_value($commentData, 'email'); ?>" placeholder="Email Address" required>
			<?php field_error($commentErrors, 'email'); ?>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 form-group">
			<textarea class="" name="message" placeholder="Type Here..."><?php echo old_value($commentData, 'message'); ?></textarea>
			<?php field_error($commentErrors, 'message'); ?>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 form-group">
			<!-- Button Box -->
			<button type="submit" class="theme-btn btn-style-one">
				<span class="btn-wrap">
					<span class="text-one">Comment Now</span>
					<span class="text-two">Comment Now</span>
				</span>
			</button>
		</div>

	</div>
</form>