<?php
/** @var array $products */
/** @var array|null $suggestedBatch */
/** @var int|null $selectedProductId */
/** @var string|null $error */
/** @var string|null $success */
?>
<div class="max-w-2xl mx-auto bg-gradient-to-br from-white to-slate-50/60 p-8 rounded-3xl border border-slate-200/80 shadow-md relative overflow-hidden animate-fade-in">
    
    <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="mb-8 border-b border-slate-100 pb-5 relative z-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-xl text-blue-600 shadow-2xs">
                
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">
                    Sorties de Stock Intelligentes (FEFO)
                </h2>
                <p class="text-xs text-slate-500 mt-0.5 font-medium">
                    Rôle : Préparateur / Pharmacien — Déstockage guidé selon la méthode <span class="text-emerald-600 font-bold">FEFO</span>
                </p>
            </div>
        </div>
    </div>

    <?php if (!empty($error)): ?>
        <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-600 rounded-xl text-rose-900 text-xs font-black flex items-center gap-2.5 shadow-2xs">
            <span></span> <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-600 rounded-xl text-emerald-900 text-xs font-black flex items-center gap-2.5 shadow-2xs">
            <span></span> <span><?= htmlspecialchars($success) ?></span>
        </div>
    <?php endif; ?>

    <form method="GET" action="index.php" class="mb-6 p-5 bg-slate-100/80 border border-slate-200/60 rounded-2xl relative z-10 shadow-2xs">
        <input type="hidden" name="action" value="dispense">
        
        <label class="block text-[11px] font-black uppercase tracking-widest text-slate-700 mb-2">1. Sélectionner le médicament demandé :</label>
        <div class="flex flex-col sm:flex-row gap-2.5">
            <div class="relative flex-grow">
                <select name="prod_id" class="w-full p-3.5 pr-10 border border-slate-200 rounded-xl bg-white text-sm font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all appearance-none cursor-pointer" required>
                    <option value="" class="text-slate-400 font-medium">-- Choisir un produit --</option>
                    <?php foreach ($products as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= ($selectedProductId == $p['id']) ? 'selected' : '' ?> class="text-slate-900 font-bold">
                            <?= htmlspecialchars($p['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 text-xs">
                    ▼
                </div>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-black text-xs px-6 py-3.5 sm:py-0 rounded-xl shadow-sm hover:shadow transition-all uppercase tracking-widest active:scale-[0.98] shrink-0 cursor-pointer">
                Analyser le Stock 🔍
            </button>
        </div>
    </form>

    <?php if ($selectedProductId): ?>
        <?php if ($suggestedBatch): ?>
            
            <div class="p-5 bg-gradient-to-br from-emerald-50/80 via-emerald-50/20 to-white border border-emerald-200 rounded-2xl text-sm mb-6 shadow-2xs relative overflow-hidden animate-fade-in">
                <div class="absolute -top-10 -right-10 text-emerald-500/5 font-black text-8xl pointer-events-none select-none font-mono">FEFO</div>
                
                <div class="flex items-center gap-2 font-black text-emerald-900 text-xs tracking-wider uppercase mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> MOTEUR FEFO DE VISIBILITÉ ACTIVÉ
                </div>
                <p class="text-xs text-slate-600 font-medium leading-relaxed">
                    Le système applique les règles de traçabilité. Veuillez prélever dans les rayons le lot suivant :
                </p>
                
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs bg-white/90 border border-emerald-100 p-4 rounded-xl shadow-3xs font-mono">
                    <div class="flex items-center justify-between sm:justify-start gap-2 text-slate-500">
                        <span>Numéro de Lot :</span> 
                        <span class="font-bold text-slate-900 bg-slate-100 px-2 py-0.5 rounded border border-slate-200/40 font-sans text-xs"><?= htmlspecialchars($suggestedBatch['numero_lot']) ?></span>
                    </div>
                    <div class="flex items-center justify-between sm:justify-end gap-2 text-slate-500">
                        <span>Péremption (DLU) :</span> 
                        <span class="font-black text-rose-600 bg-rose-50 px-2.5 py-0.5 rounded border border-rose-100 text-xs"><?= $suggestedBatch['date_peremption'] ?></span>
                    </div>
                    <div class="col-span-1 sm:col-span-2 mt-2 pt-2.5 border-t border-dashed border-emerald-200/70 text-slate-700 font-sans flex items-center justify-between">
                        <span class="text-xs font-medium">Stock physique disponible sur ce lot :</span>
                        <span class="font-black text-emerald-700 text-sm bg-emerald-100/50 px-2.5 py-0.5 rounded-lg border border-emerald-200/40"><?= $suggestedBatch['quantite'] ?> unités</span>
                    </div>
                </div>
            </div>

            <form method="POST" action="index.php?action=dispense" class="space-y-5 relative z-10 animate-fade-in">
                <input type="hidden" name="lot_id" value="<?= $suggestedBatch['id'] ?>">
                
                <div class="space-y-1.5">
                    <label class="block text-[11px] font-black uppercase tracking-widest text-slate-700">Quantité à vendre / dispenser :</label>
                    <input type="number" name="qty" min="1" max="<?= $suggestedBatch['quantite'] ?>" placeholder="Ex: 5" class="w-full p-3.5 border border-slate-200 rounded-xl text-sm font-black text-slate-900 placeholder-slate-400 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white transition-all" required>
                    <span class="text-[10px] text-slate-400 font-medium block mt-1 flex items-center gap-1">
                        La quantité maximale autorisée pour cette transaction est bridée à <strong class="text-slate-700 font-bold"><?= $suggestedBatch['quantite'] ?> u.</strong>
                    </span>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs py-4 px-6 rounded-xl shadow-md hover:shadow-lg hover:shadow-emerald-600/10 transition-all uppercase tracking-widest active:scale-[0.99] cursor-pointer">
                        Confirmer le déstockage automatique 
                    </button>
                </div>
            </form>

        <?php else: ?>
            <div class="p-6 bg-rose-50 border border-rose-200 text-rose-900 rounded-2xl text-center shadow-2xs relative overflow-hidden animate-fade-in">
                <div class="w-12 h-12 bg-rose-100 border border-rose-200 rounded-full flex items-center justify-center text-xl mx-auto mb-3">
                    
                </div>
                <h4 class="text-sm font-black uppercase tracking-wide">Rupture de stock critique !</h4>
                <p class="text-xs text-rose-700 font-medium mt-1">Aucun lot actif ou disponible n'a été trouvé dans la base pour ce produit.</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>