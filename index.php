<?php
session_start();
include 'Models/connexion.php';

$page = $_GET['page'] ?? 'home';

$publicPages = ['login', 'register', 'home', 'listMedia'];

$pages = [
    'home' => ['view' => 'Views/home.php', 'title' => 'Accueil - Médiathèque'],
    'listMedia' => ['view' => 'Views/list-media.php', 'title' => 'Liste des médias - Médiathèque'],
    'addMedia' => ['view' => 'Views/add-media.php', 'title' => 'Ajouter un média - Médiathèque'],
    'editMedia' => ['view' => 'Views/edit-media.php', 'title' => 'Éditer un média - Médiathèque'],
    'register' => ['view' => 'Views/register.php', 'title' => 'Inscription - Médiathèque'],
    'logout' => ['view' => 'Models/logout.php', 'title' => 'Déconnexion - Médiathèque'],
    'login' => ['view' => 'Views/login.php', 'title' => 'Connexion - Médiathèque']
];

if (!isset($_SESSION['user']) && !in_array($page, $publicPages)) {
    require_once 'Controllers/LoginController.php';
    $controller = new LoginController();
    $controller->handleRequest();
    $page = 'login';
}

switch ($page) {
    case 'login':
        require_once 'Controllers/LoginController.php';
        $controller = new LoginController();
        $controller->handleRequest();
        break;
    case 'register':
        require_once 'Controllers/RegisterController.php';
        $controller = new RegisterController();
        $controller->handleRequest();
        $success = $controller->success;
        break;
    case 'home':
        require_once 'Controllers/HomeController.php';
        $controller = new HomeController();
        $pagerfanta = $controller->handleRequest();
        break;
    case 'listMedia':
        require_once 'Controllers/MediaController.php';
        $controller = new MediaController();
        $pagerfanta = $controller->listMedia();
        break;
    case 'addMedia':
        require_once 'Controllers/MediaController.php';
        $controller = new MediaController();
        $pagerfanta = $controller->addMedia();
        $success = null;
        break;
    case 'editMedia':
        require_once 'Controllers/MediaController.php';
        $controller = new MediaController();
        $pagerfanta = $controller->editMedia();
        $success = null;
        break;
}
if (isset($pages[$page])) {
    $viewPage = $pages[$page]['view'];
    $title = $pages[$page]['title'];
} else {
    $viewPage = 'Views/error-404.php';
    $title = 'Page non trouvée - Médiathèque';
}

//AFFICHAGE MESSAGE SUCCESS
$success = $_SESSION['success'] ?? null;
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlspecialchars($title) ?></title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link rel="icon" type="image/png" href="assets/ico/ico.png"/>
    </head>
    <body class="flex items-center justify-center flex-col">
    <header class="w-full border-b-2 border-[#4338ca] bg-white shadow-md">
        <div class="container mx-auto py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <img class="h-12" src="assets/ico/ico.png" alt="Logo Médiathèque"/>
                <a href="index.php?page=home"><h1 class="text-2xl font-bold">Médiathèque</h1></a>
                <a href="index.php?page=listMedia" class="bg-[#4f39f6] text-white px-4 py-2 rounded hover:bg-[#3c2bd6]">Voir les médias</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="index.php?page=addMedia" class="bg-[#4f39f6] text-white px-4 py-2 rounded hover:bg-[#3c2bd6]">Ajouter un média</a>
                <?php endif; ?>
            </div>
            <div class="flex items-center space-x-4 font-semibold">
                <?php if (isset($_SESSION['user'])): ?>
                    <p><?= htmlspecialchars($_SESSION['user']['lastname'] .PHP_EOL . $_SESSION['user']['firstname']) ?></p>
                    <a href="index.php?page=logout" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Déconnexion</a>
                <?php else: ?>
                    <a href="index.php?page=login" class="bg-[#4338ca] text-white px-4 py-2 rounded hover:bg-blue-600">Connexion</a>
                <?php endif; ?>
        </div>
    </header>
    <div class="flex flex-col justify-center items-center w-full mt-8 min-h-[700px]">
        <?php if (file_exists($viewPage)) {
            include $viewPage;
        } else {
            include 'Views/error-404.php';
        } ?>
    </div>
    <?php if (!empty($success)): ?>
    <div id="success" class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg animate-fade">
        <?= htmlspecialchars($success) ?>
    </div>
    <?php endif; ?>

    <script>
        setTimeout(() => {
            document.getElementById('success')?.remove();
        }, 3000);
    </script>

    <style>
        @keyframes fade {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade {
            animation: fade 0.3s ease-in-out;
        }
    </style>
    </body>
</html>