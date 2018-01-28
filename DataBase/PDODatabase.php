<?php

namespace Database;


class PDODatabase implements DatabaseInterface
{
    /** @var \PDO */
    private $pdo;

    /**
     * PDODatabase constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * Makes query to the database and return prepared statement
     *
     * @param string $query
     * @return StatementInterface
     */
    public function query(string $query): StatementInterface
    {
        $stmt = $this->pdo->prepare($query);

        return new PDOPreparedStatement($stmt);
    }
}