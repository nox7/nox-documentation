class EditorWrapper{
	/** @type {EditorWrapper} */
	static currentInstance = null;

	constructor(aceEditor){
		/** @type EditorWrapper */
		EditorWrapper.currentInstance = this;
		const htmlMode = ace.require("ace/mode/html").Mode;
		this.aceEditor = aceEditor;
		this.currentSessionName = "body";
		this.modes = {
			html: new (ace.require("ace/mode/html").Mode)()
		}
		this.sessions = {
			body:aceEditor.session,
			head:ace.createEditSession("", new htmlMode()),
		}

		this.aceEditor.session.setMode(this.modes.html);
		aceEditor.setFontSize(16);
	}

	swapToSession(sessionName){
		this.aceEditor.setSession(this.sessions[sessionName]);
		this.aceEditor.session.setMode(this.modes.html);
	}
}

export default EditorWrapper;