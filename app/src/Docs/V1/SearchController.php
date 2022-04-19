<?php

	namespace Docs\V1;

	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\BaseController;
	use PageSearch;

	#[Controller]
	class SearchController extends BaseController
	{

		#[Route("GET", "/docs/1.x/search")]
		public function searchView(): string
		{
			$request = new \Nox\Http\Request();
			$query = trim($request->getGetValue("query", ""));
			$pageResults = [];

			if (!empty($query)) {
				$pageSearch = new PageSearch([
					V1PagesController::class
				]);
				$pageSearch->loadEligibleRoutes();
				$pageResults = $pageSearch->getRoutesForQuery($query);
			}

			return Renderer::renderView(
				viewFileName: "search.php",
				viewScope: [
					"pageResults" => $pageResults,
					"query" => $query,
				],
			);
		}
	}