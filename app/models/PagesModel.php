<?php

	use \Nox\ORM\ColumnDefinition;
	use \Nox\ORM\Interfaces\MySQLModelInterface;
	use \Nox\ORM\MySQLDataTypes\Integer;
	use \Nox\ORM\MySQLDataTypes\VariableCharacter;

	class PagesModel implements MySQLModelInterface {

		/**
		 * The name of this Model in the MySQL database as a table
		 */
		private string $mysqlTableName = "page";

		/**
		 * The string name of the class this model represents and can instantiate
		 */
		private string $representingClassName = "Page";

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
					name:"category_id",
					classPropertyName: "categoryID",
					dataType : new Integer(),
					defaultValue: null,
					isNull:true,
				),
				new ColumnDefinition(
					name:"title",
					classPropertyName: "title",
					dataType : new VariableCharacter(255),
					defaultValue: "",
				),
				new ColumnDefinition(
					name:"route",
					classPropertyName: "route",
					dataType : new VariableCharacter(255),
					defaultValue: "",
				),
				new ColumnDefinition(
					name:"body",
					classPropertyName: "body",
					dataType : new \Nox\ORM\MySQLDataTypes\MediumText(),
					defaultValue: "",
				),
				new ColumnDefinition(
					name:"head",
					classPropertyName: "head",
					dataType : new \Nox\ORM\MySQLDataTypes\MediumText(),
					defaultValue: "",
				),
				new ColumnDefinition(
					name:"creation_timestamp",
					classPropertyName: "creationTimestamp",
					dataType : new Integer(),
					defaultValue: time(),
				),
			];
		}
	}
