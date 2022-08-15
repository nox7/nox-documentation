# Processing Request Payloads
Because requests can have different request methods not supported by PHP's native body parser (PUT, DELETE, PATCH, etc), you would normally have to process the request body yourself.

Nox has an abstraction to take care of this for you and make accessing JSON or form-data payloads easy.

## Prerequisite Attribute
To avoid large payloads being processed unnecessarily, Nox payload processing is an opt-in system signified by adding the framework's ProcessRequestBody attribute to an MVC controller.

Take a look at the example route method stub below.

```php
use Nox\Http\Request;
use Nox\Http\Attributes\ProcessRequestBody;

...

#[Route("PUT", "/user/settings")]
#[ProcessRequestBody]
public function updateUserSettings(): string
{
    $payload = Request::getRequestPayload();

    try{
        $userEmailPayload = $payload->getTextPayload("email");
    }catch(NoPayloadFound $e){
        http_response_code(400);
        return $e->getMessage();
    }

    $userEmail = $userEmailPayload->contents;

    // Do some logic with $userEmail

    return "Done!";
}
```

This example sets up an endpoint for receiving PUT requests to `/user/settings`. In order to process the request body, the ProcessRequestBody attribute is put on this method. This tells the Nox routing system to use the body of this HTTP request as a payload and parse it.

You can then use the `Nox\Http\Request` static method `::getRequestPayload()` to get an object of `Nox\Http\RequestPayload`.

This object has the following methods available.

```php
public function getAllPayloads(string $name): Payload[];
public function getArrayPayload(string $name): ArrayPayload;
public function getTextPayload(string $name): TextPayload;
public function getTextPayloadNullable(string $name): TextPayload | null;
public function getFileUploadPayload(string $name): FileUploadPayload;
```

Only `getTextPayloadNullable` will return `null` if no payload by the provided name is found. The other methods **all throw exceptions** of type `Nox\Http\Exceptions\NoPayloadFound`.

ArrayPayload has the following properties
```php
public string $name;
public array $contents;
```

TextPayload has the following properties
```php
public string $name;
public string $contents;
```

FileUploadPayload has the following properties
```php
public string $name;
public string $fileName;
public int $fileSize;
public string $contentType;
public string $contents;
```