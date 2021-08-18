<?php
	/** @var string $htmlHead */
	/** @var string $htmlBody */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include __DIR__ . "/../views/_partials/_global-head.html"; ?>
		<link rel="stylesheet" href="/external/prism/prism.css">
		<script defer src="/external/prism/prism.js"></script>
		<?= $htmlHead ?>
	</head>
	<body>
		<?php include __DIR__ . "/../views/_partials/google-tag-manager-noscript.html"; ?>
		<?php include __DIR__ . "/../views/_partials/home-nav.html"; ?>
		<page-container>
			<?= $htmlBody ?>
		</page-container>
	</body>
</html>
