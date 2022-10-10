<?php
	/** @var array{title: string, description: string} $viewScope */
?>
@Layout = "docs/v1/page.php"
@Head{
	<title><?= htmlspecialchars($viewScope['title']) ?></title>
	<meta name="description" content="<?= htmlspecialchars($viewScope['description']) ?>">
	<script type="module" src="/js/Docs/Search/Search.js"></script>
}
@Body{
	<div id="search-page">
		<form id="search-form">
			<div class="input-group">
				<label for="search-input" class="input-group-text">
					<i class="bi bi-search"></i>
				</label>
				<input name="query" id="search-input" class="form-control" type="text" placeholder="Search the docs" value="<?= $_GET['query'] ?? '' ?>">
			</div>
		</form>
		<hr>
		<div id="search-results-loader">
			<div class="text-center">
				<div style="width:5rem; height:5rem;" class="spinner-border text-primary" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
				<h4>Loading...</h4>
			</div>
		</div>
		<div id="no-search-results-container" style="display:none;">
			<div class="text-center">
				<h4><em>No results</em></h4>
			</div>
		</div>
		<div id="search-results-container"></div>
	</div>
}
