<?php

	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\BaseController;

	#[Controller]
	class HomeController extends BaseController{

		#[Route("GET", "/")]
		public function homeView(): string{
			return Renderer::renderView("home.html");
		}
	}