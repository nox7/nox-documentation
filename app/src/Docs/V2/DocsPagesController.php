<?php

	namespace Docs\V2;

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
	#[RouteBase("/docs/2")]
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
			return Renderer::renderView("docs/v2/home.html");
		}

		#[Route("GET", "/installation")]
		public function quickStart(): string
		{
			return Renderer::renderView("docs/v2/installation.html");
		}

		#[Route("GET", "/nox-configuration")]
		public function noxConfigsMainView(): string
		{
			return Renderer::renderView("docs/v2/configs/main.html");
		}


		#[Route("GET", "/nox-configs/static-file-serving")]
		public function noxRequestView(): string
		{
			return Renderer::renderView("docs/v2/configs/static-file-serving.html");
		}

		#[Route("GET", "/nox-configs/static-file-cache-control")]
		public function noxStaticFileCacheControl(): string
		{
			return Renderer::renderView("docs/v2/configs/static-file-cache-control.html");
		}

		#[Route("GET", "/nox-configs/registering-mime-types")]
		public function noxRegisteringMimeTypes(): string
		{
			return Renderer::renderView("docs/v2/configs/registering-mime-types.html");
		}

		#[Route("GET", "/nox-configs/defining-views-directory")]
		public function noxRegisteringViewsDirectory(): string
		{
			return Renderer::renderView("docs/v2/configs/define-views-directory.html");
		}

		#[Route("GET", "/nox-configs/defining-layouts-directory")]
		public function noxRegisteringLayoutsDirectory(): string
		{
			return Renderer::renderView("docs/v2/configs/defining-layouts-directory.html");
		}

		#[Route("GET", "/nox-configs/setting-project-source-directory")]
		public function noxRegisteringSourceDirectory(): string
		{
			return Renderer::renderView("docs/v2/configs/setting-source-code-directory.html");
		}

		#[Route("GET", "/routing")]
		public function routeView(): string
		{
			return Renderer::renderView("docs/v2/routing/main.html");
		}

		#[Route("GET", "/routing/redirecting-rewriting")]
		public function routeRedirectsAndRewrites(): string
		{
			return Renderer::renderView("docs/v2/routing/redirecting-rewriting.html");
		}

		#[Route("GET", "/routing/dynamic-routing")]
		public function dynamicRouteView(): string
		{
			return Renderer::renderView("docs/v2/routing/dynamic-routing.html");
		}

		#[Route("GET", "/routing/fetching-available-routes")]
		public function fetchAvailableRoutesRedirect(): Redirect
		{
			return new Redirect(
				path: "/docs/2/how-to/fetching-available-routes",
				statusCode: 301,
			);
		}

		#[Route("GET", "/routing/custom-route-method-attribute")]
		public function routeMethodAttributeView(): string
		{
			return Renderer::renderView("docs/v2/routing/custom-method-attributes.html");
		}

		#[Route("GET", "/layouts")]
		public function layoutsView(): string
		{
			return Renderer::renderView("docs/v2/layouts.html");
		}

		#[Route("GET", "/views")]
		public function viewsView(): string
		{
			return Renderer::renderView("docs/v2/views/views.html");
		}

		#[Route("GET", "/views/view-scope")]
		public function viewScopeView(): string
		{
			return Renderer::renderView("docs/v2/views/view-scope.html");
		}

		#[Route("GET", "/orm")]
		public function ormView(): string
		{
			return Renderer::renderView("docs/v2/orm/main.html");
		}

		#[Route("GET", "/orm/models")]
		public function ormModelsView(): string
		{
			return Renderer::renderView("docs/v2/orm/models.html");
		}

		#[Route("GET", "/orm/model-class-instances")]
		public function ormModelClassView(): string
		{
			return Renderer::renderView("docs/v2/orm/model-class-instances.html");
		}

		#[Route("GET", "/orm/making-queries")]
		public function ormModelClassQueriesView(): string
		{
			return Renderer::renderView("docs/v2/orm/making-queries.html");
		}

		#[Route("GET", "/orm/making-queries/query-clauses")]
		public function ormQueryClausesView(): string
		{
			return Renderer::renderView("docs/v2/orm/query-clauses.html");
		}

		#[Route("GET", "/how-to/rest-api-processing")]
		public function processingRESTfulAPIs(): string
		{
			return Renderer::renderView("docs/v2/how-to/rest-api-processing.html");
		}

		#[Route("GET", "/how-to/syncing-models")]
		public function syncingModels(): string
		{
			return Renderer::renderView("docs/v2/how-to/syncing-models.html");
		}
	}