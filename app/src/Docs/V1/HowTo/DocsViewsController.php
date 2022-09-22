<?php

	namespace NoxDocumentation\Docs\V1\Views;

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
	#[RouteBase("/docs/1.x/how-to")]
	#[SetDocVersion("1.0")]
	class DocsHowToController extends BaseController
	{

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/syncing-models")]
		public function syncingModelsView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v1/page.php",
				viewScope:[
					"title"=>"Syncing PHP Model Class to Your MySQL Database",
					"description"=>"",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/how-to/syncing-models.md")
					),
				],
			);
		}

        /**
         * @throws ParseError
         * @throws ViewFileDoesNotExist
         * @throws LayoutDoesNotExist
         */
        #[Route("GET", "/fetching-available-routes")]
        public function fetchAvailableRoutesView(): string
        {
            return Renderer::renderView(
                viewFileName: "docs/v1/page.php",
                viewScope:[
                    "title"=>"Fetching Accessible Routes - Nox PHP Framework",
                    "description"=>"",
                    "body"=>ParsedownWrapper::get()->toHtml(
                        file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/how-to/fetching-all-available-routes.md")
                    ),
                ],
            );
        }

        /**
         * @throws ParseError
         * @throws ViewFileDoesNotExist
         * @throws LayoutDoesNotExist
         */
        #[Route("GET", "/rest-api-processing")]
        public function restAPIProcessingView(): string
        {
            return Renderer::renderView(
                viewFileName: "docs/v1/page.php",
                viewScope:[
                    "title"=>"Processing RESTful APIs - Nox PHP Framework",
                    "description"=>"",
                    "body"=>ParsedownWrapper::get()->toHtml(
                        file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/how-to/rest-api-processing.md"),
                    ),
                ],
            );
        }

	}