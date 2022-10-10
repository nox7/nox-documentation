<?php
	/** @var array{title: string, description: string} $viewScope */
?>
@Layout = "docs/v2/page.php"
@Head{
	<title><?= htmlspecialchars($viewScope['title']) ?></title>
	<meta name="description" content="<?= htmlspecialchars($viewScope['description']) ?>">
}
@Body{
	<input type="hidden" id="initial-query" value="<?= $_GET['query'] ?? '' ?>">
	<div id="search-page">
		<form id="search-form">
			<div class="input-group">
				<label for="search-input" class="input-group-text">
					<i class="bi bi-search"></i>
				</label>
				<input id="search-input" class="form-control" type="text" placeholder="Search the docs">
			</div>
		</form>
		<hr>
		<div id="search-results-container"></div>
	</div>
}
