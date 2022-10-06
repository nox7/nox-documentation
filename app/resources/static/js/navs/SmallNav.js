class SmallNav{
	constructor(){
		this.navContainer = document.querySelector("#nav-small");
		this.backdrop = document.querySelector("#nav-small-backdrop");
		this.triggerButton = document.querySelector("#small-nav-trigger-button");
		this.closeButton = document.querySelector("#small-nav-close-button");

		this.triggerButton.addEventListener("click", () => {
			this.onTriggerButtonClicked();
		});

		this.backdrop.addEventListener("click", () => {
			this.hideSmallNav();
		});

		this.closeButton.addEventListener("click", () => {
			this.hideSmallNav();
		});
	}

	showSmallNav(){
		document.body.style.overflow = "hidden";
		this.backdrop.style.display = "block";
		this.navContainer.classList.add("open");
	}

	hideSmallNav(){
		document.body.style.overflow = null;
		this.backdrop.style.display = "none";
		this.navContainer.classList.remove("open");
	}

	onTriggerButtonClicked(){
		this.showSmallNav();
	}

	onBackdropClicked(){
		this.hideSmallNav();
	}
}

export default new SmallNav();