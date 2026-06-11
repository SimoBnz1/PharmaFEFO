<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold text-amber-800 mb-4"> Notifications Système (Gestionnaire d'Anticipation)</h2>
    <p class="text-gray-600 text-sm mb-4">Lots de médicaments arrivant à péremption le mois prochain :</p>

    <?php if (empty($notifications)): ?>
        <div class="p-4 bg-green-50 text-green-700 rounded text-center font-bold">
             Aucun médicament ne va périmer le mois prochain. Bon travail d'anticipation !
        </div>
    <?php else: ?>
        <div class="space-y-3">
            <?php foreach ($notifications as $n): ?>
                <div class="p-3 bg-amber-50 border-l-4 border-amber-500 rounded flex justify-between items-center">
                    <div>
                        <span class="font-bold text-gray-800"><?= htmlspecialchars($n['produit_nom']) ?></span>
                        <p class="text-xs text-gray-500">Numéro de Lot: <span class="font-mono"><?= htmlspecialchars($n['numero_lot']) ?></span></p>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-bold text-amber-700"><?= $n['date_peremption'] ?></span>
                        <p class="text-xs text-gray-400">Quantité en stock: <?= $n['quantite'] ?> u</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mt-6 text-center">
        <a href="/index.php?action=dashboard" class="text-indigo-600 hover:underline text-sm">← Retour au Dashboard central</a>
    </div>
</div>