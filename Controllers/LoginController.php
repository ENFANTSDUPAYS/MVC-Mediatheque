<?php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/connexion.php';

class LoginController
{
    public array $errors = [];
    public string $email = '';

    //FONCTION MOT DE PASSE
    private function isValidMDP(string $mdp): bool
    {
        return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $mdp);
    }

    public function handleRequest(): void
    {
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($this->email === '') $this->errors[] = "L'e-mail est obligatoire.";
            if ($password === '') $this->errors[] = "Le mot de passe est obligatoire.";

            if (empty($this->errors)) {
                try {
                    $pdo = getConnexion();
                    $stmt = $pdo->prepare('SELECT id, firstname, lastname, email, password FROM users WHERE email = ?');
                    $stmt->execute([$this->email]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($password, $user['password']) && $this->isValidMDP($password)) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user'] = [
                            'id' => $user['id'],
                            'firstname' => $user['firstname'],
                            'lastname' => $user['lastname'],
                            'email' => $user['email']
                        ];

                        $_SESSION['success'] = "Bienvenue " . $user['firstname'];
                        header('Location: index.php?page=home');
                        exit();
                    } else {
                        $this->errors[] = "E-mail ou mot de passe incorrect.";
                    }
                } catch (PDOException $e) {
                    error_log('Database error: ' . $e->getMessage());
                    $this->errors[] = "Une erreur est survenue. Veuillez réessayer plus tard.";
                }
            }
        }

        if (isset($_SESSION['user_id'])) {
            header('Location: index.php?page=home');
            exit();
        }
    }
}
