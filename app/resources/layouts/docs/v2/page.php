<?php
	/** @var string $htmlHead */
	/** @var string $htmlBody */

	use NoxDocumentation\Docs\DocsVersion;

	$docsVersion = DocsVersion::$currentPageVersion;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/external/highlightjs/styles/dark.min.css">
		<script src="/external/highlightjs/highlight.min.js"></script>
		<script type="module" src="/js/Docs/VersionSelector/VersionSelector.js"></script>
		<?php include __DIR__ . "/../../../views/_partials/_global-head.html"; ?>
		<?= $htmlHead ?>
		<script>
			hljs.highlightAll();
		</script>
	</head>
	<body>
		<?php include __DIR__ . "/../../../views/_partials/google-tag-manager-noscript.html"; ?>
		<?php include __DIR__ . "/../../../views/_partials/navigation/nav-large.php"; ?>
		<?php include __DIR__ . "/../../../views/_partials/navigation/nav-small-docs.php"; ?>
		<input type="hidden" id="docs-version" value="<?= $docsVersion ?>">
		<page-container id="docs-page-container">
			<?php include __DIR__ . "/../../../views/_partials/v2/_sidebar.php"; ?>
			<main>
				<?= $htmlBody ?>
			</main>
		</page-container>
		<?php include __DIR__ . "/../../../views/_partials/_footer.html" ?>
	</body>
</html>
