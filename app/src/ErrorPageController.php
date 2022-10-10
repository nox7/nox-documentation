<?php

	namespace NoxDocumentation;

	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\BaseController;

	#[Controller]
	class ErrorPageController extends BaseController{

		#[Route("GET", "/404")]
		public function notFoundView(): string{
			return Renderer::renderView("errors/404.html");
		}
	}