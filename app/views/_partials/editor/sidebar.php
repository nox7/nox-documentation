<?php
	require_once __DIR__ . "/../../../classes/PageCategory.php";
	require_once __DIR__ . "/../../../classes/LayoutFetcher.php";

	/** @var array $viewScope */
	/** @var Page $editedPage */
	$editedPage = $viewScope['pageBeingEdited'];

	$allCategories = PageCategory::getAllCategoriesInHierarchy(null);
	$allLayoutFilePaths = LayoutFetcher::getAvailableLayoutFilePaths();
?>
<aside>
	<div class="page-editor-sidebar-group">
		<div class="mb-1">
			<label for="editor-page-title">Title</label>
		</div>
		<input id="editor-page-title" class="form-control form-control-sm" type="text" name="page-title" placeholder="Page title" value="<?= $editedPage?->title ?? "" ?>">
	</div>

	<div class="page-editor-sidebar-group">
		<div class="mb-1">
			<label for="editor-page-title">Category</label>
		</div>
		<div>
			<select class="form-control form-control-sm" name="page-category">
				<option value="-1">- None -</option>
				<?php
					/** @var PageCategory $pageCategory */
					foreach($allCategories as $pageCategory){
						?>
						<option <?= $editedPage?->categoryID === $pageCategory->id ? "selected" : "" ?> value="<?= $pageCategory->id ?>"><?= $pageCategory->name ?></option>
						<?php
						if (!empty($pageCategory->childCategories)){
							/** @var PageCategory $childPageCategory */
							foreach($pageCategory->childCategories as $childPageCategory){
								?>
								<option <?= $editedPage?->categoryID === $childPageCategory->id ? "selected" : "" ?> value="<?= $childPageCategory->id ?>">&nbsp; └ <?= $childPageCategory->name ?></option>
								<?php
								if (!empty($childPageCategory->childCategories)){
									/** @var PageCategory $secondChildPageCategory */
									foreach($childPageCategory->childCategories as $secondChildPageCategory){
										?>
										<option <?= $editedPage?->categoryID === $secondChildPageCategory->id ? "selected" : "" ?> value="<?= $secondChildPageCategory->id ?>">&nbsp; &nbsp; └ <?= $secondChildPageCategory->name ?></option>
										<?php
									}
								}
							}
						}
					}
				?>
			</select>
		</div>
		<small>Categories can define base routes</small>
	</div>

	<div class="page-editor-sidebar-group">
		<div class="mb-1">
			<label for="editor-page-layout">Page layout</label>
		</div>
		<div>
			<select class="form-control form-control-sm" name="page-layout-file-path">
				<?php
					/** @var string $filePath */
					foreach($allLayoutFilePaths as $filePath){
						$baseFileName = basename($filePath);
						?>
						<option <?= $editedPage?->pageLayoutFilePath === $filePath ? "selected" : "" ?> value="<?= $filePath ?>"><?= $baseFileName ?></option>
						<?php
					}
				?>
			</select>
		</div>
		<small>Categories can define base routes</small>
	</div>

	<div class="page-editor-sidebar-group">
		<div class="mb-1">
			<label for="editor-page-route">Route</label>
		</div>
		<input id="editor-page-route" class="form-control form-control-sm" type="text" name="page-route" placeholder="Page route" value="<?= $editedPage?->route ?? "" ?>">
		<small>This route is appended after all categories route bases are prepended first.</small>
	</div>

	<div class="page-editor-sidebar-group mt-2">
		<?php
			if ($editedPage !== null){
				?>
				<button form="editor-form" type="submit" class="btn btn-primary w-100">
					<i class="bi bi-save-fill"></i>
					<span>Save</span>
				</button>
				<?php
			}else{
				?>
				<button form="editor-form" type="submit" class="btn btn-primary w-100">
					<i class="bi bi-node-plus-fill"></i>
					<span>Create</span>
				</button>
				<?php
			}
		?>
	</div>
</aside>