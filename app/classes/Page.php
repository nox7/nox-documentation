<?php

	require_once __DIR__ . "/../models/PagesModel.php";

	use Nox\ORM\Abyss;
	use Nox\ORM\Interfaces\ModelInstance;
	use Nox\ORM\Interfaces\MySQLModelInterface;
	use Nox\ORM\ModelClass;

	class Page extends ModelClass implements ModelInstance
	{
		public ?int $id = null;
		public ?int $categoryID;
		public string $title;
		public string $route;
		public string $body;
		public string $head;
		public int $creationTimestamp;

		public static function getModel(): MySQLModelInterface{
			return new PagesModel();
		}

		public function __construct(){
			parent::__construct($this);
		}

		/**
		 * Traverses up the parent categoryIDs until it hits
		 * a page category with a null parent category ID. Then builds
		 * the route
		 */
		public function getFullRoute(): string{
			// These routes are in the order of the child to parent.
			// So it will need to be reversed before constructing the route base
			$parentRoutes = [];
			if ($this->categoryID !== null) {
				$abyss = new Abyss();
				$parentCategoryID = $this->categoryID;
				do {
					/** @var PageCategory $pageCategory */
					$pageCategory = $abyss->fetchInstanceByModelPrimaryKey(
						model:PageCategory::getModel(),
						keyValue: $parentCategoryID,
					);
					if ($pageCategory !== null){
						$parentRoutes[] = $pageCategory->routeBase;
						$parentCategoryID = $pageCategory->parentCategoryID;
					}else{
						$parentCategoryID = null;
					}
				}while ($parentCategoryID !== null);
			}

			$reversedParentRoutes = array_reverse($parentRoutes);
			return sprintf("%s%s", implode("", $reversedParentRoutes), $this->route);
		}
	}