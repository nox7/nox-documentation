import EditorWrapper from "./EditorWrapper.js";

const aceEditor = ace.edit("page-content")

new EditorWrapper(aceEditor);