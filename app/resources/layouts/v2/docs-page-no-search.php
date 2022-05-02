<?php
	/** @var string $htmlHead */
	/** @var string $htmlBody */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include __DIR__ . "/../../views/_partials/_global-head.html"; ?>
		<link rel="stylesheet" href="/external/prism/prism.css">
		<script defer src="/external/prism/prism.js"></script>
		<?= $htmlHead ?>
	</head>
	<body>
		<?php include __DIR__ . "/../../views/_partials/google-tag-manager-noscript.html"; ?>
		<?php include __DIR__ . "/../../views/_partials/_top-doc-nav.html"; ?>
		<page-container>
			<?php include __DIR__ . "/../../views/_partials/v2/_sidebar.html"; ?>
			<main class="pt-5">
				<?= $htmlBody ?>
			</main>
		</page-container>
		<?php include __DIR__ . "/../../views/_partials/_footer.html" ?>
	</body>
</html>
