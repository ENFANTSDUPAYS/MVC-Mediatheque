<?php
require_once __DIR__ . '/../Models/connexion.php';
require_once __DIR__ . '/../Models/User.php';

class UserRepository {
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = getConnexion();
    }

    public function emailExists(string $email): bool {
        $stmt = $this->pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return (bool)$stmt->fetch();
    }

    public function save(User $user): void {
        $stmt = $this->pdo->prepare('
            INSERT INTO users (firstname, lastname, email, password, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getFirstname(),
            $user->getLastname(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getCreatedAt()->format('Y-m-d H:i:s'),
            $user->getUpdatedAt()->format('Y-m-d H:i:s'),
        ]);

        $userId = $this->pdo->lastInsertId();
        $reflection = new ReflectionClass($user);
        $idProperty = $reflection->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($user, $userId);
    }
}
