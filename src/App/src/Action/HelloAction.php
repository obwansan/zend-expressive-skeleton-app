<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 *
 */
class HelloAction implements MiddlewareInterface
{
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        // On all PHP versions:
        $query  = $request->getQueryParams();
        $target = isset($query['target']) ? $query['target'] : 'World';

        // Or, on PHP 7+:
        $target = $request->getQueryParams()['target'] ?? 'World';

        return new HtmlResponse(
            $this->renderer->render('app::hello-world', ['target' => $target])
        );
    }
}