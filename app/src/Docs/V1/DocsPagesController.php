<?php

	namespace NoxDocumentation\Docs\V1;

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
	#[RouteBase("/docs/1.x")]
	#[SetDocVersion("1.0")]
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
			return Renderer::renderView(
				viewFileName: "docs/v1/page.php",
				viewScope:[
					"title"=>"V1.x Docs - Nox PHP Framework",
					"description"=>"",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../resources/documentation/v1/home.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/quick-start")]
		public function installationView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v1/page.php",
				viewScope:[
					"title"=>"Quick Start - Installation - Nox PHP Framework",
					"description"=>"",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../resources/documentation/v1/quick-start.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/static-file-serving")]
		public function staticFileServingView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v1/page.php",
				viewScope:[
					"title"=>"Serving Static Files - Nox PHP Framework",
					"description"=>"",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../resources/documentation/v1/static-file-serving.md")
					),
				],
			);
		}

        /**
         * @throws ParseError
         * @throws ViewFileDoesNotExist
         * @throws LayoutDoesNotExist
         */
        #[Route("GET", "/layouts")]
        public function layoutsView(): string
        {
            return Renderer::renderView(
                viewFileName: "docs/v1/page.php",
                viewScope:[
                    "title"=>"View Layouts - Nox PHP Framework",
                    "description"=>"",
                    "body"=>ParsedownWrapper::get()->toHtml(
                        file_get_contents(__DIR__ . "/../../../resources/documentation/v1/layouts.md")
                    ),
                ],
            );
        }
	}