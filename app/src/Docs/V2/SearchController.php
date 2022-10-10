<?php

	namespace Docs\V2;

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
	#[RouteBase("/docs/2.0")]
	#[SetDocVersion("2.0")]
	class SearchController extends BaseController
	{

		#[Route("GET", "/search")]
		public function searchView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/search.php",
				viewScope: [
					"title"=>"Search Nox v2 Documentation",
					"description"=>"",
				],
			);
		}

		#[Route("GET", "/perform-query")]
		#[UseJSON]
		public function performQuery(): JSONResult
		{
			$query = $_GET['query'] ?? "";

			$reflectionMethods = SearchService::query(DocsVersions::_2_0->value, $query);
			$searchResults = SearchService::parseQueryResultInSearchResults($reflectionMethods);

			return new JSONSuccess([
				"searchResults"=>$searchResults,
			]);
		}
	}