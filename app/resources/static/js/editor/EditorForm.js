import EditorWrapper from "./EditorWrapper.js";

class EditorForm{
	constructor(){
		this.form = document.querySelector("#editor-form");
		this.pageID = parseInt(document.querySelector("#page-id").value);
		this.isProcessing = false;

		this.form.addEventListener("submit", e => {
			e.preventDefault();
			this.onSubmit();
		});
	}

	async onSubmit(){
		if (this.isProcessing){
			return;
		}

		this.isProcessing = true;

		if (isNaN(this.pageID)){
			await this.createPage();
		}else{
			await this.savePage();
		}

		this.isProcessing = false;
	}

	getFormData(){
		const fData = new FormData(this.form);
		fData.set("page-body", EditorWrapper.currentInstance.sessions.body.getValue());
		fData.set("page-head", EditorWrapper.currentInstance.sessions.head.getValue());

		return fData;
	}

	async createPage(){
		const response = await fetch(`/admin/editor`, {
			credentials:"same-origin",
			cache:"no-cache",
			method:"post",
			body: this.getFormData()
		});

		/** @type {{status: number, error: ?string, newPageEditorURI: string}} */
		const data = await response.json();
		if (data.status === -1){
			alert(data.error);
		}else if (data.status === 1){
			window.location.href = data.newPageEditorURI;
		}
	}

	async savePage(){
		const response = await fetch(`/admin/editor/${this.pageID}`, {
			credentials:"same-origin",
			cache:"no-cache",
			method:"patch",
			body: this.getFormData()
		});

		/** @type {{status: number, error: ?string, newPageEditorURI: string}} */
		const data = await response.json();
		if (data.status === -1){
			alert(data.error);
		}else if (data.status === 1){

		}
	}
}

export default new EditorForm();