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
		<?php include __DIR__ . "/../views/_partials/_global-head.html"; ?>
		<?= $htmlHead ?>
	</head>
	<body class="d-flex flex-column vh-100">
		<?php include __DIR__ . "/../views/_partials/home-nav.html"; ?>
		<form id="editor-form">
			<editor-page-container>
				<?php include __DIR__ . "/../views/_partials/editor/sidebar.php"; ?>
				<?= $htmlBody ?>
			</editor-page-container>
		</form>
	</body>
</html>
