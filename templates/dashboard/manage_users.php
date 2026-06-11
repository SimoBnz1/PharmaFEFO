<?php
/** @var array $usersList */
/** @var string|null $error */
/** @var string|null $success */
?>
<!-- templates/dashboard/users.php -->
<div class="space-y-8 animate-fade-in">
    
    <!-- HEADER BAR WITH PREMIUM LEVEL BADGE -->
    <div class="bg-gradient-to-br from-white to-slate-50/50 p-6 rounded-3xl border border-slate-200/70 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-48 h-48 bg-purple-500/5 rounded-full blur-2xl pointer-events-none"></div>
        
        <div class="flex items-center gap-3 relative z-10">
            <div class="w-11 h-11 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-xl text-purple-600 shadow-2xs">
                👤
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                    Gestion des Comptes & Équipe
                </h2>
                <p class="text-xs text-slate-500 mt-0.5 font-medium">Espace Administrateur — Configuration des accès restrictifs et rôles applicatifs</p>
            </div>
        </div>
        
        <div class="bg-purple-950/5 text-purple-700 border border-purple-200/60 px-3 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 shadow-2xs shrink-0 relative z-10">
            <span class="w-2 h-2 rounded-full bg-purple-600 animate-pulse"></span> Mode Admin Strict
        </div>
    </div>

    <!-- MAIN TWO-COLUMN BENTO GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- COLUMN 1: INTERACTIVE FORM CARD -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/80 lg:col-span-1 h-fit lg:sticky lg:top-24 relative overflow-hidden">
            <div class="absolute -top-12 -right-12 w-24 h-24 bg-purple-500/5 rounded-full blur-xl pointer-events-none"></div>
            
            <div class="mb-6 pb-4 border-b border-slate-100">
                <h3 class="text-base font-black text-slate-900 flex items-center gap-2">
                    Ajouter un Collaborateur
                </h3>
                <p class="text-xs text-slate-400 mt-0.5 font-medium">Créez un compte sécurisé pour l'équipe</p>
            </div>

            <!-- Contextual Notifications -->
            <?php if (!empty($error)): ?>
                <div class="mb-4 p-4 bg-rose-50 border-l-4 border-rose-600 text-rose-900 text-xs font-black rounded-xl flex items-center gap-2.5 shadow-2xs">
                    <span></span> <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="mb-4 p-4 bg-emerald-50 border-l-4 border-emerald-600 text-emerald-900 text-xs font-black rounded-xl flex items-center gap-2.5 shadow-2xs">
                    <span></span> <span><?= htmlspecialchars($success) ?></span>
                </div>
            <?php endif; ?>

            <!-- Form Body -->
            <form method="POST" action="index.php?action=users" class="space-y-4">
                
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700">Nom :</label>
                        <input type="text" name="nom" placeholder="Nom" 
                               class="w-full p-3 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder-slate-400 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700">Prénom :</label>
                        <input type="text" name="prenom" placeholder="Prénom" 
                               class="w-full p-3 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder-slate-400 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all" required>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700">Email Professionnel :</label>
                    <input type="email" name="email" placeholder="Ex: sara@pharma.com" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm font-mono font-bold text-slate-800 placeholder-slate-400 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all" required>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700">Mot de passe provisoire :</label>
                    <input type="password" name="password" placeholder="••••••••" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder-slate-400 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all" required>
                    <span class="text-[9px] text-slate-400 font-medium block mt-1 leading-normal"> Le mot de passe sera automatiquement crypté via PASSWORD_BCRYPT.</span>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700">Rôle & Droits d'accès :</label>
                    <div class="relative">
                        <select name="role" class="w-full p-3 border border-slate-200 rounded-xl text-xs font-black bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer appearance-none" required>
                            <option value="pharmacien"> Pharmacien Titulaire </option>
                            <option value="preparateur"> Préparateur en Pharmacie </option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400 text-[10px]">
                            ▼
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-black text-xs py-3.5 px-4 rounded-xl shadow-md hover:shadow-lg hover:shadow-purple-600/10 transition-all uppercase tracking-widest active:scale-[0.99] cursor-pointer">
                        Créer l'accès sécurisé
                    </button>
                </div>
            </form>
        </div>

        <!-- COLUMN 2: HIGH-DENSITY DIRECTORY TABLE -->
        <div class="bg-white p-6 rounded-3xl shadow-xs border border-slate-200/80 lg:col-span-2 overflow-hidden">
            <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                <div>
                    <h3 class="text-base font-black text-slate-900">Utilisateurs Enregistrés</h3>
                    <p class="text-xs text-slate-400 mt-0.5 font-medium">Visualisation des comptes actifs disposant d'un rôle d'authentification</p>
                </div>
                <span class="text-[10px] font-mono font-bold bg-slate-50 text-slate-400 px-2.5 py-1 rounded-lg border border-slate-200/60 shadow-2xs">
                    Actifs : <?= count($usersList) ?>
                </span>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-100 shadow-2xs">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-200/60 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                            <th class="p-4 pl-6">Membre de l'Équipe</th>
                            <th class="p-4">Identifiant / Email</th>
                            <th class="p-4 text-center pr-6">Niveau de Privilèges</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100">
                        <?php foreach ($usersList as $u): ?>
                            <tr class="hover:bg-slate-50/40 transition-colors group">
                                <!-- User Identity Block -->
                                <td class="p-4 pl-6 flex items-center gap-3">
                                    <!-- Avatar initials dynamic wrapper -->
                                    <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-700 border border-purple-200/40 font-black text-xs flex items-center justify-center uppercase shadow-2xs shrink-0 group-hover:bg-purple-600 group-hover:text-white group-hover:border-purple-600 transition-all duration-200">
                                        <?= mb_substr($u['prenom'], 0, 1) . mb_substr($u['nom'], 0, 1) ?>
                                    </div>
                                    <div class="overflow-hidden">
                                        <div class="font-black text-slate-900 truncate group-hover:text-purple-950 transition-colors"><?= htmlspecialchars($u['nom'] . ' ' . $u['prenom']) ?></div>
                                        <div class="text-[10px] text-slate-400 font-mono mt-0.5">ID Système : #<?= $u['id'] ?></div>
                                    </div>
                                </td>
                                
                                <!-- Email Address -->
                                <td class="p-4 font-mono text-xs text-slate-500 group-hover:text-slate-800 transition-colors whitespace-nowrap">
                                    <?= htmlspecialchars($u['email']) ?>
                                </td>
                                
                                <!-- Role Badge Controller -->
                                <td class="p-4 text-center pr-6 whitespace-nowrap">
                                    <?php if ($u['role'] === 'admin'): ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-purple-50 text-purple-700 border border-purple-200 rounded-xl text-[10px] font-black uppercase tracking-wider shadow-2xs">
                                            <span class="w-1 h-1 rounded-full bg-purple-500"></span> Super Admin
                                        </span>
                                    <?php elseif ($u['role'] === 'pharmacien'): ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-xl text-[10px] font-black uppercase tracking-wider shadow-2xs">
                                            <span class="w-1 h-1 rounded-full bg-amber-500"></span> Pharmacien
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl text-[10px] font-black uppercase tracking-wider shadow-2xs">
                                            <span class="w-1 h-1 rounded-full bg-emerald-500"></span> Préparateur
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>