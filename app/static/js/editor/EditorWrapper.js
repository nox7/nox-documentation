class EditorWrapper{
	constructor(aceEditor){
		const htmlMode = ace.require("ace/mode/html").Mode;
		this.aceEditor = aceEditor;

		aceEditor.session.setMode(new htmlMode());
		// aceEditor.setBehavioursEnabled(true);
		aceEditor.setFontSize(16);
	}
}

export default EditorWrapper;