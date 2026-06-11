<?php
/** @var float $totalLoss */
?>
<div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100 text-center">
    
    <div class="mb-6 border-b pb-4">
        <h2 class="text-xl font-black text-gray-950 flex items-center justify-center gap-2">
            Rapport Financier Mensuel
        </h2>
        <p class="text-xs text-gray-500 mt-1">Rôle : Administrateur — Extraction de la valeur du stock perdu</p>
    </div>

    <p class="text-xs text-gray-400 mb-6 font-medium">Ce rapport comptabilise la valeur financière des médicaments dont le statut a été basculé en <span class="font-mono bg-red-100 text-red-700 px-1 rounded font-bold">Status::EXPIRED</span>.</p>
    
    <div class="p-8 bg-red-50/60 rounded-2xl border border-red-100 shadow-inner mb-4">
        <span class="block text-xs font-black text-red-600 uppercase tracking-widest">Valeur Totale du Gâchis</span>
        <span class="text-4xl font-black text-red-700 mt-2 block tracking-tight font-mono">
            <?= number_format($totalLoss, 2) ?> <span class="text-lg">DH</span>
        </span>
    </div>

    <div class="text-[11px] text-gray-400 flex items-center justify-center gap-1 mt-6">
        <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span>
        Données synchronisées en temps réel avec la table rapports_perte.
    </div>
</div>