<?php

	namespace NoxDocumentation\Docs\V2\Routing;

	use Nox\Http\Redirect;
	use Nox\RenderEngine\Exceptions\LayoutDoesNotExist;
	use Nox\RenderEngine\Exceptions\ParseError;
	use Nox\RenderEngine\Exceptions\ViewFileDoesNotExist;
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;
	use NoxDocumentation\Docs\SetDocVersion;
	use NoxDocumentation\ParsedownWrapper\ParsedownWrapper;

	#[Controller]
	#[RouteBase("/docs/2.0/routing")]
	#[SetDocVersion("2.0")]
	class DocsRoutingController extends BaseController
	{

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/")]
		public function configsHomeView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Setting Up Controller Routes in Nox",
					"description"=>"Nox PHP allows you to use attribute MVC routes in its framework. Learn how here.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/routing/routing.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/redirecting-rewriting")]
		public function redirectsRewritesView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Redirecting & Rewriting Nox Requests",
					"description"=>"Routes can return a Rewrite or a Redirect object to tell the router to re-perform a request with a different URI.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/routing/redirecting-rewriting.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/custom-route-method-attribute")]
		public function customRouteAttributes(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Custom Nox Router-Recognized Attributes",
					"description"=>"Learn how to create custom PHP attributes that the Nox router will recognize.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/routing/custom-attributes.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/dynamic-routing")]
		public function dynamicRoutesView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Dynamic Routes in Nox",
					"description"=>"Dynamic routes are runtime defined routes that do not use PHP 8 attributes.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/routing/dynamic-routes.md")
					),
				],
			);
		}

	}