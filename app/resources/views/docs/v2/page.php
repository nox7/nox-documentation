<?php
	/** @var array{title: string, description: string, body: string} $viewScope */
?>
@Layout = "docs/v2/page.php"
@Head{
	<title><?= htmlspecialchars($viewScope['title']) ?></title>
	<meta name="description" content="<?= htmlspecialchars($viewScope['description']) ?>">
}
@Body{
	<?= $viewScope['body'] ?>
}
