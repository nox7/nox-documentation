<?php

	namespace NoxDocumentation\Docs\V1\Routing;

	use Nox\Http\Redirect;
	use Nox\RenderEngine\Exceptions\LayoutDoesNotExist;
	use Nox\RenderEngine\Exceptions\ParseError;
	use Nox\RenderEngine\Exceptions\ViewFileDoesNotExist;
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;
	use NoxDocumentation\Docs\DocumentationFilePath;
	use NoxDocumentation\Docs\Queryable;
	use NoxDocumentation\Docs\SetDocVersion;
	use NoxDocumentation\ParsedownWrapper\ParsedownWrapper;

	#[Controller]
	#[RouteBase("/docs/1.x/routing")]
	#[SetDocVersion("1.0")]
	class DocsRoutingController extends BaseController
	{

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/")]
		#[Queryable]
		#[DocumentationFilePath(__DIR__ . "/../../../../resources/documentation/v1/routing/main.md")]
		public function routingMainView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v1/page.php",
				viewScope:[
					"title"=>"Routing - Nox PHP Framework",
					"description"=>"",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/routing/main.md")
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
		#[Queryable]
		#[DocumentationFilePath(__DIR__ . "/../../../../resources/documentation/v1/routing/redirecting-rewriting.md")]
        public function redirectsRewritesView(): string
        {
            return Renderer::renderView(
                viewFileName: "docs/v1/page.php",
                viewScope:[
                    "title"=>"Redirecting &amp; Rewriting Requests - Nox PHP Framework",
                    "description"=>"",
                    "body"=>ParsedownWrapper::get()->toHtml(
                        file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/routing/redirecting-rewriting.md")
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
		#[Queryable]
		#[DocumentationFilePath(__DIR__ . "/../../../../resources/documentation/v1/routing/custom-method-attributes.md")]
        public function customAttributesView(): string
        {
            return Renderer::renderView(
                viewFileName: "docs/v1/page.php",
                viewScope:[
                    "title"=>"Custom Method Attributes - Nox PHP Framework",
                    "description"=>"",
                    "body"=>ParsedownWrapper::get()->toHtml(
                        file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/routing/custom-method-attributes.md")
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
		#[Queryable]
		#[DocumentationFilePath(__DIR__ . "/../../../../resources/documentation/v1/routing/dynamic-routing.md")]
        public function dynamicRoutingView(): string
        {
            return Renderer::renderView(
                viewFileName: "docs/v1/page.php",
                viewScope:[
                    "title"=>"Dynamic Routing - Nox PHP Framework",
                    "description"=>"",
                    "body"=>ParsedownWrapper::get()->toHtml(
                        file_get_contents(__DIR__ . "/../../../../resources/documentation/v1/routing/dynamic-routing.md")
                    ),
                ],
            );
        }
	}