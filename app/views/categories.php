<?php
	/** @var array $viewScope */
	/** @var array $categories */
	$categories = $viewScope['categories'];

	/**
	 * Renders the HTML of a page category to be edited and recursively renders the child
	 * page categories as well
	 * @param PageCategory $pageCategory
	 * @return string
	 */
	function renderPageCategory(PageCategory $pageCategory): string{
		ob_start();
		?>
		<page-category>
			<div class="edit-controls">
				<div>
					<span><?= $pageCategory->id ?></span>
				</div>
				<div>
					<input type="text" class="form-control" value="<?= $pageCategory->name ?>">
				</div>
				<div>
					<input type="text" class="form-control" value="<?= $pageCategory->routeBase ?>">
				</div>
				<div>
					<input type="text" class="form-control" value="<?= $pageCategory->parentCategoryID ?>">
				</div>
			</div>
			<div class="children">{{ CHILDREN_HTML }}</div>
		</page-category>
		<?php
		$html = ob_get_contents();
		ob_end_clean();
		$childHTML = "";
		if (!empty($pageCategory->childCategories)){
			/** @var PageCategory $childPageCategory */
			foreach($pageCategory->childCategories as $childPageCategory) {
				$childHTML .= renderPageCategory($childPageCategory);
			}
		}

		return str_replace("{{ CHILDREN_HTML }}", $childHTML, $html);
	}
?>
@Layout = "admin.php"
@Head{
	<title>Edit Page Categories</title>
}
@Body{
	<div>
		<?php
			/** @var PageCategory $category */
			foreach($categories as $category){
				echo(renderPageCategory($category));
			}
		?>
	</div>
}