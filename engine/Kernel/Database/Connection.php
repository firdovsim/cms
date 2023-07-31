<?php

namespace Engine\Kernel\Database;

use PDO;

class Connection
{
    private PDO $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(): void
    {
        $config = [
            'host' => 'localhost',
            'dbname' => 'cms',
            'username' => 'postgres',
            'password' => 'password',
            'charset' => 'UTF8'
        ];

        $dsn = "pgsql:host=%s;dbname=%s;";
        $this->connection = new PDO(
            sprintf($dsn, $config['host'], $config['dbname'], $config['charset']),
            $config['username'],
            $config['password']
        );
    }

    public function execute($sql): bool
    {
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute();
    }

    public function query($sql): array
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (! $result) {
            return [];
        }

        return $result;
    }
}