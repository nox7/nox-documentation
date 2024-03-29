# Recognized MIME Types Configuration
Because Nox handles static file serving on its own, you can control which files are even recognized or allowed to be served by adding their extensions to `nox-mime.json`. For example, if you do not even want to attempt to serve PDF files, remove the "pdf" entry entirely from the `nox-mime.json`.

A standard `nox-mime.json` file will look as follows
```json
{
    "css": "text/css",
    "jpg": "image/jpeg",
    "jpeg": "image/jpeg",
    "js": "text/javascript",
    "mjs": "text/javascript",
    "gif": "image/gif",
    "weba": "audio/webm",
    "webm": "video/webm",
    "webp": "image/webp",
    "pdf": "application/pdf",
    "svg": "image/svg+xml",
    "png": "image/png"
}
```