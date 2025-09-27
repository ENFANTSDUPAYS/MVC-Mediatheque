<div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
    <h1 class="text-2xl font-bold text-[#4f39f6] mb-6 text-center">Ajouter un Média</h1>

    <?php if(!empty($error)): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php elseif($success): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">Média ajouté avec succès !</div>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-4">
        <div>
            <label for="title" class="block text-gray-700 font-semibold mb-2">Titre :</label>
            <input type="text" name="title" id="title" placeholder="Titre du média" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f39f6]">
        </div>

        <div>
            <label for="author" class="block text-gray-700 font-semibold mb-2">Auteur :</label>
            <input type="text" name="author" id="author" placeholder="Auteur du média" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f39f6]">
        </div>

        <div class="flex justify-between mt-6">
            <a href="index.php?page=listMedia" class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600">Retour</a>
            <button type="submit" class="px-4 py-2 rounded bg-[#4f39f6] text-white hover:bg-[#3c2bd6]">Ajouter</button>
        </div>
    </form>
</div>