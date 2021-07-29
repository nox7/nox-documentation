<?php

	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Route;
	use Nox\Router\BaseController;

	class SearchController extends BaseController{

		#[Route("GET", "/docs/search")]
		public function searchView(): string{
			$request = new \Nox\Http\Request();
			return Renderer::renderView(
				"search.html",
				[
					"query"=>trim($request->getGetValue("nox-query", "")),
				],
			);
		}
	}