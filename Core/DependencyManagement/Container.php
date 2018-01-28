<?php

namespace Core\DependencyManagement;


class Container implements ContainerInterface
{
    /** @var array  */
    private $dependencies;

    /** @var array  */
    private $cache;

    /**
     * Container constructor.
     */
    public function __construct()
    {
        $this->dependencies = [];
        $this->cache = [];
    }

    /**
     * Resolve dependencies
     *
     * @param string $interfaceName
     * @return mixed
     * @throws \Exception
     */
    public function resolve(string $interfaceName)
    {
        if (array_key_exists($interfaceName, $this->cache)) {
            return $this->cache[$interfaceName];
        }

        if (interface_exists($interfaceName)) {
            $className = $this->dependencies[$interfaceName];
        } elseif (class_exists($interfaceName)) {
            $className = $interfaceName;
        } else {
            throw new \Exception("The class or interface does not exist !!!");
        }

        $classInfo = new \ReflectionClass($className);
        $constructorInfo = $classInfo->getConstructor();
        if (null === $constructorInfo) {
            $object = new $className();
            $this->cache($className, $object);
            return $object;
        }

        $resolvedParameters = [];
        foreach ($constructorInfo->getParameters() as $parameter) {
            $resolvedParameters[]
                = $this->resolve($parameter->getClass()->getName());
        }

        $object = $classInfo->newInstanceArgs($resolvedParameters);
        $this->cache($interfaceName, $object);

        return $object;
    }

    /**
     * Adds dependency
     *
     * @param string $interfaceName
     * @param string $implementationName
     */
    public function addDependency(string $interfaceName, string $implementationName)
    {
        $this->dependencies[$interfaceName] = $implementationName;
    }

    /**
     * Cache dependency
     *
     * @param string $interfaceName
     * @param $object
     */
    public function cache(string $interfaceName, $object)
    {
        $this->cache[$interfaceName] = $object;
    }

    /**
     * Checks if dependency exists
     *
     * @param string $interfaceName
     * @return bool
     */
    public function exists(string $interfaceName): bool
    {
        return array_key_exists($interfaceName, $this->dependencies);
    }
}