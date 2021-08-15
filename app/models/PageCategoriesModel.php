<?php

	use \Nox\ORM\ColumnDefinition;
	use \Nox\ORM\Interfaces\MySQLModelInterface;
	use \Nox\ORM\MySQLDataTypes\Integer;
	use \Nox\ORM\MySQLDataTypes\VariableCharacter;

	class PageCategoriesModel implements MySQLModelInterface {

		/**
		 * The name of this Model in the MySQL database as a table
		 */
		private string $mysqlTableName = "page_categories";

		/**
		 * The string name of the class this model represents and can instantiate
		 */
		private string $representingClassName = "PageCategory";

		public function getName(): string{
			return $this->mysqlTableName;
		}

		public function getInstanceName(): string{
			return $this->representingClassName;
		}

		public function getColumns(): array{
			return [
				new ColumnDefinition(
					name:"id",
					classPropertyName: "id",
					dataType : new Integer(),
					defaultValue: 0,
					autoIncrement: true,
					isPrimary: true,
					isNull:false,
				),
				new ColumnDefinition(
					name:"parent_category_id",
					classPropertyName: "parentCategoryID",
					dataType : new Integer(),
					defaultValue: null,
					isNull:true,
				),
				new ColumnDefinition(
					name:"name",
					classPropertyName: "name",
					dataType : new VariableCharacter(65),
					defaultValue: "",
				),
				new ColumnDefinition(
					name:"route_base",
					classPropertyName: "routeBase",
					dataType : new VariableCharacter(255),
					defaultValue:"",
				),
			];
		}
	}
