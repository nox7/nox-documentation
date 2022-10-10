# Serving Static Files
The location of where Nox will look for your static files (images, CSS, JavaScript, etc) is configured in the nox.json file. By default, this will be in your app folder as "static" (`app/static`).

This means that a request is **first** processed by checking the static directory for matching paths before even attempting to route via a controller or dynamic route.

Recognized mime types are configured in the nox-mime.json file. Removing a recognized mime type from here will disallow the serving of static files with that extension.

## Using the static-directories Configuration Key</h2>
In some cases, you'll want to map multiple URI stubs to static directories. For example, if we made a CMS system using Nox and wanted to make sure any URIs that started with `/my-statics` would look in a specific directory, we could do this with a URI mask.

Multiple static directories and URI masks are allowed by removing the "static-directory" key from the nox.json file and replacing it with the "static-directories" key in a similar format shown below.

```json
"static-directories":{
    "":"/static",
    "/my-statics":"/another-static-directory"
}
```

The above code would first check for static files that are typical URIs (such as `/image.png`) in the `app/static` directory.

However, if the request URI **begins** with `/my-statics` then **everything after that** is considered the path that should be searched in the directory `app/another-static-directory`.

For example, if the user request was *https://example.com/my-statics/image.png*, then our above configuration would first search in the `app/static` folder for `app/static/my-statics/image.png`.

If nothing was found, then the next key is checked and Nox notices it has a URI mask "/my-statics" in the configuration. So the URI request chops off that part and now searches for /image.png inside `app/another-static-directory/image.png`.