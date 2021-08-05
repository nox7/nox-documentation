<?php
	/** @var string $htmlHead */
	/** @var string $htmlBody */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/theme/main.css">
		<script defer src="/external/prism/prism.js"></script>
		<?php include __DIR__ . "/../views/_partials/_global-head.html"; ?>
		<?= $htmlHead ?>
	</head>
	<body>
		<?php include __DIR__ . "/../views/_partials/home-nav.html"; ?>
		<editor-page-container>
			<?php include __DIR__ . "/../views/_partials/editor/sidebar.html"; ?>
			<form id="editor-form">
				<?= $htmlBody ?>
			</form>
		</editor-page-container>
	</body>
</html>
