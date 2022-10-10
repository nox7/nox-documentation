# Configuring the Nox Framework
As of version 2, configuring Nox should be done in the framework's <code>nox-request.php</code> file. All configuration is done in PHP. Previously, it was done in JSON but this came to be inefficient and not as extendable.

Only one additional file is used in default projects, and that is the <code>nox-env.php</code> file which serves as a pseudo user-land environment file to put sensitive data in. It <strong>should not</strong> be committed to code repositories and, instead, the partnering <code>nox-env.example.php</code> file should define all the necessary key constants but leave the values void of sensitive data. This file is included by default in the <code>nox-request.php</code> file, but is not used in any internal framework files. Should you not like this environment variable implementation, you can opt to just not require the file.

<div class="container-fluid mt-4">
	<div class="row">
		<div class="col-xl-4 mb-3">
			<div class="card h-100">
				<div class="card-header">
					<h4>Static File Serving</h4>
				</div>
				<div class="card-body">
					<p>
						You can configure Nox to read multiple directories for static files by mapping static directory stubs.
					</p>
				</div>
				<div class="card-footer">
					<a href="/docs/2.0/nox-configs/static-file-serving" class="btn btn-primary">
						<i class="bi bi-file-image-fill"></i>
						<span>Read More on Static File Serving</span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-xl-4 mb-3">
			<div class="card h-100">
				<div class="card-header">
					<h4>Supporting MIMEs</h4>
				</div>
				<div class="card-body">
					<p>
						Nox allows you to decide which file extensions you want to support and which MIME types they would be associated with.
					</p>
				</div>
				<div class="card-footer">
					<a href="/docs/2.0/nox-configs/registering-mime-types" class="btn btn-primary">
						<i class="bi bi-file-binary-fill"></i>
						<span>More on File Extension Support</span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-xl-4 mb-3">
			<div class="card h-100">
				<div class="card-header">
					<h4>Managing Cache Headers</h4>
				</div>
				<div class="card-body">
					<p>
						After allowing a mime type to be associated with a file extension, you can then set a preferred cache age for that MIME type.
					</p>
				</div>
				<div class="card-footer">
					<a href="/docs/2.0/nox-configs/static-file-cache-control" class="btn btn-primary">
						<i class="bi bi-alarm-fill"></i>
						<span>Setting Cache Control for MIMEs</span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-xl-4 mb-3">
			<div class="card h-100">
				<div class="card-header">
					<h4>Defining a Views Directory</h4>
				</div>
				<div class="card-body">
					<p>
						The Nox rendering engine needs a singular directory set to look for your HTML web views.
					</p>
				</div>
				<div class="card-footer">
					<a href="/docs/2.0/nox-configs/defining-views-directory" class="btn btn-primary">
						<i class="bi bi-folder-fill"></i>
						<span>How to Set the Views Directory</span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-xl-4 mb-3">
			<div class="card h-100">
				<div class="card-header">
					<h4>Defining a Layouts Directory</h4>
				</div>
				<div class="card-body">
					<p>
						Each view defines the layout that the view gets injected into - the outer HTML that wraps the view.
					</p>
				</div>
				<div class="card-footer">
					<a href="/docs/2.0/nox-configs/defining-layouts-directory" class="btn btn-primary">
						<i class="bi bi-folder-fill"></i>
						<span>How to Set the Layouts Directory</span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-xl-4 mb-3">
			<div class="card h-100">
				<div class="card-header">
					<h4>Set Your Nox Source Directory</h4>
				</div>
				<div class="card-body">
					<p>
						Defining a source directory helps Nox know where to look for your models, controllers, and general source code.
					</p>
				</div>
				<div class="card-footer">
					<a href="/docs/2.0/nox-configs/setting-project-source-directory" class="btn btn-primary">
						<i class="bi bi-filetype-php"></i>
						<span>Registering the Src Directory</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

## Default nox-request.php File
The default nox-request.php file that comes pre-installed with example projects is shown below. You can also <a href="https://github.com/nox7/nox/blob/main/example/nox-request.php" target="_blank"><i class="bi bi-github"></i> find it on GitHub</a>.

```php
use Nox\Nox;
use Nox\ORM\Abyss;
use Nox\ORM\DatabaseCredentials;
use Nox\Router\BaseController;
use Nox\Router\ExceptionsNoMatchingRoute;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/nox-env.php";

$nox = new Nox();
BaseController::$noxInstance = $nox;

// Set a static file serving directory
$nox->addStaticDirectory(
    uriStub: "/",
    directoryPath: __DIR__ . "/resources/static",
);

// Support static file mime types so the browser can recognize the static files
$nox->mapExtensionToMimeType("css", "text/css");
$nox->mapExtensionToMimeType("map", "text/plain");
$nox->mapExtensionToMimeType("png", "image/png");
$nox->mapExtensionToMimeType("jpg", "image/jpeg");
$nox->mapExtensionToMimeType("jpeg", "image/jpeg");
$nox->mapExtensionToMimeType("js", "text/javascript");
$nox->mapExtensionToMimeType("mjs", "text/javascript");
$nox->mapExtensionToMimeType("gif", "image/gif");
$nox->mapExtensionToMimeType("weba", "audio/webm");
$nox->mapExtensionToMimeType("webm", "video/webm");
$nox->mapExtensionToMimeType("webp", "image/webp");
$nox->mapExtensionToMimeType("pdf", "application/pdf");
$nox->mapExtensionToMimeType("svg", "image/svg+xml");

// Mime caches
$nox->addCacheTimeForMime("image/png", 86400 * 60);
$nox->addCacheTimeForMime("image/jpeg", 86400 * 60);
$nox->addCacheTimeForMime("text/css", 86400 * 60);
$nox->addCacheTimeForMime("text/plain", 86400 * 60);
$nox->addCacheTimeForMime("text/javascript", 86400 * 60);
$nox->addCacheTimeForMime("text/gif", 86400 * 60);
$nox->addCacheTimeForMime("text/svg", 86400 * 60);
$nox->addCacheTimeForMime("image/webp", 86400 * 60);

// Process static files before anything else, to keep static file serving fast
$nox->router->processRequestAsStaticFile();

// If the code gets here, then it's not a static file. Load the rest of the setting directories
$nox->setViewsDirectory(__DIR__ . "/resources/views");
$nox->setLayoutsDirectory(__DIR__ . "/resources/layouts");
$nox->setSourceCodeDirectory(__DIR__ . "/src");

// Setup the Abyss ORM (MySQL ORM)
// Comment the Abyss credentials out if you do not need MySQL
// Multiple credentials can be added if you have multiple databases/schemas
Abyss::addCredentials(new DatabaseCredentials(
    host: NoxEnv::MYSQL_HOST,
    username: NoxEnv::MYSQL_USERNAME,
    password: NoxEnv::MYSQL_PASSWORD,
    database: NoxEnv::MYSQL_DB_NAME,
    port: NoxEnv::MYSQL_PORT,
));

// Process the request as a routable request
try {
    $nox->router->processRoutableRequest();
} catch (NoMatchingRoute $e) {
    // 404
    http_response_code(404);
    // Process a new routable request, but change the path to our known 404 controller method route
    $nox->router->requestPath = "/404";
    $nox->router->processRoutableRequest();
}
```