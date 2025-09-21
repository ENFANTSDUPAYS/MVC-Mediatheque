<?php
session_start();
include 'Models/connexion.php';

$page = $_GET['page'] ?? null;

$publicPages = ['login', 'register'];

if ($page === 'login') {
    require_once 'Controllers/LoginController.php';
    $controller = new LoginController();
    $controller->handleRequest();
}
if ($page === 'register') {
    require_once 'Controllers/RegisterController.php';
    $controller = new RegisterController();
    $controller->handleRequest();
    $viewPage = "Views/register.php";
    $title = "Inscription - Médiathèque";
}

//SWITCH POUR LES PAGES
if (isset($_SESSION['user'])) {
    switch ($page) {
        case 'home':
            $viewPage = 'Views/home.php';
            $title = 'Accueil - Médiathèque';
            break;
        case 'listMedia':
            $viewPage = 'Views/listMedia.php';
            $title = 'Liste des médias - Médiathèque';
            break;
        case 'addMedia':
            $viewPage = 'Views/addMedia.php';
            $title = 'Ajouter un média - Médiathèque';
            break;
        case 'editMedia':
            $viewPage = 'Views/editMedia.php';
            $title = 'Éditer un média - Médiathèque';
            break;
        case 'register':
            $viewPage = 'Views/register.php';
            $title = 'Inscription - Médiathèque';
            break;
        case 'logout':
            $viewPage = 'Models/logout.php';
            $title = 'Déconnexion - Médiathèque';
            break;
        case 'login':
            $viewPage = 'Views/login.php';
            $title = 'Connexion - Médiathèque';
            break;
        default:
            $viewPage = 'Views/home.php';
            $title = 'Accueil - Médiathèque';
            break;
    }
} else {
    if (in_array($page, $publicPages)) {
        $viewPage = "Views/$page.php";
        $title = ucfirst($page) . " - Médiathèque";
    } else {
        require_once 'Controllers/LoginController.php';
        $controller = new LoginController();
        $controller->handleRequest();
        $viewPage = 'Views/login.php';
        $title = 'Connexion - Médiathèque';
    }
}
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
                <a href="index.php"><h1 class="text-2xl font-bold">Médiathèque</h1></a>
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
    <div class="flex justify-center items-center w-full mt-8 min-h-[700px]">
        <?php if (file_exists($viewPage)) {
            include $viewPage;
        } else {
            include 'Views/404.php';
        } ?>
    </div>
    </body>
</html>