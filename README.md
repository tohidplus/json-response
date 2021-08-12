[![GitHub issues](https://img.shields.io/github/issues/tohidplus/json-response.svg)](https://github.com/tohidplus/json-response/issues)
[![GitHub stars](https://img.shields.io/github/stars/tohidplus/json-response.svg)](https://github.com/tohidplus/json-response/stargazers)
[![Total Downloads](https://img.shields.io/packagist/dt/tohidplus/json-response.svg)](https://packagist.org/packages/tohidplus/json-response)
[![Code Quality](https://img.shields.io/scrutinizer/quality/g/tohidplus/json-response/main)](https://scrutinizer-ci.com/g/tohidplus/json-response)
[![GitHub license](https://img.shields.io/github/license/tohidplus/json-response.svg)](https://github.com/tohidplus/json-response/blob/main/LICENSE.md)
[![GitHub license](https://img.shields.io/travis/tohidplus/json-response)](https://travis-ci.com/github/tohidplus/json-response)

# Laravel API JSON Response

This package is used to have a cohesive and well-integrated API response in both Laravel and Lumen frameworks.

## Requirements

* PHP version >= 7.4
* Laravel/Lumen framework >= 5.*

## Response structure sample

In case of successful response the **error** section with not shown and vice versa.

```json
{
    "status": "",
    "statusCode": "",
    "result": {
        "data": null,
        "meta": null
    },
    "error": {
        "data": null,
        "meta": null
    }
}
```

**status** will be either *success* or *error* that is automatically generated.

**statusCode** will be a valid http response code.

## Installation

```bash
composer require tohidplus/json-response
```

### Integration with framework

If you want this structure to be integrated with the Laravel/Lumen default error responses such as **Internal Server
Error**, **Validation Errors**, etc, the only thing you have to do is to change one line in `app\Exceptions\Handler.php`
file.

**Laravel**

Change

```php
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
```

To

```php
use Tohidplus\JsonResponse\Exceptions\LaravelBaseExceptionHandler as ExceptionHandler;
```

---
**Lumen**

Change

```php
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
```

To

```php
use Tohidplus\JsonResponse\Exceptions\LumenBaseExceptionHandler as ExceptionHandler;
```

## Usage

---

### success

Is used when you want to return only a successful response.

#### Arguments

* data
    * **type** `mixed`
    * **optional** `true`
    * **default** `null`
* meta
    * **type** `mixed`
    * **optional** `true`
    * **default** `null`
* statusCode
    * **type** `int`
    * **optional** `true`
    * **default** `200`

#### Example

```php
<?php

namespace App\Http\Controllers;
use Tohidplus\JsonResponse\Facades\JsonResponse;

class MyController extends Controller{

    public function index()
    {
        return JsonResponse::success("foo");        
    }
}
```

#### Response

```json
{
    "status": "success",
    "statusCode": 200,
    "result": {
        "data": "foo",
        "meta": null
    }
}
```

### error

Is used when you want to return only an error response.

#### Arguments

* data
    * **type** `mixed`
    * **optional** `false`
* meta
    * **type** `mixed`
    * **optional** `true`
    * **default** `null`
* statusCode
    * **type** `int`
    * **optional** `true`
    * **default** `500`

#### Example

```php
<?php

namespace App\Http\Controllers;
use Tohidplus\JsonResponse\Facades\JsonResponse;

class MyController extends Controller{

    public function index()
    {
        return JsonResponse::error("foo");        
    }
}
```

#### Response

```json
{
    "status": "error",
    "statusCode": 500,
    "error": {
        "data": "foo",
        "meta": null
    }
}
```

### created

Is used when you want to return a response after a creation action.

#### Arguments

* data
    * **type** `mixed`
    * **optional** `false`
* meta
    * **type** `mixed`
    * **optional** `true`
    * **default** `null`

#### Example

```php
<?php

namespace App\Http\Controllers;
use Tohidplus\JsonResponse\Facades\JsonResponse;

class UserController extends Controller{

    public function store()
    {
        $user = new User::create([
            "name" => "John Doe"
        ]);
       
        return JsonResponse::created($user);      
    }
}
```

#### Response

```json
{
    "status": "success",
    "statusCode": 201,
    "result": {
        "data": {
            "name": "John Doe"
        },
        "meta": null
    }
}
```

### updated

Is used when you want to return a response after an update action.

#### Arguments

* data
    * **type** `mixed`
    * **optional** `false`
* meta
    * **type** `mixed`
    * **optional** `true`
    * **default** `null`

#### Example

```php
<?php

namespace App\Http\Controllers;
use Tohidplus\JsonResponse\Facades\JsonResponse;

class UserController extends Controller{

    public function update()
    {
        $user = User::find(1);
        $user->name = "Jane Doe";
        $user->save();
        return JsonResponse::updated($user);      
    }
}
```

#### Response

```json
{
    "status": "success",
    "statusCode": 200,
    "result": {
        "data": {
            "name": "Jane Doe"
        },
        "meta": null
    }
}
```

### deleted

Is used when you want to return a response after a delete action.

#### Arguments

* statusCode
    * **type** `int`
    * **optional** `true`
    * **default** `204`
* data
    * **type** `mixed`
    * **optional** `true`
* meta
    * **type** `mixed`
    * **optional** `true`
    * **default** `null`

#### Example

```php
<?php

namespace App\Http\Controllers;
use Tohidplus\JsonResponse\Facades\JsonResponse;

class UserController extends Controller{

    public function destroy()
    {
         User::where("id",1)->delete(); 
         return JsonResponse::deleted(); 
    }
}
```

#### Response

By default, the status code for this method is `204` no-content. This means that you will not see any data as a response. In
order to see the response just change the status code and set its data and meta fields.

### validationErrors

Is used when you want to return a validation errors response manually.

#### Arguments

* meta
    * **type** `array`
    * **optional** `false`
* data
    * **type** `mixed`
    * **optional** `true`
    * **default** `null`

#### Example

```php
<?php

namespace App\Http\Controllers;
use Tohidplus\JsonResponse\Facades\JsonResponse;

class UserController extends Controller{

    public function index(){
        
       $name = request()->get("name");
       if (!$name){
           return JsonResponse::validationErrors([
              "name" => "The name field is required."
           ],
           "The give data is invalid"); 
       }      
    }
}
```

#### Response

```json
{
    "status": "error",
    "statusCode": 422,
    "error": {
        "data": "The give data is invalid",
        "meta": {
            "name": "The name field is required"
        }
    }
}
```

### unauthenticated

Is used when you want to return an unauthenticated response manually.

#### Arguments

* data
    * **type** `mixed`
    * **optional** `true`
    * **default** `Unauthenticated`
* meta
    * **type** `mixed`
    * **optional** `true`
    * **default** `null`

#### Example

```php
<?php

namespace App\Http\Controllers;
use Tohidplus\JsonResponse\Facades\JsonResponse;

class UserController extends Controller{

    public function index(){
        if (auth()->guest()){
            return JsonResponse::unauthenticated();
        }
    }
}
```

#### Response

```json
{
    "status": "error",
    "statusCode": 401,
    "error": {
        "data": "Unauthenticated",
        "meta": null
    }
}
```

### unauthorized

Is used when you want to return an unauthorized response manually.

#### Arguments

* data
    * **type** `mixed`
    * **optional** `true`
    * **default** `Unauthorized`
* meta
    * **type** `mixed`
    * **optional** `true`
    * **default** `null`

#### Example

```php
<?php

namespace App\Http\Controllers;
use Tohidplus\JsonResponse\Facades\JsonResponse;

class PostController extends Controller{

    public function update()
    {
        $post = Post::find(1);
        if (request()->user()->cannot("update",$post)){
            return JsonResponse::unauthorized();
        }
    }
}
```

#### Response

```json
{
    "status": "error",
    "statusCode": 401,
    "error": {
        "data": "Unauthorized",
        "meta": null
    }
}
```
