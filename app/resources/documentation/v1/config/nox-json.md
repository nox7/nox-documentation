# Nox Primary JSON Configuration</h1>
The nox.json file is the primary configuration for where the Nox framework will look for key components of your application - such as views, layouts, and controllers.

A standard nox.json file will look as follows

```json
{
  "static-directory": "/static",
  "layouts-directory": "/layouts",
  "views-directory": "/views",
  "controllers-directory": "/controllers",
  "mysql-models-directory": "/models",

  "404-route": "/404"
}
```

<div class="alert alert-warning">
	All paths are relative to the Nox app directory - not the server document root.
</div>

## Available Configuration Keys
The following is an exhaustive list of configuration keys that can be placed in the nox.json file.
* **"static-directory"**: (string) The location of where to attempt to find static files to serve.
* **"static-directories"**: (object) An object with keys of URI masks to map to directories to attempt to serve static files from. See [serving static files](/docs/1.x/static-file-serving) for more on this.
* **"views-directory"**: (string) The location of where to attempt to find view files when rendering.
* **"layouts-directory"**: (string) The location of where to attempt to find layout files when parsing and rendering a view.
* **"controllers-directory"**: (string) The location that will be recursively searched for all PHP classes that defined routes for the Nox application.
* ** "sql-models-directory"**: (string) The location that will be searched for all MySQL models in the application.
* **"404-route"**: (string) The default 404 route that will be used to render 404 pages.