# Relay Middleware

This package include the following Relay-compatible middleware:

- _ResponseSender_ to send a PSR-7 response
- _ExceptionHandler_ to handler exceptions from subsequent middleware

This package is installable and PSR-4 autoloadable via Composer as `relay/middleware`.

## ResponseSender

The _ResponseSender_ does just what it sounds like: it sends the PSR-7 response object.

The _ResponseSender_ does nothing with the `$request` or `$response`, passing them immediately to `$next`. Afterwards, it takes the returned `$response` and sends it using `header()` and `echo`, and returns the sent `$response`.

The _ResponseSender_ is intended to go at the top of the Relay queue, so that it is the middleware with the last opportunity to do something with the returned response.

To add the _ResponseSender_ to your Real queue, instantiate it directly ...

```php
$queue[] = new \Relay\Middleware\ResponseSender();
```

... or use a `$resolver` of your choice to instantiate it from the `$queue`.

## ExceptionHandler

Similarly, the _ExceptionHandler_ does what it sound like: it catches any exceptions that bubble up through the following middleware decorators.

The _ExceptionHandler_ does nothing with the `$request` or `$response`, and passes them directly to `$next` inside a `try/catch` block. If no exception bubbles up, it returns the `$response` from `$next`.  However, if it catches an exception, it returns an entirely new `$response` object with the exception message and an HTTP 500 status code. It then returns the new `$response` object.

The _ExceptionHandler_ is intended to go near the top of the Relay queue, but after the _ResponseSender_.

To add the _ExceptionHandler_ to your queue, instantiate it directly with an empty $response implementation object ...

```php
$queue = new \Relay\Middleware\ExceptionHandler(new ResponseImplementation());
```

... or use a `$resolver` of your choice to instantiate it from the `$queue`.
