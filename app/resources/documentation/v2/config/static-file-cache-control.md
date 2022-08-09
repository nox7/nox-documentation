# Static File Cache Control
In typical PHP projects, the server configuration file (Apache htaccess or nginx config file) would control the cache age for specified MIME types.

Because Nox has a static file serving system, you can use PHP to control the cache of static files by their MIME types.

```php
// Adds a 60-day cache to image/png content types
$nox->addCacheTimeForMime("image/png", 86400 * 60);
```

The cache age is in seconds. In this case: 86400 is the seconds in a day multiplied by 60 for 60 days of caching for PNG images.