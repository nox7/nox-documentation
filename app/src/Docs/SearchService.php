<?php
	namespace NoxDocumentation\Docs;

	use Nox\ClassLoader\ClassLoader;
	use ReflectionMethod;

	class SearchService{

		public static function doesTextContainQuery(string $text, string $query): bool{
			$textLowered = strtolower($text);
			$queryLowered = strtolower($query);

			if (str_contains($textLowered, $queryLowered)){
				return true;
			}

			return false;
		}

		/**
		 * @param string $docsVersion Example, "2.0" or "1.0"
		 * @return ReflectionMethod[]
		 */
		public static function query(string $docsVersion, string $query): array{
			$controllerClassReflections = ClassLoader::$controllerClassReflections;

			// Fetch all the controller classes that have SetDocVersion attributes
			/** @var ReflectionMethod[] $methodsToTestForQueryable */
			$methodsToTestForQueryable = [];
			foreach($controllerClassReflections as $classReflection){
				$classAttributes = $classReflection->getAttributes(
					name: SetDocVersion::class,
					flags: \ReflectionAttribute::IS_INSTANCEOF,
				);

				if (!empty($classAttributes)){
					/** @var SetDocVersion $instanceOfFirstDocVersionAttribute */
					$instanceOfFirstDocVersionAttribute = $classAttributes[0]->newInstance();
					if ($instanceOfFirstDocVersionAttribute->version === $docsVersion){
						$methodsToTestForQueryable[] = $classReflection->getMethods(
							filter: ReflectionMethod::IS_PUBLIC,
						);
					}
				}
			}

			// Find all methods that have the Queryable attribute
			/** @var ReflectionMethod[] $methodsToQuery */
			$methodsToQuery = [];
			foreach($methodsToTestForQueryable as $reflectionMethod){
				// Check for the Queryable attribute, add it to methods to query
				$methodAttributes = $reflectionMethod->getAttributes(
					name: Queryable::class,
				);

				if (!empty($methodAttributes)){
					$methodsToQuery[] = $reflectionMethod;
				}
			}

			// Go through the methods to query, get the documentation file that method represents
			// search that file for the query string
			/** @var ReflectionMethod[] $methodsThatMatchQuery */
			$methodsThatMatchQuery = [];
			foreach($methodsToQuery as $reflectionMethod){
				$documentationFileAttributes = $reflectionMethod->getAttributes(
					name: DocumentationFilePath::class,
				);

				if (!empty($documentationFileAttributes)){
					/** @var DocumentationFilePath $documentationFileAttribute */
					$documentationFileAttribute = $documentationFileAttributes[0]->newInstance();
					$filePath = $documentationFileAttribute->filePath;
					$fileContents = file_get_contents($filePath);

					if (self::doesTextContainQuery($fileContents, $query)){
						$methodsThatMatchQuery[] = $reflectionMethod;
					}
				}
			}

			return $methodsThatMatchQuery;
		}
	}