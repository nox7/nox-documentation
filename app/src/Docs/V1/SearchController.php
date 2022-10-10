<?php

	namespace Docs\V1;

	use Nox\Http\Attributes\UseJSON;
	use Nox\Http\JSON\JSONResult;
	use Nox\Http\JSON\JSONSuccess;
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;
	use NoxDocumentation\Docs\DocsVersions;
	use NoxDocumentation\Docs\SearchService;
	use NoxDocumentation\Docs\SetDocVersion;

	#[Controller]
	#[RouteBase("/docs/1.x")]
	#[RouteBase("/docs/1.0")]
	#[SetDocVersion("1.0")]
	class SearchController extends BaseController
	{

		#[Route("GET", "/search")]
		public function searchView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v1/search.php",
				viewScope: [
					"title"=>"Search Nox v1 Documentation",
					"description"=>"",
				],
			);
		}

		#[Route("GET", "/perform-query")]
		#[UseJSON]
		public function performQuery(): JSONResult
		{
			$query = trim($_GET['query'] ?? "");

			if (!empty($query)) {
				$reflectionMethods = SearchService::query(DocsVersions::_1_0->value, $query);
				$searchResults = SearchService::parseQueryResultInSearchResults($reflectionMethods);
			}else{
				$searchResults = [];
			}

			return new JSONSuccess([
				"searchResults"=>$searchResults,
			]);
		}
	}