<?php

class Database
{
    public static function getDbConnection(): PDO
    {
        try {
            $host = 'localhost';
            $port = 3306;
            $dbname = 'test_db';
            $user = 'root';
            $password = 'root';

            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

            $pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

            $pdo->query("SELECT 1");

            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
