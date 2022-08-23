<?php

	namespace Docs\V1;

	use Nox\Http\Request;
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;
	use Utils\PageSearch;

	#[Controller]
	#[RouteBase("/docs/1.x")]
	class SearchController extends BaseController
	{

		#[Route("GET", "/search")]
		public function searchView(): string
		{
			$query = $_GET['query'] ?? "";
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