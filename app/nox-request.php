<?php

	use Nox\ORM\Abyss;

	require_once __DIR__ . "/../vendor/autoload.php";
	require_once __DIR__ . "/nox-env.php";
	require_once __DIR__ . "/classes/Page.php";

	$requestPath = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	// Load the router
	$router = new Nox\Router\Router(
		requestPath:$requestPath,
		requestMethod:$requestMethod,
	);
	$router->loadAll(
		fromDirectory: __DIR__,
	);

	// Load the Abyss ORM configuration
	// Abyss::loadConfig(__DIR__);

	// Load the request handler
	$requestHandler = new \Nox\Router\RequestHandler($router);
	\Nox\Router\BaseController::$requestHandler = $requestHandler;

	// Load all pages into the router
	$abyss = new Abyss();
	$pages = $abyss->fetchInstances(
		model:Page::getModel(),
	);
	/** @var Page $page */
	foreach($pages as $page){
		$fullRoute = $page->getFullRoute();
		$router->addDynamicRoute(
			new \Nox\Router\DynamicRoute(
				requestMethod: "get",
				requestPath: $fullRoute,
				isRegex:false,
				onRender: Closure::fromCallable(function() use ($page){
					return $page->getRenderedPage();
				}),
			),
		);
	}

	// Process the request
	$requestHandler->processRequest();