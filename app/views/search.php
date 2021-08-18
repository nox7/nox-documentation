<?php
	/** @var array $viewScope */
	/** @var array{uri: string, body: string, title: string}[] $pageResults */
	$pageResults = $viewScope['pageResults'];

	$query = $viewScope['query'];
?>
@Layout = "base.php"
@Head{
<title>Search the Nox Framework</title>
}
@Body{
<h1>Documentation search results for your query</h1>
<form id="query-documentation-form">
	<div>
		<input type="text" class="form-control" name="nox-query" id="query-input">
	</div>
	<?php
		if (!empty($pageResults)){
			/** @var array{uri: string, body: string, title: string} $pageResult */
			foreach($pageResults as $pageResult){
				$truncatedBody = PageSearch::getTruncatedBodyOfFirstQueryMatch($pageResult['body'], $query);
			?>
			<page-result>
				<h3><?= $pageResult['title']; ?></h3>
				<p><?= $pageResult['uri']; ?></p>
				<p><?= $truncatedBody ?></p>
			</page-result>
			<?php
			}
		}
	?>
</form>
}