<div class="w-full max-w-md">
  <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
    <div class="p-6">
      <h1 class="text-2xl font-bold text-gray-800 text-center mb-4">Se connecter</h1>

      <?php if (!empty($controller->errors)): ?>
        <div class="mb-4">
          <div class="bg-red-50 border border-red-200 text-red-800 text-sm rounded p-3">
            <ul class="list-disc pl-5">
              <?php foreach ($controller->errors as $err): ?>
                <li><?= htmlspecialchars($err, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8') ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <form method="POST" class="space-y-4" novalidate autocomplete="on">

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
          <input id="email" name="email" type="email" required autocomplete="username"
                  value="<?= htmlspecialchars($controller->email)?>"
                  class="w-full rounded-lg border border-gray-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                  placeholder="ton@exemple.com">
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
          <input id="password" name="password" type="password" required autocomplete="current-password"
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
          Pas de compte ? <a href="index.php?page=register" class="text-indigo-600 hover:underline">S'inscrire</a>
        </p>
        <p class="text-sm text-center text-gray-500">
          Email : charle.haller@ec2e.com | Mot de passe : Charle21Haller!1999
        </p>
      </form>
    </div>

    <div class="bg-gray-50 border-t border-gray-100 p-4 text-center text-xs text-gray-500">
      Médiathèque — Connexion sécurisée
    </div>
  </div>
</div>
