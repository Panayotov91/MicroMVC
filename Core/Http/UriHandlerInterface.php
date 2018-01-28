<?php

namespace Core\Http;


interface UriHandlerInterface
{
    /**
     * Gets the controller name, the method name and the parameters from the uri
     *
     * @param string $uri
     * @param string $path
     */
    public function processUri(string $uri, string $path);

    /**
     * @return string The name of the controller
     */
    public function getControllerName(): string;

    /**
     * @return string The name of the method
     */
    public function getMethodName(): string;

    /**
     * @return array The params
     */
    public function getParams(): array;
}