<?php

	require_once __DIR__ . "/V1PagesController.php";
	require_once __DIR__ . "/../../classes/PageSearch.php";

	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Route;
	use Nox\Router\BaseController;

	class SearchController extends BaseController{

		#[Route("GET", "/docs/1.x/search")]
		public function searchView(): string{
			$request = new \Nox\Http\Request();
			$query = $request->getGetValue("query", "");
			$pageResults = [];

			if (!empty($query)){
				$pageSearch = new PageSearch([
					V1PagesController::class
				]);
				$pageSearch->loadEligibleRoutes();
				$pageResults = $pageSearch->getRoutesForQuery($query);
			}

			return Renderer::renderView(
				viewFileName:"search.php",
				viewScope: [
					"query"=>trim($request->getGetValue("query", "")),
					"pageResults"=>$pageResults,
					"query"=>$query,
				],
			);
		}
	}