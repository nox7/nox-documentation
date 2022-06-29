<?php

	namespace Docs\V2;

	use Nox\Http\Request;
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;
	use Utils\PageSearch;

	#[Controller]
	#[RouteBase("/docs/2")]
	class SearchController extends BaseController
	{

		#[Route("GET", "/search")]
		public function searchView(): string
		{
			$request = new Request();
			$query = trim($request->getGetValue("query", ""));
			$pageResults = [];

			if (!empty($query)) {
				$pageSearch = new PageSearch([
					DocsPagesController::class
				]);
				$pageSearch->loadEligibleRoutes();
				$pageResults = $pageSearch->getEligibleRoutesForQuery($query);
			}

			return Renderer::renderView(
				viewFileName: "docs/v2/search.php",
				viewScope: [
					"pageResults" => $pageResults,
					"query" => $query,
				],
			);
		}
	}