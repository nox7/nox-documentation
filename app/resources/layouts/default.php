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
		<?= $htmlHead ?>
	</head>
	<body>
		<?php include __DIR__ . "/../views/_partials/google-tag-manager-noscript.html"; ?>
		<?php include __DIR__ . "/../views/_partials/navigation/nav-large.php"; ?>
		<?php include __DIR__ . "/../views/_partials/navigation/nav-small.php"; ?>
		<page-container>
			<?= $htmlBody ?>
		</page-container>
		<?php include __DIR__ . "/../views/_partials/_footer.html" ?>
	</body>
</html>
