<?php
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;

	#[RouteBase("/docs/1.x")]
	class V1PagesController extends BaseController{

		#[Route("GET", "/")]
		public function versionHome(): string{
			return Renderer::renderView("docs/v1/home.html");
		}

		#[Route("GET", "/quick-start")]
		public function quickStart(): string{
			return Renderer::renderView("docs/v1/quick-start.html");
		}

		#[Route("GET", "/routing")]
		public function routeView(): string{
			return Renderer::renderView("docs/v1/routing/main.html");
		}

		#[Route("GET", "/routing/dynamic-routing")]
		public function dynamicRouteView(): string{
			return Renderer::renderView("docs/v1/routing/dynamic-routing.html");
		}

		#[Route("GET", "/routing/fetching-available-routes")]
		public function fetchAvailableRoutesView(): string{
			return Renderer::renderView("docs/v1/routing/fetching-all-available-routes.html");
		}

		#[Route("GET", "/routing/custom-route-method-attribute")]
		public function routeMethodAttributeView(): string{
			return Renderer::renderView("docs/v1/routing/custom-method-attributes.html");
		}

		#[Route("GET", "/layouts")]
		public function layoutsView(): string{
			return Renderer::renderView("docs/v1/layouts.html");
		}

		#[Route("GET", "/views")]
		public function viewsView(): string{
			return Renderer::renderView("docs/v1/views.html");
		}

		#[Route("GET", "/orm")]
		public function ormView(): string{
			return Renderer::renderView("docs/v1/orm/main.html");
		}

		#[Route("GET", "/orm/models")]
		public function ormModelsView(): string{
			return Renderer::renderView("docs/v1/orm/models.html");
		}

		#[Route("GET", "/orm/model-class-instances")]
		public function ormModelClassView(): string{
			return Renderer::renderView("docs/v1/orm/model-class-instances.html");
		}

		#[Route("GET", "/orm/making-queries")]
		public function ormModelClassQueriesView(): string{
			return Renderer::renderView("docs/v1/orm/making-queries.html");
		}

		#[Route("GET", "/orm/making-queries/query-clauses")]
		public function ormQueryClausesView(): string{
			return Renderer::renderView("docs/v1/orm/query-clauses.html");
		}
	}