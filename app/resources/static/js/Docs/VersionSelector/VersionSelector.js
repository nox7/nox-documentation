import VersionSelectorForm from "./VersionSelectorForm.js";
import VersionSelectorSelectMenu from "./VersionSelectorSelectMenu.js";

class VersionSelector{
	constructor() {
		// Set the current version
		const currentVersion = document.querySelector("#docs-version").value;
		VersionSelectorSelectMenu.menu.value = currentVersion;
	}
}

export default new VersionSelector();