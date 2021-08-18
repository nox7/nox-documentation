<?php

	use Nox\Router\Attributes\Route;

	class PageSearch{

		const NEEDLE_PADDING = 125;

		public array $eligibleRoutes;

		/**
		 * Attempts to fetch a truncated bit of text around the first search result match
		 * @param string $body
		 * @return string
		 */
		public static function getTruncatedBodyOfFirstQueryMatch(string $body, string $query): string{
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
				return substr($body, $startLocation, ($endLocation - $startLocation));
			}
		}

		public function __construct(
			/** A list of classes to check routes of */
			public array $classesToSearch
		){}

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
						/** @var \Nox\Router\Attributes\RouteBase $baseInstance */
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
						$attributes = $reflectionMethod->getAttributes();
						foreach ($attributes as $reflectionAttribute) {
							if ($reflectionAttribute->getName() === "Nox\Router\Attributes\Route") {
								/** @var Route $routeInstance */
								$routeInstance = $reflectionAttribute->newInstance();
								$httpMethodForRoute = strtolower($routeInstance->method);
								if ($httpMethodForRoute === "get" && $routeInstance->isRegex === false) {
									// This route is searchable
									// Get the rendered result
									$pageHTML = $reflectionMethod->invoke($newClassInstance);
									preg_match("/<main>(.+)<\/main>/ism", $pageHTML, $bodyMatches);
									preg_match("/<h1>(.+)<\/h1>/ism", $pageHTML, $titleMatches);
									$searchableRoutesAndBodies[] = [
										"uri" => $routeBase . $routeInstance->uri,
										"body" => $bodyMatches[1],
										"title"=> $titleMatches[1],
									];
								}
							}
						}
					}
				}
			}

			$this->eligibleRoutes = $searchableRoutesAndBodies;
		}

		/**
		 * @param string $query
		 * @return array{uri: string, body: string, title: string}
		 */
		public function getRoutesForQuery(string $query): array{
			$matchingRoutes = [];

			/** @var array $routeData */
			foreach($this->eligibleRoutes as $routeData){
				$uri = $routeData['uri'];
				$pageBody = $routeData['body'];
				$pageTitle = $routeData['title'];
				if (
					str_contains(strtolower($pageBody), strtolower($query))
					||
					str_contains(strtolower($pageTitle), strtolower($query))
				){
					$matchingRoutes[] = $routeData;
				}
			}

			return $matchingRoutes;
		}
	}