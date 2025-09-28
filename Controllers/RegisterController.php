<?php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Repository/UserRepository.php';

class RegisterController
{
    public array $errors = [];
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';

    public string $success = '';

    public function handleRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->firstname       = trim($_POST['firstname'] ?? '');
            $this->lastname        = trim($_POST['lastname'] ?? '');
            $this->email           = trim($_POST['email'] ?? '');
            $password              = $_POST['password'] ?? '';
            $password_confirm      = $_POST['password_confirm'] ?? '';

            //VIERIFICATION
            if ($this->firstname === '') {
                $this->errors[] = 'Le prénom est obligatoire.';
            }

            if ($this->lastname === '') {
                $this->errors[] = 'Le nom est obligatoire.';
            }

            if ($this->email === '') {
                $this->errors[] = "L'e-mail est obligatoire.";
            } 
            elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->errors[] = "Le format de l'e-mail est invalide.";
            }

            if ($password === '') {
                $this->errors[] = 'Le mot de passe est obligatoire.';
            } else {
                $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

                if (!preg_match($regex, $password)) {
                    $this->errors[] = 'Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial.';
                }
            }

            if ($password !== $password_confirm) {
                $this->errors[] = 'Les mots de passe ne correspondent pas.';
            }

            if (empty($this->errors)) {
                try {
                    $userRepo = new UserRepository();

                    if ($userRepo->emailExists($this->email)) {
                        $this->errors[] = 'Un compte avec cet e-mail existe déjà.';
                    } else {
                        $user = new User();
                        $user->setFirstname($this->firstname);
                        $user->setLastname($this->lastname);
                        $user->setEmail($this->email);
                        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                        $user->setCreatedAt(new DateTimeImmutable());
                        $user->setUpdatedAt(new DateTimeImmutable());

                        $userRepo->save($user);

                        $_SESSION['user'] = [
                            'id'        => $user->getId(),
                            'firstname' => $user->getFirstname(),
                            'lastname'  => $user->getLastname(),
                            'email'     => $user->getEmail()
                        ];
                        $_SESSION['success'] = "L'utilisateur a bien été créé !";
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
