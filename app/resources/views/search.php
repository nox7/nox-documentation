<?php
	/** @var array $viewScope */
	/** @var array[] $pageResults */

	use Utils\PageSearch;

	$pageResults = $viewScope['pageResults'];

	$query = $viewScope['query'];
?>
@Layout = "docs-v1-page-no-search.php"
@Head{
<title>Search the Nox Framework</title>
}
@Body{
<h1>Documentation search results for your query</h1>
<form id="query-documentation-form">
	<div>
		<input type="text" class="form-control" name="query" id="query-input" value="<?= $query ?>">
	</div>
	<div class="py-3">
		<?php
			if (!empty($pageResults)){
				/** @var array{uri: string, body: string, title: string} $pageResult */
				foreach($pageResults as $pageResult){
					$truncatedBody = PageSearch::getTruncatedBodyOfFirstQueryMatch(
						body: $pageResult['body'],
						query: $query,
						highlightResult: true,
					);
				?>
				<page-result>
					<h3><a href="<?= $pageResult['uri']; ?>">
						<?= $pageResult['title']; ?>
					</a></h3>
					<p class="uri"><?= $pageResult['uri']; ?></p>
					<p class="body-preview"><?= $truncatedBody ?></p>
				</page-result>
				<?php
				}
			}else{
				if (empty($query)){
					?>
					<div class="text-center">
						<span>Type a query above</span>
					</div>
					<?php
				}else{
					?>
					<div class="text-center">
						<h4><em>No results found for that query</em></h4>
					</div>
					<?php
				}
			}
		?>
	</div>
</form>
}