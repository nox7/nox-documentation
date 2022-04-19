import EditorWrapper from "./EditorWrapper.js";

class EditTabButtons{
	constructor(){
		this.buttons = document.querySelectorAll(".editor-tab-button");

		for (const button of this.buttons){
			button.addEventListener("click", e => {
				this.onButtonClick(button);
			});
		}
	}

	onButtonClick(button){
		if (button.classList.contains("selected")){
			return;
		}

		const selectedButton = document.querySelector(".editor-tab-button.selected");
		selectedButton.classList.remove("selected");
		button.classList.add("selected");
		EditorWrapper.currentInstance.swapToSession(button.getAttribute("session-name"));
	}
}

export default new EditTabButtons();