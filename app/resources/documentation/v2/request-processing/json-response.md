# Providing a JSON Response to a Request
You are free to create your own implementations, but Nox comes with a native way to signify a route should return with JSON headers and JSON data.

## Nox-Native JSON Statuses
All Nox-created JSON helper objects will always have `status` key sent back in the JSON. This status key is of integer value of either `-1` (for JSONError) or `1` (for JSONSuccess). See the examples below.

## Returning JSON
Consider the following route method stub.
```php
use Nox\Http\Attributes\UseJSON;
use Nox\Http\JSON\JSONResult;
use Nox\Http\JSON\JSONError;

...

#[Route("POST", "/user")]
#[UseJSON]
public function testEndpoint(): JSONResult{
    http_response_code(500);
    return new JSONError("There was an internal server error.");
}
```

The `UseJSON` attribute informs the Nox router to call `toArray()` on the `JSONError` object returned as well as set the necessary Content-Type header for UTF-8 JSON.

`JSONError` will always return **at least** the following JSON keys. `status` and `error`

You can provide an array to JSONError if you want additional key/value data sent in the JSON response.

An example JSON response would look like this from the above example:
```json
{
  "status": -1,
  "error": ""
}
```

## JSONSuccess
The alternative to JSONError is JSONSuccess.

```php
use Nox\Http\Attributes\UseJSON;
use Nox\Http\JSON\JSONResult;
use Nox\Http\JSON\JSONSuccess;

...

#[Route("POST", "/user")]
#[UseJSON]
public function testEndpoint(): JSONResult{
    return new JSONSuccess([
        "message"=>"Everything executed as expected.",
    ]);
}
```

JSONSuccess doesn't require any arguments, but you can provide an array of key/values to add to the JSON response. By default, only a `status` key with a value of `1` is sent back. The above endpoint JSON response would look like this:
```json
{
  "status": 1,
  "message": "Everything executed as expected."
}
```