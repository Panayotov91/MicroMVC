<?php

namespace Core\Http;


class UriHandler implements UriHandlerInterface
{
    /**
     * @var string Name of the controller from uri
     */
    private $controllerName = null;

    /**
     * @var string Name of the method from uri
     */
    private $methodName = null;

    /**
     * @var array Parameters of the method from uri
     */
    private $params;

    /**
     * UriHandler constructor.
     */
    public function __construct()
    {
        $this->params = [];
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Gets the controller name, the method name and the parameters from the uri
     *
     * @param string $uri
     * @param string $path
     */
    public function processUri(string $uri, string $path)
    {
        $pathArray = explode('/', $path);
        array_pop($pathArray);
        $replace = implode('/', $pathArray);
        $uri = str_replace($replace . '/', '', $uri);

        $this->params = explode('/', $uri);
        $this->controllerName = array_shift($this->params);
        $this->methodName = array_shift($this->params);
    }
}