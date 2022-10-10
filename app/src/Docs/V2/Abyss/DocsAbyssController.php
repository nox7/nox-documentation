<?php

	namespace NoxDocumentation\Docs\V2\Abyss;

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
	#[RouteBase("/docs/2.0/orm")]
	#[SetDocVersion("2.0")]
	class DocsAbyssController extends BaseController
	{

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/")]
		#[Queryable]
		#[DocumentationFilePath(__DIR__ . "/../../../../resources/documentation/v2/abyss/main.md")]
		public function abyssHomeView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Introducing Abyss - the ORM for Nox",
					"description"=>"Avoid dealing with MySQL syntax by utilizing the Nox framework ORM - Abyss.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/abyss/main.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/models")]
		#[Queryable]
		#[DocumentationFilePath(__DIR__ . "/../../../../resources/documentation/v2/abyss/models.md")]
		public function abyssModelsView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Models - MySQL Database Table Representations",
					"description"=>"Models are pure PHP methods to model out database tables and their columns without having to deal with SQL syntax.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/abyss/models.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/model-class-instances")]
		#[Queryable]
		#[DocumentationFilePath(__DIR__ . "/../../../../resources/documentation/v2/abyss/model-class-instances.md")]
		public function abyssModelClassInstancesView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Model Class Instances",
					"description"=>"Each model class instance is a representation of a row in a table - using pure object-oriented PHP syntax.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/abyss/model-class-instances.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/making-queries")]
		#[Queryable]
		#[DocumentationFilePath(__DIR__ . "/../../../../resources/documentation/v2/abyss/making-queries.md")]
		public function abyssMakingQueriesView(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Querying Model Classes in Nox Abyss",
					"description"=>"Learn how to run queries on model classes to fetch individual MySQL rows or collections.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/abyss/making-queries.md")
					),
				],
			);
		}

		/**
		 * @throws ParseError
		 * @throws ViewFileDoesNotExist
		 * @throws LayoutDoesNotExist
		 */
		#[Route("GET", "/synchronizing-models")]
		#[Queryable]
		#[DocumentationFilePath(__DIR__ . "/../../../../resources/documentation/v2/abyss/synchronizing-models.md")]
		public function abyssSynchronizingModelsViews(): string
		{
			return Renderer::renderView(
				viewFileName: "docs/v2/page.php",
				viewScope:[
					"title"=>"Synchronizing Models to a Database",
					"description"=>"Your MySQL tables and columns don't existing in your local database until you run a model synchronization.",
					"body"=>ParsedownWrapper::get()->toHtml(
						file_get_contents(__DIR__ . "/../../../../resources/documentation/v2/abyss/synchronizing-models.md")
					),
				],
			);
		}

	}