<?php
	/** @var array $viewScope */
	/** @var ?Page $editedPage */
	$editedPage = $viewScope['pageBeingEdited'];
?>
@Layout = "editor.php"
@Head{
<title>Nox Docs Page Editor</title>
<script defer src="/ace-editor/ace.js"></script>
<script defer src="/ace-editor/mode-html.js"></script>
<script defer src="/ace-editor/mode-javascript.js"></script>
<script defer src="/ace-editor/mode-php.js"></script>
<script type="module" src="/js/editor/main.js"></script>
}
@Body{
<main>
	<input type="hidden" id="page-id" name="page-id" value="<?= $editedPage?->id ?? "" ?>">
	<textarea id="body-preload" style="display:none;"><?= htmlspecialchars($editedPage?->body ?? "") ?></textarea>
	<textarea id="head-preload" style="display:none;"><?= htmlspecialchars($editedPage?->head ?? "") ?></textarea>
	<div class="editor-tabs">
		<div class="editor-tab-button-container">
			<button session-name="body" type="button" class="editor-tab-button selected">Body</button>
		</div>
		<div class="editor-tab-button-container">
			<button session-name="head" type="button" class="editor-tab-button">Head</button>
		</div>
	</div>
	<div class="page-editor-container">
		<textarea id="page-content"></textarea>
	</div>
</main>
}