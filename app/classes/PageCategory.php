<?php

	require_once __DIR__ . "/../models/PageCategoriesModel.php";

	use Nox\ORM\Abyss;
	use Nox\ORM\Interfaces\ModelInstance;
	use Nox\ORM\Interfaces\MySQLModelInterface;
	use Nox\ORM\ModelClass;

	class PageCategory extends ModelClass implements ModelInstance
	{
		public ?int $id = null;
		public ?int $parentCategoryID;
		public string $name;
		public string $routeBase;

		public array $childCategories = [];

		/**
		 * Fetches all of the page categories in an array hierarchy
		 */
		public static function getAllCategoriesInHierarchy(?int $parentCategoryID = null): array{
			$abyss = new Abyss();
			$categories = [];

			if ($parentCategoryID !== null){
				$instances = $abyss->fetchInstances(
					model:self::getModel(),
					columnQuery: (new \Nox\ORM\ColumnQuery())
						->where("parent_category_id", "=", $parentCategoryID),
				);
			}else{
				$instances = $abyss->fetchInstances(
					model:self::getModel(),
					columnQuery: (new \Nox\ORM\ColumnQuery())
						->where("parent_category_id", "IS", "NULL"),
				);
			}

			/**
			 * @var PageCategory $instance
			 */
			foreach($instances as $instance){
				$instance->childCategories = self::getAllCategoriesInHierarchy($instance->id);
				$categories[] = $instance;
			}

			return $categories;
		}

		public static function getModel(): MySQLModelInterface{
			return new PageCategoriesModel();
		}

		public function __construct(){
			parent::__construct($this);
		}
	}