<?php

namespace Database;


interface ResultSetInterface
{
    /**
     * For each call fetch one row
     *
     * @param null|string $className
     * @return \Generator
     */
    public function fetch($className = null): \Generator;

    /**
     * Fetch certain row
     *
     * @param int $colNum
     * @return mixed
     */
    public function fetchColumn(int $colNum = 0);
}