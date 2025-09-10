<?php
include 'Models/connexion.php';
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>La médiathèque</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_onjFFfxw6tlc3KSzJ1POV2sR-8W4t5i-qg&s"/>
    </head>
    <body>
    <header class="w-full border-b-4 border-green-300 bg-white shadow-md">
        <div class="container mx-auto py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Médiathèque</h1>
            <div>
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="mr-4">Bonjour, <?php echo htmlspecialchars($_SESSION['user']); ?></span>
                    <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Déconnexion</a>
                <?php else: ?>
                    <a href="Views/login.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Connexion</a>
                <?php endif; ?>
        </div>
    </header>
    </body>
</html>