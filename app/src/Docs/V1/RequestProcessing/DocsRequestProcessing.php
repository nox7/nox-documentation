<?php

	namespace NoxDocumentation\Docs\V1\RequestProcessing;

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
	#[RouteBase("/docs/1.x/request-processing")]
	#[SetDocVersion("1.0")]
	class DocsRequestProcessing extends BaseController
	{

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/payloads")]
		public function requestProcessingPayloadsView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Processing Request Payloads",
					"description"=>"Natively PHP only supports GET and POST payload processing. Nox allows you to process payloads of any HTTP method.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/request-processing/payloads.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/json-responses")]
		public function jsonRequestResponseView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Supported JSON Responses to Requests",
					"description"=>"Nox has a few helper classes to make responding in JSON more understandable and seamless.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/request-processing/json-response.md")
					),
				],
			);
		}

	}