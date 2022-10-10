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
	class RobotsController extends BaseController{

		#[Route("get", "/robots.txt")]
		public function robotsTXTView(): string{
			header('Content-type: text/plain');

			return trim(str_replace("\t", "", <<<ROBOTS
				User-agent: *
				Allow: /
				
				Sitemap: https://noxphp.com/sitemap.xml
			ROBOTS));

		}
	}