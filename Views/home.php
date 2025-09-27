<h1 class="text-3xl font-bold mb-6 text-center text-indigo-600">Bienvenue à la Médiathèque</h1>

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
            <table class="w-full border-collapse bg-gray-50 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-indigo-600 text-white text-left">
                        <th class="p-3">Type</th>
                        <th class="p-3">Titre</th>
                        <th class="p-3">Auteur</th>
                        <th class="p-3">Disponibilité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagerfanta as $media): ?>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="p-3 font-semibold text-gray-700"><?= htmlspecialchars($media['type']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($media['title']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($media['author']) ?></td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full text-sm font-medium <?= $media['available'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                                    <?= $media['available'] ? 'Disponible' : 'Indisponible' ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="mt-4 flex justify-center gap-2">
                <?php for ($i = 1; $i <= $pagerfanta->getNbPages(); $i++): ?>
                    <a href="?page=home&pageNum=<?= $i ?>" class="px-3 py-1 border rounded <?= $i == $pagerfanta->getCurrentPage() ? 'bg-indigo-600 text-white' : 'bg-gray-200' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-500 mt-4">Aucun média trouvé.</p>
    <?php endif; ?>
</div>
