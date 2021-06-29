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
		<link rel="stylesheet" href="/external/prism/prism.css">
		<script defer src="/external/prism/prism.js"></script>
		<?= $htmlHead ?>
	</head>
	<body>
		<?php include __DIR__ . "/../views/_partials/home-nav.html"; ?>
		<page-container>
			<?= $htmlBody ?>
		</page-container>
	</body>
</html>
