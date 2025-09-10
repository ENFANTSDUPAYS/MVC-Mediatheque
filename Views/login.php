<?php 
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once __DIR__ . '/../Models/connexion.php';
    require_once __DIR__ . '/../Models/User.php';

    $errors = [];
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if($email === ''){
        $errors[] = 'L\'e-mail est obligatoire.';
    }

    if($password === ''){
        $errors[] = 'Le mot de passe est obligatoire.';
    }

    if(empty($errors)){
        try {
            $pdo = getConnexion();
            $stmt = $pdo->prepare('SELECT id, firstname, lastname, email, password FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user && password_verify($password, $user['password'])){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'email' => $user['email']
                ];

                header('Location: ../index.php');
                exit();
            } else {
                $errors[] = 'E-mail ou mot de passe incorrect.';
            }
        } catch (PDOException $e) {
            error_log('Database error: ' . $e->getMessage());
            $errors[] = 'Une erreur est survenue. Veuillez réessayer plus tard.';
        }
    }
}

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Connexion — Médiathèque</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_onjFFfxw6tlc3KSzJ1POV2sR-8W4t5i-qg&s"/>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center py-12">
  <div class="w-full max-w-md">
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
      <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-4">Se connecter</h1>

        <?php if (!empty($errors)): ?>
          <div class="mb-4">
            <div class="bg-red-50 border border-red-200 text-red-800 text-sm rounded p-3">
              <ul class="list-disc pl-5">
                <?php foreach ($errors as $err): ?>
                  <li><?= htmlspecialchars($err, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8') ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4" novalidate>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
            <input id="email" name="email" type="email" required
                   value="<?= isset($email) ? htmlspecialchars($email) : '' ?>"
                   class="w-full rounded-lg border border-gray-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                   placeholder="ton@exemple.com">
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
            <input id="password" name="password" type="password" required
                   class="w-full rounded-lg border border-gray-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                   placeholder="Au moins 8 caractères">
          </div>

          <div>
            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-lg shadow-sm transition">
              Se connecter
            </button>
          </div>

          <p class="text-sm text-center text-gray-500">
            Pas de compte ? <a href="register.php" class="text-indigo-600 hover:underline">S'inscrire</a>
          </p>
        </form>
      </div>

      <div class="bg-gray-50 border-t border-gray-100 p-4 text-center text-xs text-gray-500">
        Médiathèque — Connexion sécurisée
      </div>
    </div>
  </div>
</body>
</html>