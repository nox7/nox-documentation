<?php

	namespace NoxDocumentation\Docs\V1\Configs;

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
	#[RouteBase("/docs/1.x/nox-configs")]
	#[SetDocVersion("1.0")]
	class DocsConfigPagesController extends BaseController
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
				viewFileName: "docs/v1/page.php",
				viewScope:[
					"title"=>"Configuration Files - Nox PHP Framework",
					"description"=>"",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/config/main.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/json-config")]
		public function mainJSONConfigView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v1/page.php",
				viewScope:[
					"title"=>"Nox Primary JSON Config File - Nox PHP Framework",
					"description"=>"",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/config/nox-json.md")
					),
				],
			);
		}

        /**
         * @throws ParseError
         * @throws ViewFileDoesNotExist
         * @throws LayoutDoesNotExist
         */
        #[Route("GET", "/cache")]
        public function cacheConfigView(): string
        {
            return Renderer::renderView(
                viewFileName: "docs/v1/page.php",
                viewScope:[
                    "title"=>"Static Cache Configuration - Nox PHP Framework",
                    "description"=>"",
                    "body"=>ParsedownWrapper::get()->toHtml(
                        file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/config/nox-cache.md")
                    ),
                ],
            );
        }

        /**
         * @throws ParseError
         * @throws ViewFileDoesNotExist
         * @throws LayoutDoesNotExist
         */
        #[Route("GET", "/mime")]
        public function mimeConfigView(): string
        {
            return Renderer::renderView(
                viewFileName: "docs/v1/page.php",
                viewScope:[
                    "title"=>"Mime Type Recognition - Nox PHP Framework",
                    "description"=>"",
                    "body"=>ParsedownWrapper::get()->toHtml(
                        file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/config/nox-mime.md")
                    ),
                ],
            );
        }

        /**
         * @throws ParseError
         * @throws ViewFileDoesNotExist
         * @throws LayoutDoesNotExist
         */
        #[Route("GET", "/environment")]
        public function pseudoEnvFileView(): string
        {
            return Renderer::renderView(
                viewFileName: "docs/v1/page.php",
                viewScope:[
                    "title"=>"NoxEnv Environment Class - Nox PHP Framework",
                    "description"=>"",
                    "body"=>ParsedownWrapper::get()->toHtml(
                        file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/config/nox-env.md")
                    ),
                ],
            );
        }

        /**
         * @throws ParseError
         * @throws ViewFileDoesNotExist
         * @throws LayoutDoesNotExist
         */
        #[Route("GET", "/request")]
        public function requestHandlerView(): string
        {
            return Renderer::renderView(
                viewFileName: "docs/v1/page.php",
                viewScope:[
                    "title"=>"Nox Request Handler - Nox PHP Framework",
                    "description"=>"",
                    "body"=>ParsedownWrapper::get()->toHtml(
                        file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/config/nox-request.md")
                    ),
                ],
            );
        }
	}