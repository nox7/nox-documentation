<?php

	namespace NoxDocumentation\Docs\V2\Configs;

	use Nox\Http\Redirect;
	use Nox\RenderEngine\Exceptions\LayoutDoesNotExist;
	use Nox\RenderEngine\Exceptions\ParseError;
	use Nox\RenderEngine\Exceptions\ViewFileDoesNotExist;
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;
	use NoxDocumentation\ParsedownWrapper\ParsedownWrapper;

	#[Controller]
	#[RouteBase("/docs/2.0/views")]
	class DocsViewsController extends BaseController
	{

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/")]
		public function viewsHomeView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"View Files in Nox MVC",
					"description"=>"Views are the public pages or responses that a user is given to an HTTP request.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/views/main.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/view-scope")]
		public function viewScopeView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Sending Data to a View from a Controller - View Scopes",
					"description"=>"A view's view scope is data that has been sent directly from the controller for use in an individual view file.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/views/view-scope.md")
					),
				],
			);
		}

	}