<?php

	namespace Docs\V1;

	use Nox\Http\Redirect;
	use Nox\RenderEngine\Exceptions\LayoutDoesNotExist;
	use Nox\RenderEngine\Exceptions\ParseError;
	use Nox\RenderEngine\Exceptions\ViewFileDoesNotExist;
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;

	#[Controller]
	#[RouteBase("/docs/1.x")]
	class DocsPagesController extends BaseController
	{

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/")]
		public function versionHome(): string
		{
			return Renderer::renderView("docs/v1/home.html");
		}

		#[Route("GET", "/quick-start")]
		public function quickStart(): string
		{
			return Renderer::renderView("docs/v1/quick-start.html");
		}

		#[Route("GET", "/nox-configs")]
		public function noxConfigsMainView(): string
		{
			return Renderer::renderView("docs/v1/configs/main.html");
		}

		#[Route("GET", "/nox-configs/json-config")]
		public function noxJSONConfigView(): string
		{
			return Renderer::renderView("docs/v1/configs/nox-json.html");
		}

		#[Route("GET", "/nox-configs/cache")]
		public function noxJSONCacheView(): string
		{
			return Renderer::renderView("docs/v1/configs/nox-cache.html");
		}

		#[Route("GET", "/nox-configs/mime")]
		public function noxJSONMimeView(): string
		{
			return Renderer::renderView("docs/v1/configs/nox-mime.html");
		}

		#[Route("GET", "/nox-configs/environment")]
		public function noxEnvironmentView(): string
		{
			return Renderer::renderView("docs/v1/configs/nox-env.html");
		}

		#[Route("GET", "/nox-configs/request")]
		public function noxRequestView(): string
		{
			return Renderer::renderView("docs/v1/configs/nox-request.html");
		}

		#[Route("GET", "/static-file-serving")]
		public function staticFileServingView(): string
		{
			return Renderer::renderView("docs/v1/static-file-serving.html");
		}

		#[Route("GET", "/routing")]
		public function routeView(): string
		{
			return Renderer::renderView("docs/v1/routing/main.html");
		}

		#[Route("GET", "/routing/redirecting-rewriting")]
		public function routeRedirectsAndRewrites(): string
		{
			return Renderer::renderView("docs/v1/routing/redirecting-rewriting.html");
		}

		#[Route("GET", "/routing/dynamic-routing")]
		public function dynamicRouteView(): string
		{
			return Renderer::renderView("docs/v1/routing/dynamic-routing.html");
		}

		#[Route("GET", "/routing/fetching-available-routes")]
		public function fetchAvailableRoutesRedirect(): Redirect
		{
			return new Redirect(
				path: "/docs/1.x/how-to/fetching-available-routes",
				statusCode: 301,
			);
		}

		#[Route("GET", "/routing/custom-route-method-attribute")]
		public function routeMethodAttributeView(): string
		{
			return Renderer::renderView("docs/v1/routing/custom-method-attributes.html");
		}

		#[Route("GET", "/layouts")]
		public function layoutsView(): string
		{
			return Renderer::renderView("docs/v1/layouts.html");
		}

		#[Route("GET", "/views")]
		public function viewsView(): string
		{
			return Renderer::renderView("docs/v1/views/views.html");
		}

		#[Route("GET", "/views/view-scope")]
		public function viewScopeView(): string
		{
			return Renderer::renderView("docs/v1/views/view-scope.html");
		}

		#[Route("GET", "/orm")]
		public function ormView(): string
		{
			return Renderer::renderView("docs/v1/orm/main.html");
		}

		#[Route("GET", "/orm/models")]
		public function ormModelsView(): string
		{
			return Renderer::renderView("docs/v1/orm/models.html");
		}

		#[Route("GET", "/orm/model-class-instances")]
		public function ormModelClassView(): string
		{
			return Renderer::renderView("docs/v1/orm/model-class-instances.html");
		}

		#[Route("GET", "/orm/making-queries")]
		public function ormModelClassQueriesView(): string
		{
			return Renderer::renderView("docs/v1/orm/making-queries.html");
		}

		#[Route("GET", "/orm/making-queries/query-clauses")]
		public function ormQueryClausesView(): string
		{
			return Renderer::renderView("docs/v1/orm/query-clauses.html");
		}

		#[Route("GET", "/how-to/fetching-available-routes")]
		public function fetchAvailableRoutesView(): string
		{
			return Renderer::renderView("docs/v1/how-to/fetching-all-available-routes.html");
		}

		#[Route("GET", "/how-to/rest-api-processing")]
		public function processingRESTfulAPIs(): string
		{
			return Renderer::renderView("docs/v1/how-to/rest-api-processing.html");
		}

		#[Route("GET", "/how-to/syncing-models")]
		public function syncingModels(): string
		{
			return Renderer::renderView("docs/v1/how-to/syncing-models.html");
		}
	}