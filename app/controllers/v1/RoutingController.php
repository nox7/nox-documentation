<?php
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;

	#[RouteBase("/docs/1.x")]
	class RoutingController extends BaseController{

		#[Route("GET", "/routing")]
		public function routeView(): string{
			return Renderer::renderView("docs/v1/routing.html");
		}
	}