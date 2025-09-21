<?php
require_once __DIR__ . '/../Models/connexion.php';
require_once __DIR__ . '/../Models/User.php';

class RegisterController
{
    public array $errors = [];
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';

    public function handleRequest(): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->firstname = trim($_POST['firstname'] ?? '');
            $this->lastname  = trim($_POST['lastname'] ?? '');
            $this->email     = trim($_POST['email'] ?? '');
            $password        = $_POST['password'] ?? '';
            $password_confirm= $_POST['password_confirm'] ?? '';

            if ($this->firstname === '') $this->errors[] = 'Le prénom est obligatoire.';

            if ($this->lastname === '')  $this->errors[] = 'Le nom est obligatoire.';

            if ($this->email === '')     $this->errors[] = "L'e-mail est obligatoire.";

            elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
                $this->errors[] = "Le format de l'e-mail est invalide.";

            if ($password === '') $this->errors[] = 'Le mot de passe est obligatoire.';

            elseif (strlen($password) < 8) $this->errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';

            if ($password !== $password_confirm)
                $this->errors[] = 'Les mots de passe ne correspondent pas.';

            if (empty($this->errors)) {
                try {
                    $pdo = getConnexion();
                    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
                    $stmt->execute([$this->email]);
                    if ($stmt->fetch()) {
                        $this->errors[] = 'Un compte avec cet e-mail existe déjà.';
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare('INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)');
                        $stmt->execute([$this->firstname, $this->lastname, $this->email, $hashedPassword]);

                        $_SESSION['user'] = [
                            'id' => $pdo->lastInsertId(),
                            'firstname' => $this->firstname,
                            'lastname' => $this->lastname,
                            'email' => $this->email
                        ];

                        header('Location: index.php?page=home');
                        exit();
                    }
                } catch (PDOException $e) {
                    error_log('Database error: ' . $e->getMessage());
                    $this->errors[] = 'Une erreur est survenue. Veuillez réessayer plus tard.';
                }
            }
        }

        if (isset($_SESSION['user'])) {
            header('Location: index.php?page=home');
            exit();
        }
    }
}
