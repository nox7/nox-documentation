import SearchResult from "../components/SearchResult.js";

class SearchForm{
	isProcessing = false;
	form = document.querySelector("#search-form");
	loader = document.querySelector("#search-results-loader");
	noResults = document.querySelector("#no-search-results-container");

	constructor() {
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
		this.loader.style.display = null;
		SearchResult.container.innerHTML = ``;

		const fData = new FormData(this.form);
		const urlSearchParams = new URLSearchParams();
		urlSearchParams.set("query", fData.get("query"));

		const response = await fetch(`perform-query?${urlSearchParams.toString()}`, {
			cache:"no-cache"
		});

		/** @type {{status: int, error: ?string, searchResults: Object[]}} */
		const data = await response.json();

		if (data.searchResults.length > 0) {
			this.noResults.style.display = "none";
			for (/** @type{{title: string, description: string, route: string}} */ const searchResultObject of data.searchResults) {
				const searchResult = new SearchResult(
					searchResultObject.title,
					searchResultObject.route,
					searchResultObject.description
				);
				searchResult.render();
			}
		}else{
			this.noResults.style.display = null;
		}

		this.isProcessing = false;
		this.loader.style.display = "none";
	}
}

export default new SearchForm();