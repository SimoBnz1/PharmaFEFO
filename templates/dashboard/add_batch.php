<?php
/** @var array $products Zid had l-khit bch intelephense yfhamha direct */
?>
<div class="max-w-2xl mx-auto bg-gradient-to-br from-white to-slate-50/60 p-8 rounded-3xl border border-slate-200/80 shadow-md relative overflow-hidden animate-fade-in">
    
    <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="mb-8 border-b border-slate-100 pb-5 relative z-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-xl text-emerald-600 shadow-2xs">
                
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">
                    Réception & Entrées Intelligentes
                </h2>
                <p class="text-xs text-slate-500 mt-0.5 font-medium">
                    Espace Opérationnel — Saisie sécurisée des lots et synchronisation du moteur <span class="text-emerald-600 font-bold">FEFO</span>
                </p>
            </div>
        </div>
        
        <div class="mt-4 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-wider border border-slate-200/40">
            <span>🛡️</span> Rôle requis : Préparateur / Pharmacien
        </div>
    </div>

    <?php if (!empty($error)): ?>
        <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-600 rounded-xl text-rose-900 text-xs font-black flex items-center gap-2.5 shadow-2xs">
            <span class="text-base"></span> <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-600 rounded-xl text-emerald-900 text-xs font-black flex items-center gap-2.5 shadow-2xs">
            <span class="text-base"></span> <span><?= htmlspecialchars($success) ?></span>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=add-batch" class="space-y-5 relative z-10">
        
        <div class="space-y-1.5">
            <label class="block text-[11px] font-black uppercase tracking-widest text-slate-700">Médicament Réceptionné :</label>
            <div class="relative">
                <select name="produit_id" class="w-full p-3.5 border border-slate-200 rounded-xl bg-slate-50/50 text-sm font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white transition-all appearance-none cursor-pointer" required>
                    <option value="" class="text-slate-400 font-medium">-- Choisir un produit de la base --</option>
                    <?php foreach ($products as $p): ?>
                        <option value="<?= $p['id'] ?>" class="text-slate-900 font-bold">
                            <?= htmlspecialchars($p['nom']) ?> (Ref: <?= htmlspecialchars($p['reference']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 text-xs">
                    
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-[11px] font-black uppercase tracking-widest text-slate-700">Numéro de Lot (Batch) :</label>
                <input type="text" name="numero_lot" placeholder="Ex: LOT-2026-AUGM" class="w-full p-3.5 border border-slate-200 rounded-xl text-sm font-mono font-bold text-slate-800 placeholder-slate-400 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white transition-all" required>
            </div>

            <div class="space-y-1.5">
                <label class="block text-[11px] font-black uppercase tracking-widest text-slate-700">Quantité (Boîtes) :</label>
                <input type="number" name="quantite" min="1" placeholder="Ex: 100" class="w-full p-3.5 border border-slate-200 rounded-xl text-sm font-black text-slate-900 placeholder-slate-400 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white transition-all" required>
            </div>
        </div>

        <div class="space-y-1.5">
            <label class="block text-[11px] font-black uppercase tracking-widest text-slate-700">Date de Péremption (DLU) :</label>
            <input type="date" name="date_peremption" class="w-full p-3.5 border border-slate-200 rounded-xl text-sm font-mono font-black text-slate-900 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white transition-all" required>
            <span class="text-[10px] text-slate-400 font-medium block mt-1 flex items-center gap-1">
                 Le système validera uniquement si la date est supérieure ou égale à aujourd'hui.
            </span>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs py-4 px-6 rounded-xl shadow-md hover:shadow-lg hover:shadow-emerald-600/10 transition-all uppercase tracking-widest active:scale-[0.99] cursor-pointer">
                Enregistrer 
            </button>
        </div>

    </form>
</div>