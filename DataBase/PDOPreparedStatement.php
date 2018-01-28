<?php

namespace Database;


class PDOPreparedStatement implements StatementInterface
{
    /** @var \PDOStatement */
    private $pdoStatement;

    /**
     * PDOPreparedStatement constructor.
     * @param \PDOStatement $pdoStatement
     */
    public function __construct(\PDOStatement $pdoStatement)
    {
        $this->pdoStatement = $pdoStatement;
    }


    /**
     * Execute query with params
     *
     * @param array ...$params
     * @return ResultSetInterface
     */
    public function execute(...$params): ResultSetInterface
    {
        $this->pdoStatement->execute($params);

        return new PDOResultSet($this->pdoStatement);
    }
}