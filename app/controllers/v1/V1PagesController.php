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

		#[Route("GET", "/routing")]
		public function routeView(): string{
			return Renderer::renderView("docs/v1/routing.html");
		}

		#[Route("GET", "/routing/custom-route-method-attribute")]
		public function routeMethodAttributeView(): string{
			return Renderer::renderView("docs/v1/custom-method-attributes.html");
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
			return Renderer::renderView("docs/v1/orm.html");
		}
	}