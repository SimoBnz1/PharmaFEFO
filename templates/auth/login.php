<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - PharmaFEFO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center font-sans">

<div class="max-w-md w-full bg-white p-8 rounded-xl shadow-md border border-gray-200">
    <div class="text-center mb-6">
        <span class="text-4xl">💊</span>
        <h2 class="text-2xl font-black text-gray-950 mt-2">Pharma<span class="text-indigo-600">FEFO</span></h2>
        <p class="text-xs text-gray-400 mt-1">Gestion Sécurisée des Stocks Virtuels</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-600 text-red-900 text-xs font-bold rounded">
             <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=login" class="space-y-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">Email Professionnel :</label>
            <input type="email" name="email" placeholder="Ex: admin@pharma.com" class="w-full p-3 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500" required>
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">Mot de Passe :</label>
            <input type="password" name="password" placeholder="••••••••" class="w-full p-3 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500" required>
        </div>
        <button type="submit" class="w-full bg-indigo-700 hover:bg-indigo-800 text-white font-bold p-3 rounded-lg text-sm transition-all uppercase tracking-wider">
            Se Connecter
        </button>
    </form>
</div>

</body>
</html>