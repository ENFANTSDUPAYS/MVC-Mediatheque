<?php
$id = $_GET['id'] ?? null;
$type = $_GET['type'] ?? null;

if (!$id || !$type) {
    echo "<div class='bg-red-200 text-red-800 p-3 rounded'>Média invalide</div>";
    exit;
}
?>

<h1 class="text-2xl font-bold text-center mb-6">Modifier <?= ucfirst($type) ?></h1>

<form action="index.php?page=updateMedia" method="POST" class="space-y-4">
    <input type="hidden" name="id" value="<?= $media->getId() ?>">
    <input type="hidden" name="type" value="<?= $type ?>">

    <div>
        <label>Titre :</label>
        <input type="text" name="title" value="<?= htmlspecialchars($media->getTitle()) ?>" required>
    </div>

    <div>
        <label>Auteur :</label>
        <input type="text" name="author" value="<?= htmlspecialchars($media->getAuthor()) ?>" required>
    </div>

    <div>
        <label>Disponible :</label>
        <select name="available" required>
            <option value="1" <?= $media->getAvailable() ? 'selected' : '' ?>>Oui</option>
            <option value="0" <?= !$media->getAvailable() ? 'selected' : '' ?>>Non</option>
        </select>
    </div>

    <?php if ($type === 'movie'): ?>
        <div>
            <label>Durée (minutes) :</label>
            <input type="number" name="duration" value="<?= $media->getDuration() ?>">
        </div>
        <div>
            <label>Genre :</label>
            <select name="genre_id">
                <?php
                $pdo = getConnexion();
                $genres = $pdo->query("SELECT id, title FROM genre ORDER BY title")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($genres as $genre) {
                    $selected = $media->getGenre()->getId() == $genre['id'] ? 'selected' : '';
                    echo "<option value='{$genre['id']}' $selected>".htmlspecialchars($genre['title'])."</option>";
                }
                ?>
            </select>
        </div>
    <?php elseif ($type === 'book'): ?>
        <div>
            <label>Nombre de pages :</label>
            <input type="number" name="pagenumber" value="<?= $media->getPageNumber() ?>">
        </div>
    <?php elseif ($type === 'album'): ?>
        <div>
            <label>Éditeur :</label>
            <input type="text" name="editor" value="<?= htmlspecialchars($media->getEditor()) ?>">
        </div>
        <div>
            <label>Chansons :</label>
            <select name="id_song[]" multiple>
                <?php
                $songs = $pdo->query("SELECT id, title FROM song ORDER BY title")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($songs as $song) {
                    $selected = in_array($song['id'], $media->getSongIds()) ? 'selected' : '';
                    echo "<option value='{$song['id']}' $selected>".htmlspecialchars($song['title'])."</option>";
                }
                ?>
            </select>
        </div>
    <?php endif; ?>

    <button type="submit">Modifier</button>
</form>
