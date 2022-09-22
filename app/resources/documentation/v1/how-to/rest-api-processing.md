# Processing RESTful Requests as APIs
By nature, PHP will only auto-consume the request body of a POST request. However, REST APIs allow us to utilize methods such as PATCH, PUT, and DELETE to signify more information about a request's intents.

Nox includes the ability to consume the request body of multipart/form-data (As of 1.5.0, JSON consumption is not processed by Nox and you can easily do this manually by decoding the php://input).

## Setting Up a Consumption Method
From within a controller, you can mark a method with a ProcessRequestBody attribute that will prefill the BaseController's $requestPayload property with a key=>value array of the request's form data.
```php
use Nox\Router\Attributes\Route
use Nox\Router\Attributes\Controller
use Nox\Router\BaseController
use Nox\Http\Attributes\ProcessRequestBody

#[Controller]
public class PageController extends BaseController{

    /**
     * PUTs a new page into the database
     */
    #[Route("PUT", "/page")]
    #[ProcessRequestBody]
    public function getAccessibleURIs(): string{
        $payload = BaseController::$requestPayload;

        // $payload is an array of keys and values from your PUT'd form data
    }

}
```

Your front-end JavaScript may look something like the below, which would PUT to that API endpoint.
```php
class PageForm{
    async onSubmit(){
        const formData = new FormData();
        formData.set("name", "My Page Name");

        const response = await fetch("/page", {
            method:"PUT",
            body:formData
        });
    }
}
```

## Responding with JSON
The Nox framework is minimal, but it does have the ability to easily handle JSON responses from its internal routing structure. You have two options. One includes an opinionated method and one is raw. First, we'll discuss the raw method that allows Nox to handle when a Controller method returns an array. The above Controller method will be used as an example.

```php
use Nox\Router\Attributes\Route
use Nox\Router\Attributes\Controller
use Nox\Router\BaseController
use Nox\Http\Attributes\ProcessRequestBody
use Nox\Http\Attributes\UseJSON

#[Controller]
public class PageController extends BaseController{

    /**
     * PUTs a new page into the database
     */
    #[Route("PUT", "/page")]
    #[ProcessRequestBody]
    #[UseJSON]
    public function getAccessibleURIs(): array{
        $payload = BaseController::$requestPayload;

        return [
            "status"=>1, // Status of 1 to tell the front-end everything is fine
        ];
    }

}
```

Notice how there is now a UseJSON attribute, the return type of the method is now an array, and an array is returned. The UseJSON attribute informs the Nox routing system to, if an array is returned by a Controller method, automatically set the necessary headers for a JSON string to be returned and to json_encode any returned array.

The header that gets set is `content-type: application/json; charset=UTF-8`

### Opinionated JSON Result
Nox also provides premade classes to return a JSON result that signifies if the JSON is describing a successful process or an erroneous one.

```php
use Nox\Router\Attributes\Route
use Nox\Router\Attributes\Controller
use Nox\Router\BaseController
use Nox\Http\Attributes\ProcessRequestBody
use Nox\Http\Attributes\UseJSON
use Nox\Http\JSON\JSONSuccess
use Nox\Http\JSON\JSONError
use Nox\Http\JSON\JSONResult

#[Controller]
public class PageController extends BaseController{

    /**
     * PUTs a new page into the database
     */
    #[Route("PUT", "/page")]
    #[ProcessRequestBody]
    #[UseJSON]
    public function getAccessibleURIs(): JSONResult{
        $payload = BaseController::$requestPayload;

        if ($somethingIsWrong){
            http_response_code(500);
            return new JSONError("Something went wrong.");
        }else{
            return new JSONSuccess();
        }
    }

}
```
Instead, as shown above, we can return an instance of a JSONResult. These results automatically include a key for `status` which is either 1 (for success) or -1 (for errors) that your front-end can read from.

JSONError takes two arguments. The first is a string error message which gets put into the outputted JSON array as the key `error` and the second is an array that can be merged to provide additional data. An error might look like the below.

```json
{
    "status":-1,
    "error":"Something went wrong."
}
```

JSONSuccess takes one optional argument. It is an array of additional data to send with a success status. By default, JSONSuccess will always have a `status` key set to the integer value of 1. More keys can be provided by providing the first array argument to JSONSuccess's constructor.
```json
{
    "status":1
}
```