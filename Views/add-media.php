<div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
    <h1 class="text-2xl font-bold text-[#4f39f6] mb-6 text-center">Ajouter un Média</h1>

    <?php if(!empty($error)): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-4" id="mediaForm">
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

        <div>
            <label for="available" class="block text-gray-700 font-semibold mb-2">Disponible :</label>
            <select name="available" id="available" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f39f6]">
                <option value="">Sélectionner</option>
                <option value="1">Disponible</option>
                <option value="0">Indisponible</option>
            </select>
        </div>

        <div>
            <label for="type" class="block text-gray-700 font-semibold mb-2">Type :</label>
            <select name="type" id="type" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f39f6]">
                <option value="">Choisir un type</option>
                <option value="movie">Film</option>
                <option value="book">Livre</option>
                <option value="song">Chanson</option>
                <option value="album">Album</option>
            </select>
        </div>

        <div id="movieFields" class="space-y-4 mt-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Durée (minutes) :</label>
                <input type="number" name="duration" min="1" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f39f6]">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Genre :</label>
                <select name="genre_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f39f6]">
                    <option value="">Choisir un genre</option>
                    <?php
                    $pdo = getConnexion();
                    $genres = $pdo->query("SELECT id, name FROM genre")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($genres as $genre) {
                        echo "<option value=\"{$genre['id']}\">".htmlspecialchars($genre['name'])."</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <div id="bookFields" class="space-y-4 mt-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nombre de pages :</label>
                <input type="number" name="pagenumber" min="1" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f39f6]">
            </div>
        </div>

        <div id="albumFields" class="space-y-4 mt-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nom de l'éditeur :</label>
                <input type="text" name="editor" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f39f6]">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Ajouter des chansons :</label>
                <select name="id_song[]" multiple class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f39f6]">
                    <?php
                    $songs = $pdo->query("SELECT id, title FROM song WHERE album_id IS NULL ORDER BY title")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($songs as $song) {
                        echo "<option value=\"{$song['id']}\">".htmlspecialchars($song['title'])."</option>";
                    }
                    ?>
                </select>
                <small class="text-gray-500">Ctrl/Cmd + clic pour sélectionner plusieurs chansons</small>
            </div>
        </div>
        
        <div id="songFields" class="space-y-4 mt-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Ajouter à un album :</label>
                <select name="album_id" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">Aucun</option>
                    <?php
                    $albums = $pdo->query("SELECT id, title FROM album")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($albums as $album) {
                        echo "<option value=\"{$album['id']}\">".htmlspecialchars($album['title'])."</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="index.php?page=listMedia" class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600">Retour</a>
            <button type="submit" class="px-4 py-2 rounded bg-[#4f39f6] text-white hover:bg-[#3c2bd6]">Ajouter</button>
        </div>
    </form>
</div>

