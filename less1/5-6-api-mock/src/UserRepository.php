<?php

namespace App;

require_once __DIR__ . '/../database.php';

class UserRepository
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = \Database::getDbConnection();
    }

    public function getAllUsers(): array
    {
        $stmt = $this->db->query("SELECT id, name, email FROM users");
        $rows = $stmt->fetchAll();

        $users = [];
        foreach ($rows as $row) {
            $users[] = new User(
                $row['id'],
                $row['name'],
                $row['email'],
            );
        }

        return $users;
    }

    public function findUserByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new User(
            $row['id'],
            $row['name'],
            $row['email']
        );
    }
}
