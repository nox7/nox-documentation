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
	}