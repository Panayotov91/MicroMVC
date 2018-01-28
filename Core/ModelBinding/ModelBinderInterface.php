<?php

namespace Core\ModelBinding;


interface ModelBinderInterface
{
    /**
     * Bind parameters from $data to object and return the object
     *
     * @param array $data
     * @param $className
     * @return mixed
     */
    public function bind(array $data, $className);
}