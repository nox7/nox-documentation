<?php

	namespace Utils;

	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use ReflectionClass;
	use ReflectionNamedType;
	use Utils\PageSearch\EligibleRoute;

	class PageSearch{

		const NEEDLE_PADDING = 125;

		/**
		 * @var EligibleRoute[]
		 */
		public array $eligibleRoutes;

		/**
		 * Attempts to fetch a truncated bit of text around the first search result match
		 * @param string $body
		 * @return string
		 */
		public static function getTruncatedBodyOfFirstQueryMatch(
			string $body,
			string $query,
			bool $highlightResult,
		): string{
			$body = strip_tags($body);
			$needlePosition = strpos(strtolower($body), strtolower($query));
			if ($needlePosition === false){
				return substr($body, 0, self::NEEDLE_PADDING*2);
			}else{
				$endOfQueryLocation = $needlePosition + strlen($query);
				$startLocation = $needlePosition - self::NEEDLE_PADDING;
				$endLocation = $endOfQueryLocation + self::NEEDLE_PADDING;

				if ($startLocation < 0){
					$startLocation = 0;
				}

				if ($endLocation > strlen($body)){
					$endLocation = strlen($body);
				}

				if (!$highlightResult) {
					return substr($body, $startLocation, ($endLocation - $startLocation));
				}else{
					$stub = substr($body, $startLocation, ($endLocation - $startLocation));
					return preg_replace("/(" . preg_quote($query) . ")/i", "<span class=\"query-result-in-body\">$1</span>", $stub);
				}
			}
		}

		public function __construct(
			/** A list of classes to check routes of */
			public array $classesToSearch
		){}

		/**
		 * @throws \ReflectionException
		 */
		public function loadEligibleRoutes(): void{
			$searchableRoutesAndBodies = [];
			/** @var object $class */
			foreach($this->classesToSearch as $class) {
				$newClassInstance = new $class();
				$classReflection = new ReflectionClass($class);
				$routeBase = "";

				// Fetch the route base, if there is one
				foreach($classReflection->getAttributes() as $reflectionAttribute){
					if ($reflectionAttribute->getName() === "Nox\\Router\\Attributes\\RouteBase"){
						/** @var RouteBase $baseInstance */
						$baseInstance = $reflectionAttribute->newInstance();
						$routeBase = $baseInstance->uri;
						break;
					}
				}

				// Fetch all the routes and HTML that are eligible to be searched
				// They must have a GET route that is non-regex and a method which returns a string
				foreach ($classReflection->getMethods() as $reflectionMethod) {
					/** @var ReflectionNamedType $returnType */
					$returnType = $reflectionMethod->getReturnType();
					// Check this method only returns a string
					if ($returnType->getName() === "string") {
						$attributes = $reflectionMethod->getAttributes(
							name:Route::class,
							flags:\ReflectionAttribute::IS_INSTANCEOF,
						);
						foreach ($attributes as $reflectionAttribute) {
							/** @var Route $routeInstance */
							$routeInstance = $reflectionAttribute->newInstance();
							$httpMethodForRoute = strtolower($routeInstance->method);
							if ($httpMethodForRoute === "get" && $routeInstance->isRegex === false) {
								// This route is searchable
								// Get the rendered result
								$pageHTML = $reflectionMethod->invoke($newClassInstance);
								preg_match("/<main>(.+)<\/main>/ism", $pageHTML, $bodyMatches);
								preg_match("/<h1>(.+)<\/h1>/ism", $pageHTML, $titleMatches);
								$searchableRoutesAndBodies[] = new EligibleRoute(
									uri: $routeBase . $routeInstance->uri,
									title:$titleMatches[1],
									body:$bodyMatches[1]
								);
							}
						}
					}
				}
			}

			$this->eligibleRoutes = $searchableRoutesAndBodies;
		}

		/**
		 * @param string $query
		 * @return EligibleRoute[]
		 */
		public function getEligibleRoutesForQuery(string $query): array{
			$matchingRoutes = [];

			foreach($this->eligibleRoutes as $eligibleRoute){
				$pageBody = $eligibleRoute->body;
				$pageTitle = $eligibleRoute->title;
				if (
					str_contains(strtolower($pageBody), strtolower($query))
					||
					str_contains(strtolower($pageTitle), strtolower($query))
				){
					$matchingRoutes[] = $eligibleRoute;
				}
			}

			return $matchingRoutes;
		}
	}