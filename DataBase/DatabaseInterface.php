<?php

namespace Database;


interface DatabaseInterface
{
    /**
     * Makes query to the database and return prepared statement
     *
     * @param string $query
     * @return StatementInterface
     */
    public function query(string $query): StatementInterface;
}