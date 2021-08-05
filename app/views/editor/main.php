@Layout = "editor.php"
@Head{
<script defer src="/ace-editor/ace.js"></script>
<script defer src="/ace-editor/mode-html.js"></script>
<script defer src="/ace-editor/mode-javascript.js"></script>
<script defer src="/ace-editor/mode-php.js"></script>
<script type="module" src="/js/editor/main.js"></script>
}
@Body{
<main>
	<div class="editor-tabs">
		<div class="editor-tab-button-container">
			<button type="button" class="editor-tab-button selected">Body</button>
		</div>
		<div class="editor-tab-button-container">
			<button type="button" class="editor-tab-button">Head</button>
		</div>
	</div>
	<div class="page-editor-container">
		<textarea id="page-content"></textarea>
	</div>
</main>
}