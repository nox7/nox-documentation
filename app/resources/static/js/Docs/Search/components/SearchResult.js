class SearchResult{

	static container = document.querySelector("#search-results-container");

	title;
	route;
	description;
	dom;

	constructor(title, route, description) {
		this.title = title;
		this.route = route;
		this.description = description;

		this.dom = this.getDOM();
	}

	getDOM(){
		const template = document.createElement("div");
		template.classList.add("search-result-item");
		template.innerHTML = `
		    <div class="title-container">
		    	<h2>
					<a href="${this.route}">${this.title}</a>
				</h2>
		    </div>
		    <div class="route-container">
		    	<a href="${this.route}">${this.route}</a>
		    </div>
		    <div class="description-container">
		    	<p>${this.description}</p>
		    </div>
		`;

		return template;
	}

	render(){
		SearchResult.container.append(this.dom);
	}
}

export default SearchResult;