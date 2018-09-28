<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use App\Action\HelloAction;

class HelloActionFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return HelloAction
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new HelloAction($container->get(\Zend\Expressive\Template\TemplateRendererInterface::class));
    }
}
