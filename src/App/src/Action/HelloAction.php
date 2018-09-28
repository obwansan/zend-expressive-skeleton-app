<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Looks for a query string parameter "target", and uses its value to provide a message,
 * which is then returned in an HTML response.
 */
class HelloAction implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        // On all PHP versions:
        // $query  = $request->getQueryParams();
        // $target = isset($query['target']) ? $query['target'] : 'World';

        // Or, on PHP 7+:
        // If there's a 'target' query parameter that's assigned a value (e.g. ?target=ME)
        // assign it's value to $target, else assign 'World' to $target
        $target = $request->getQueryParams()['target'] ?? 'World';

        $target = htmlspecialchars($target, ENT_HTML5, 'UTF-8');

        return new HtmlResponse(sprintf(
            '<h1>Hello, %s!</h1>',
            $target
        ));
    }
}