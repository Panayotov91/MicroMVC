<?php

namespace Core\DependencyManagement;


interface ContainerInterface
{
    /**
     * Resolve dependencies
     *
     * @param string $interfaceName
     * @return mixed
     */
    public function resolve(string $interfaceName);

    /**
     * Adds dependency
     *
     * @param string $interfaceName
     * @param string $implementationName
     */
    public function addDependency(string $interfaceName, string $implementationName);

    /**
     * Cache dependency
     *
     * @param string $interfaceName
     * @param $object
     */
    public function cache(string $interfaceName, $object);

    /**
     * Checks if dependency exists
     *
     * @param string $interfaceName
     * @return bool
     */
    public function exists(string $interfaceName): bool;
}