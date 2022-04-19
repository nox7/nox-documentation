import EditorWrapper from "./EditorWrapper.js";
import EditTabButtons from "./EditTabButtons.js";
import EditorForm from "./EditorForm.js";

const aceEditor = ace.edit("page-content")
const editorWrapper = new EditorWrapper(aceEditor);

editorWrapper.sessions.body.setValue(document.querySelector("#body-preload").value);
editorWrapper.sessions.head.setValue(document.querySelector("#head-preload").value);
