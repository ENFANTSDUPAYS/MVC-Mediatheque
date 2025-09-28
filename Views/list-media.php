<?php
$queryParams = $_GET;
?>
<h1 class="text-3xl font-bold mb-6 text-center text-indigo-600">Liste des médias de la Médiathèque</h1>

<div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-6">
    <?php if (!empty($errors)): ?>
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($pagerfanta)): ?>
        <div class="overflow-x-auto">
            <div class=" flex justify-center max-w-5xl mx-auto mb-6">
                <form method="GET" class="flex flex-wrap gap-4 items-end">
                    <input type="hidden" name="page" value="listMedia">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Titre</label>
                        <input type="text" placeholder="Taper un titre..." name="title" value="<?= htmlspecialchars($_GET['title'] ?? '') ?>" class="border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Auteur</label>
                        <input type="text" placeholder="Taper un nom..." name="author" value="<?= htmlspecialchars($_GET['author'] ?? '') ?>" class="border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Disponibilité</label>
                        <select name="available" class="border rounded px-3 py-2">
                            <option value="">Tous</option>
                            <option value="1" <?= (isset($_GET['available']) && $_GET['available'] === '1') ? 'selected' : '' ?>>Disponible</option>
                            <option value="0" <?= (isset($_GET['available']) && $_GET['available'] === '0') ? 'selected' : '' ?>>Indisponible</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Rechercher</button>
                    </div>
                </form>
            </div>

            <table class="w-full border-collapse bg-gray-50 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-indigo-600 text-white text-left">
                        <th class="p-3">Type</th>
                        <th class="p-3">Titre</th>
                        <th class="p-3">Auteur</th>
                        <th class="p-3">Disponibilité</th>
                        <th class="p-3">Créé le</th>
                    <?php 
                    if(isset($_SESSION['user'])){ ?>
                        <th class="p-3">Modifier</th>
                        <th class="p-3">Supprimer</th>
                   <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagerfanta as $media):
                            switch ($media['type']) {
                                case 'Livre': $type = 'book'; break;
                                case 'Album': $type = 'album'; break;
                                case 'Film': $type = 'movie'; break;
                                case 'Chanson': $type = 'song'; break;
                                default: $type = ''; break;
                            }?>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="p-3 font-semibold text-gray-700"><?= htmlspecialchars($media['type']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($media['title']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($media['author']) ?></td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full text-sm font-medium <?= $media['available'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                                    <?= $media['available'] ? 'Disponible' : 'Indisponible' ?>
                                </span>
                            </td>
                            <td class="p-3"><?= htmlspecialchars($media['created_at']) ?></td>
                            <?php 
                                if(isset($_SESSION['user'])){ ?>
                                <td class="p-3">
                                    <button 
                                        onclick="window.location.href='index.php?page=editMedia&id=<?= $media['id'] ?>'" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors duration-200">
                                        Modifier
                                    </button>
                                </td>
                                <td class="p-3">
                                    <a href="index.php?page=deleteMedia&id=<?= $media['id'] ?>&type=<?= $type ?>"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce média ?');"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors duration-200">
                                    Supprimer
                                    </a>
                                </td>

                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="mt-4 flex justify-center gap-2">
                <?php for ($i = 1; $i <= $pagerfanta->getNbPages(); $i++): ?>
                    <?php
                        $queryParams['page'] = 'listMedia';
                        $queryParams['pageNum'] = $i;
                        $url = '?' . http_build_query($queryParams);
                    ?>
                    <a href="<?= $url ?>"
                    class="px-3 py-1 border rounded <?= $i == $pagerfanta->getCurrentPage() ? 'bg-indigo-600 text-white' : 'bg-gray-200' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-500 mt-4">Aucun média trouvé.</p>
    <?php endif; ?>
</div>
