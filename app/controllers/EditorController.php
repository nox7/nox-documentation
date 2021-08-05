<?php

	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;

	#[RouteBase("/admin")]
	class EditorController extends \Nox\Router\BaseController{

		#[Route("GET", "/editor")]
		public function editorMain(): string{
			return Renderer::renderView("editor/main.php");
		}
	}