class SmallNav{
	constructor(){
		this.navContainer = document.querySelector("#nav-small");
		this.backdrop = document.querySelector("#nav-small-backdrop");
		this.triggerButton = document.querySelector("#small-nav-trigger-button");
		this.closeButton = document.querySelector("#small-nav-close-button");

		this.docsNavBackdrop = document.querySelector("#docs-sidebar-backdrop");
		this.docsTriggerButton = document.querySelector("#small-nav-docs-drawer-trigger-button");
		this.docsSidebar = document.querySelector("#docs-sidebar");

		this.triggerButton.addEventListener("click", () => {
			this.onTriggerButtonClicked();
		});

		this.backdrop.addEventListener("click", () => {
			this.onBackdropClicked();
		});

		this.closeButton.addEventListener("click", () => {
			this.hideSmallNav();
		});

		if (this.docsTriggerButton !== null){
			this.docsTriggerButton.addEventListener("click", e => {
				this.onDocsDrawerTriggerButtonClicked();
			});

			this.docsNavBackdrop.addEventListener("click", e => {
				if (e.target === this.docsNavBackdrop) {
					this.onDocsDrawerBackdropClicked();
				}
			});
		}
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

	showDocsNavDrawer(){
		document.body.style.overflow = "hidden";
		this.docsNavBackdrop.style.display = null;
		this.docsSidebar.classList.remove("small-nav-closed");
		this.docsSidebar.classList.add("small-nav-opened");
	}

	hideDocsNavDrawer(){
		document.body.style.overflow = null;
		this.docsNavBackdrop.style.display = "none";
		this.docsSidebar.classList.add("small-nav-closed");
		this.docsSidebar.classList.remove("small-nav-opened");
	}

	onTriggerButtonClicked(){

		if (this.isDocsNavDrawerOpen()){
			this.hideDocsNavDrawer();
		}

		this.showSmallNav();
	}

	onBackdropClicked(){
		this.hideSmallNav();
	}

	isSmallNavDrawerOpen(){
		return this.navContainer.classList.contains("open");
	}

	isDocsNavDrawerOpen(){
		return this.docsSidebar.classList.contains("small-nav-opened");
	}

	onDocsDrawerTriggerButtonClicked(){
		if (this.isSmallNavDrawerOpen()){
			this.hideSmallNav();
		}

		this.showDocsNavDrawer();
	}

	onDocsDrawerBackdropClicked(){
		this.hideDocsNavDrawer();
	}
}

export default new SmallNav();