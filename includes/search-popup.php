<?php
/**
 * Full-screen search popup opened by the header search button.
 */
?>
<!-- Search Popup -->
<div class="search-popup">
	<div class="color-layer"></div>
	<button class="close-search"><span class="flaticon-close"></span></button>
	<form method="get" action="<?php echo htmlspecialchars(SEARCH_ACTION); ?>">
		<div class="form-group">
			<input type="search" name="q" value="<?php echo htmlspecialchars(isset($_GET['q']) ? (string) $_GET['q'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Search Articles" required="">
			<button class="fa fa-solid fa-magnifying-glass fa-fw" type="submit" aria-label="Search"></button>
		</div>
	</form>
</div>
<!-- End Search Popup -->
