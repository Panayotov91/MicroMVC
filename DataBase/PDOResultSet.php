<?php

namespace Database;


class PDOResultSet implements ResultSetInterface
{
    /** @var \PDOStatement */
    private $pdoStatement;

    /**
     * PDOResultSet constructor.
     * @param \PDOStatement $pdoStatement
     */
    public function __construct(\PDOStatement $pdoStatement)
    {
        $this->pdoStatement = $pdoStatement;
    }

    /**
     * For each call fetch one row
     *
     * @param null|string $className
     * @return \Generator
     */
    public function fetch($className = null): \Generator
    {
        if (null === $className) {
            while ($row = $this->pdoStatement->fetch(\PDO::FETCH_ASSOC)) {
                yield $row;
            }
        } else {
            while ($row = $this->pdoStatement->fetchObject($className)) {
                yield $row;
            }
        }
    }

    /**
     * Fetch certain row
     *
     * @param int $colNum
     * @return mixed
     */
    public function fetchColumn(int $colNum = 0)
    {
        return $this->pdoStatement->fetchColumn($colNum);
    }
}