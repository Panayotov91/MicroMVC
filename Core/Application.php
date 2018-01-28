<?php

namespace Core;


use Core\DependencyManagement\ContainerInterface;
use Core\Http\UriHandlerInterface;
use Core\ModelBinding\ModelBinderInterface;

class Application implements ApplicationInterface
{
    /**
     * @var UriHandlerInterface
     */
    private $uriHandler;

    /**
     * @var ModelBinderInterface
     */
    private $modelBinder;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Application constructor.
     *
     * @param UriHandlerInterface $uriHandler
     * @param ModelBinderInterface $modelBinder
     * @param ContainerInterface $container
     */
    public function __construct(UriHandlerInterface $uriHandler,
                                ModelBinderInterface $modelBinder,
                                ContainerInterface $container)
    {
        $this->uriHandler = $uriHandler;
        $this->modelBinder = $modelBinder;
        $this->container = $container;
    }

    /**
     * Starts the application
     */
    public function start()
    {
        $controllerFullQualifiedName = "Controllers\\"
            . ucfirst($this->uriHandler->getControllerName()
                . 'Controller');

        $controller = $this->container->resolve($controllerFullQualifiedName);

        $actionInfo = new \ReflectionMethod(
            $controllerFullQualifiedName,
            $this->uriHandler->getMethodName()
        );

        $position = -1;
        $internalPosition = 0;
        $allParameters = [];
        $requestParameters = $this->uriHandler->getParams();
        foreach ($actionInfo->getParameters() as $parameter) {

            $position++;
            $className = $parameter->getClass();

            if (null === $className) {

                $allParameters[$position] = $requestParameters[$internalPosition];
                $internalPosition++;
                continue;
            }
            $className = $className->getName();

            $parameter = $this->container->resolve($className);

            $allParameters[$position] = $parameter;

        }

        call_user_func_array(
            [
                $controller,
                $this->uriHandler->getMethodName()
            ],
            $allParameters
        );
    }
}