<?php

	namespace NoxDocumentation;

	use Nox\Router\Attributes\Controller;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;
	use Nox\Router\BaseController;
	use NoxDocumentation\Docs\SearchService;
	use ReflectionClass;
	use SimpleXMLElement;

	#[Controller]
	class SitemapController extends BaseController{

		#[Route("get", "/sitemap.xml")]
		public function sitemapXMLView(): string{
			header('Content-type: text/xml');
			header('Pragma: public');

			$allQueryableMethods = SearchService::getAllQueryableControllerMethods();
			$urlSet = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><urlset></urlset>");
			$urlSet->addAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
			$baseURL = sprintf("https://%s", $_SERVER['HTTP_HOST']);

			foreach($allQueryableMethods as $reflectionMethod){
				$classReflection = new ReflectionClass($reflectionMethod->class);
				$routeBaseReflectionAttributes = $classReflection->getAttributes(
					name: RouteBase::class,
				);

				$routeBase = "";
				if (!empty($routeBaseReflectionAttributes)){
					/** @var RouteBase $routeBaseAttribute */
					$routeBaseAttribute = $routeBaseReflectionAttributes[0]->newInstance();
					$routeBase = $routeBaseAttribute->uri;
				}

				$routeReflectionAttributes = $reflectionMethod->getAttributes(
					name: Route::class,
				);

				$routeReflectionAttribute = $routeReflectionAttributes[0];

				/** @var Route $routeAttribute */
				$routeAttribute = $routeReflectionAttribute->newInstance();
				$fullURI = $routeBase . $routeAttribute->uri;

				$url = $urlSet->addChild("url");
				$url->addChild("loc", sprintf("%s%s", $baseURL,$fullURI));
			}

			return $urlSet->asXML();
		}
	}