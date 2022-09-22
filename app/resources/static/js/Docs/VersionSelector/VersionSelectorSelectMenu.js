import VersionSelectorForm from "./VersionSelectorForm.js";

class VersionSelectorSelectMenu{
	/** @type {HTMLSelectElement} */
	menu = document.querySelector("#docs-version-selector-menu");

	constructor() {
		this.menu.addEventListener("change", () => {
			this.onSelectMenuChanged();
		});
	}

	onSelectMenuChanged(){
		VersionSelectorForm.onSubmit();
	}

}

export default new VersionSelectorSelectMenu();