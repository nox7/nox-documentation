# Registering Mime Types
Nox's static filing serving system will only serve files with file extensions that are registered to a known mime type. For example, if you would not like PDF files to be served on your website then you would simply make sure there is no map for a .pdf file extension to a mime type in the mime registry.

## Registering Mimes
Typically, registration is done in the nox-request.php file; and, of course, the code registering the extension-to-mime would be before any call to read/serve files.

```php
// $nox is the instance of Nox from nox-request.php
// This would allow .css files to be served and served with a text/css content-type response
$nox->mapExtensionToMimeType("css", "text/css");

// Also serve SCS .map files as text/plain
$nox->mapExtensionToMimeType("map", "text/plain");
```

You can map any file extension to any mime you require. Unmapped file extensions will not be recognized by the router and will result in a not-found route if no other route matches that file path.