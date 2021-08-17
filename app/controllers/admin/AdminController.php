<?php

	require_once __DIR__ . "/../../classes/PageCategory.php";

	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;

	#[RouteBase("/admin")]
	class AdminController extends BaseController{

		#[Route("GET", "/categories")]
		public function categoriesView(): string{
			$allCategories = PageCategory::getAllCategoriesInHierarchy();
			return Renderer::renderView(
				viewFileName: "categories.php",
				viewScope: ["categories"=>$allCategories],
			);
		}
	}