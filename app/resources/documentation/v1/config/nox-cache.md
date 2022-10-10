# Static File Cache Configuration
`nox-cache.json` defines the cache lifetime of certain mime types. Any mimes that are not present will not be sent a cache header. The header that is sent to browsers to define cache is `cache-control: max-age=%d` where %d is the time in seconds from the `nox-cache.json`.

A standard `nox-cache.json` file will look as follows

```json
{
    "text/css":2592000,
    "image/jpeg":2592000,
    "image/gif":2592000,
    "image/png":2592000,
    "image/webp":2592000,
    "image/svg+xml":2592000,
    "application/pdf":5184000,
    "text/javascript":1296000
}
```