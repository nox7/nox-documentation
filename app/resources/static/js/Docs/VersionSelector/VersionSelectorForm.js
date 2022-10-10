import VersionSelectorSelectMenu from "./VersionSelectorSelectMenu.js";

class VersionSelectorForm{
	/** @type {HTMLFormElement} */
	form = document.querySelector("#docs-version-selector-form");

	constructor() {
		this.form.addEventListener("submit", e => {
			e.preventDefault();
			this.onSubmit();
		});
	}

	onSubmit(){
		const versionSelected = VersionSelectorSelectMenu.menu.value;
		this.onVersionSelected(versionSelected);
	}

	onVersionSelected(version){
		if (version === "1.0"){
			window.location.href = "/docs/1.x";
		}else if(version === "2.0"){
			window.location.href = "/docs/2.0/";
		}
	}
}

export default new VersionSelectorForm();