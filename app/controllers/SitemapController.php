<?php
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Route;
	use Nox\Router\BaseController;

	class SitemapController extends BaseController{

		#[Route("get", "/sitemap.xml")]
		public function sitemapXMLView(): string{
			header('Content-type: text/xml');
			header('Pragma: public');

			$isSSLOn = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? true : false;
			$baseURL = sprintf(
				"http%s://%s",
				$isSSLOn ? "s" : "",
				$_SERVER['HTTP_HOST'],
				//$_SERVER['SERVER_PORT'] !== 80 ? (":" . $_SERVER['SERVER_PORT']) : "",
			);
			$router = parent::$requestHandler->router;
			$allAvailableURIs = $router->getAllAccessibleRouteURIs();
			$urlSet = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><urlset></urlset>");
			$urlSet->addAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");

			foreach($allAvailableURIs as $uri){
				$url = $urlSet->addChild("url");
				$url->addChild("loc", sprintf("%s%s", $baseURL,$uri));
			}

			return $urlSet->asXML();
		}
	}