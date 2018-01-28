<?php

namespace Database;


interface StatementInterface
{
    /**
     * Execute query with params
     *
     * @param array ...$params
     * @return ResultSetInterface
     */
    public function execute(...$params): ResultSetInterface;
}