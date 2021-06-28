<?php
	require_once __DIR__ . "/../vendor/autoload.php";

	$requestPath = parse_url($_SERVER['REQUEST_URI'])['path'];
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	// Load the router
	$router = new Nox\Router\Router(
		requestPath: $requestPath,
		requestMethod: $requestMethod,
	);
	$router->loadAll(__DIR__);

	// Load the request handler
	$requestHandler = new \Nox\Router\RequestHandler(
		$router,
		$requestPath,
		$requestMethod,
	);

	// Process the request
	$requestHandler->processRequest();