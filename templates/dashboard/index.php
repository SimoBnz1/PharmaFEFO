<?php
/** @var array $processedLots */
/** @var array $notifications */
/** @var string|null $filter */
?>
<div class="space-y-8 animate-fade-in">
    
    <div class="bg-gradient-to-br from-white to-slate-50/50 p-6 rounded-3xl border border-slate-200/70 shadow-sm flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-10 left-1/3 w-48 h-48 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="flex items-start gap-4 relative z-10">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-xl shadow-xs shrink-0 text-emerald-600">
                
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight flex items-center gap-2">
                    Surveillance Globale des Lots
                </h2>
                <p class="text-xs text-slate-500 mt-1 font-medium max-w-xl leading-relaxed">
                    Visibilité analytique et traçabilité réglementaire ordonnées selon la méthode stricte <span class="text-emerald-600 font-bold">Premier Périmé, Premier Sorti (FEFO)</span>.
                </p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2 p-1.5 bg-slate-200/60 rounded-2xl border border-slate-300/30 w-full lg:w-auto relative z-10">
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                <a href="index.php?action=users" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-black transition-all shadow-sm flex items-center gap-2 uppercase tracking-wider hover:scale-[1.02] active:scale-[0.98]">
                    <span></span> Ajouter Collaborateur
                </a>
                <div class="h-5 w-px bg-slate-300 mx-1 hidden sm:block"></div>
            <?php endif; ?>

            <a href="index.php?action=dashboard" class="px-4 py-2 rounded-xl text-xs font-black transition-all uppercase tracking-wider text-center flex-1 lg:flex-none <?= !$filter ? 'bg-white text-slate-900 shadow-xs border border-slate-200/80 font-black' : 'text-slate-600 hover:text-slate-900' ?>">
                Tous les lots
            </a>
            
            <a href="index.php?action=dashboard&filter=ROUGE" class="px-4 py-2 rounded-xl text-xs font-black transition-all uppercase tracking-wider text-center flex-1 lg:flex-none flex items-center justify-center gap-1.5 <?= $filter === 'ROUGE' ? 'bg-rose-500 text-white shadow-xs' : 'bg-transparent text-rose-600 hover:bg-rose-50' ?>">
                <span class="w-2 h-2 rounded-full bg-rose-600 inline-block animate-pulse <?= $filter === 'ROUGE' ? 'bg-white' : '' ?>"></span> Alerte Critique (<30j)
            </a>
        </div>
    </div>

    <?php if (!empty($notifications)): ?>
        <div class="bg-gradient-to-br from-amber-50/70 via-orange-50/40 to-white border border-amber-200/80 rounded-3xl p-6 shadow-xs relative overflow-hidden">
            <div class="absolute -top-12 -right-12 text-amber-500/10 font-black text-9xl pointer-events-none select-none font-mono">30</div>
            
            <div class="flex items-center gap-2.5 font-black text-amber-900 text-xs tracking-wider uppercase mb-4">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                COULOIR D'ALERTE FEFO (PÉREMPTION PRÉVUE LE MOIS PROCHAIN)
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($notifications as $notif): ?>
                    <div class="bg-white/90 backdrop-blur border border-amber-200/60 hover:border-amber-300 p-4 rounded-2xl flex justify-between items-center shadow-xs group transition-all hover:shadow-sm">
                        <div class="space-y-1 max-w-[65%]">
                            <span class="font-black text-slate-900 block truncate group-hover:text-amber-900 transition-colors"><?= htmlspecialchars($notif['produit_nom']) ?></span>
                            <span class="inline-flex font-mono text-[10px] text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/40">Lot: <?= htmlspecialchars($notif['numero_lot']) ?></span>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="font-mono font-black text-amber-700 bg-amber-100/60 px-2.5 py-1 rounded-lg border border-amber-200 block text-xs shadow-2xs"><?= $notif['date_peremption'] ?></span>
                            <span class="text-[9px] text-amber-600 font-black uppercase tracking-wider block mt-1">Alerte Proche</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                <span class="w-2 h-4 bg-emerald-500 rounded-sm shadow-xs shadow-emerald-500/20"></span> Etat Virtuel d Stock Actif
            </h3>
            <span class="text-[11px] font-mono font-bold text-slate-500 bg-white px-3 py-1.5 rounded-xl border border-slate-200 shadow-2xs flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span> Total : <strong class="text-slate-900 font-black"><?= count($processedLots) ?></strong> lot(s) filtré(s)
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/30 border-b border-slate-200/60 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                        <th class="py-4 px-6">Désignation Produit</th>
                        <th class="py-4 px-4">Référence</th>
                        <th class="py-4 px-4">N° de Lot</th>
                        <th class="py-4 px-4">Quantité Physique</th>
                        <th class="py-4 px-4">DLU (Péremption)</th>
                        <th class="py-4 px-4">Indicateur Diagnostic</th>
                        <?php if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['pharmacien', 'admin'])): ?>
                            <th class="py-4 px-6 text-right">Actions Restrictives</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-100">
                    <?php if (empty($processedLots)): ?>
                        <tr>
                            <td colspan="7" class="py-16 px-6 text-center text-slate-400 font-medium bg-slate-50/10">
                                <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-3 shadow-2xs border border-slate-200/40">
                                    
                                </div>
                                <p class="text-sm font-bold text-slate-800">Aucun lot actif disponible</p>
                                <p class="text-xs text-slate-400 mt-0.5">Aucun lot ne correspond aux critères de tri actuels.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($processedLots as $l): ?>
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="py-4 px-6">
                                    <span class="font-black text-slate-900 block group-hover:text-emerald-900 transition-colors tracking-tight"><?= htmlspecialchars($l['produit_nom']) ?></span>
                                    <span class="inline-flex font-mono text-[10px] text-slate-400 bg-slate-50 px-1.5 py-0.5 rounded border border-slate-100 mt-1">Stock ID: #<?= $l['id'] ?></span>
                                </td>
                                
                                <td class="py-4 px-4 font-mono text-xs text-slate-500 group-hover:text-slate-700 transition-colors">
                                    <?= htmlspecialchars($l['reference']) ?>
                                </td>
                                
                                <td class="py-4 px-4 font-mono text-xs text-slate-800 font-bold">
                                    <span class="bg-slate-100/80 px-2 py-1 rounded-md border border-slate-200/40"><?= htmlspecialchars($l['numero_lot']) ?></span>
                                </td>
                                
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="font-black text-slate-900 text-base"><?= $l['quantite'] ?></span> 
                                    <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider ml-0.5">unités</span>
                                </td>
                                
                                <td class="py-4 px-4 font-mono text-xs font-black text-slate-900">
                                    <?= $l['date_peremption'] ?>
                                </td>
                                
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <?php if((isset($l['statut']) && $l['statut'] === 'EXPIRED') || (isset($l['badge_text']) && strpos($l['badge_text'], 'EXPIRED') !== false)): ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-rose-50 text-rose-700 border border-rose-200/60 shadow-2xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span> Périmé (Expired)
                                        </span>
                                    <?php elseif(strpos($l['badge_text'], 'Rouge') !== false): ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-rose-50 text-rose-700 border border-rose-200/60 shadow-2xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span> Critique (&lt;30j)
                                        </span>
                                    <?php elseif(strpos($l['badge_text'], 'Orange') !== false): ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200/60 shadow-2xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Vigilance (&lt;90j)
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200/60 shadow-2xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Conforme (&gt;6m)
                                        </span>
                                    <?php endif; ?>
                                </td>
                                
                                <?php if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['pharmacien', 'admin'])): ?>
                                    <td class="py-4 px-6 text-right whitespace-nowrap">
                                        <?php 
                                        // Condition strict : checking ila kan l-lot expired b d صح
                                        $isLotExpired = (isset($l['statut']) && $l['statut'] === 'EXPIRED') || (isset($l['badge_text']) && strpos($l['badge_text'], 'EXPIRED') !== false);
                                        
                                        if ($isLotExpired): ?>
                                            <form method="POST" action="index.php?action=retirer-petime" class="inline">
                                                <input type="hidden" name="lot_id" value="<?= $l['id'] ?>">
                                                <button type="submit" 
                                                        onclick="return confirm('Êtes-vous sûr de vouloir retirer ce lot périmé ? La valeur financière du gâchis sera calculée et ajoutée au rapport.')"
                                                        class="bg-rose-600 hover:bg-rose-700 text-white font-black text-[10px] uppercase tracking-widest px-3 py-2.5 rounded-xl transition-all inline-block border border-rose-600 shadow-2xs active:scale-95 cursor-pointer">
                                                     Retirer & Valider la perte
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-[11px] text-slate-400 font-semibold italic select-none">
                                                 Sécurisé (En Stock)
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>