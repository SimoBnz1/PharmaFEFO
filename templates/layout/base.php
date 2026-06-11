<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaFEFO — Moteur de Stock Virtuel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        medical: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#172554',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body class="bg-slate-50 text-slate-900 antialiased font-sans min-h-screen flex">

    <!-- Overlay mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <aside id="sidebar" class="w-72 bg-gradient-to-b from-medical-950 via-slate-900 to-slate-950 text-slate-400 fixed h-full top-0 left-0 z-50 flex flex-col justify-between border-r border-slate-800/80 shadow-2xl -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">

        <div class="flex flex-col flex-1 overflow-y-auto">
            <!-- Logo -->
            <div class="p-6 border-b border-slate-800/60 flex items-center gap-3 bg-medical-950/50">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-medical-500 to-medical-700 border border-medical-400/30 flex items-center justify-center shadow-lg shadow-medical-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-black text-white tracking-tight leading-none">Pharma<span class="text-medical-400 font-mono">FEFO</span></h1>
                    <span class="text-[10px] text-medical-400/80 font-bold tracking-widest uppercase">Moteur de Stock</span>
                </div>
            </div>

            <?php if (isset($_SESSION['user_nom'])): ?>
                <div class="m-4 p-4 rounded-2xl bg-slate-800/50 border border-slate-700/40 flex items-center gap-3 backdrop-blur-sm">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 text-white font-black text-xs flex items-center justify-center uppercase shadow-md shadow-emerald-500/20 ring-2 ring-emerald-400/20">
                        <?= mb_substr($_SESSION['user_nom'], 0, 2) ?>
                    </div>
                    <div class="overflow-hidden flex-1 min-w-0">
                        <p class="font-semibold text-sm text-white truncate"><?= htmlspecialchars($_SESSION['user_nom']) ?></p>
                        <span class="text-[9px] px-2 py-0.5 rounded-md font-mono bg-emerald-500/10 text-emerald-400 border border-emerald-400/25 uppercase tracking-wider inline-block mt-1 font-bold">
                            <?= htmlspecialchars($_SESSION['user_role']) ?>
                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <nav class="px-3 py-2 space-y-1 flex-1">
                <span class="px-4 text-[10px] font-black uppercase tracking-wider text-slate-500 block mb-3 mt-2">Navigation Principale</span>

                <a href="index.php?action=dashboard" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 hover:bg-medical-500/10 hover:text-white group text-slate-300">
                    <span class="w-9 h-9 rounded-lg bg-slate-800/80 group-hover:bg-medical-500/20 flex items-center justify-center transition-all duration-200 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-medical-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                    </span>
                    Tableau de Bord
                </a>

                <?php if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['preparateur', 'pharmacien', 'admin'])): ?>
                    <a href="index.php?action=add-batch" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 hover:bg-emerald-500/10 hover:text-white group text-slate-300">
                        <span class="w-9 h-9 rounded-lg bg-slate-800/80 group-hover:bg-emerald-500/20 flex items-center justify-center transition-all duration-200 group-hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-emerald-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </span>
                        Entrée de Lot
                    </a>
                    <a href="index.php?action=dispense" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 hover:bg-orange-500/10 hover:text-white group text-slate-300">
                        <span class="w-9 h-9 rounded-lg bg-slate-800/80 group-hover:bg-orange-500/20 flex items-center justify-center transition-all duration-200 group-hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-orange-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                            </svg>
                        </span>
                        Sortie Intelligente
                    </a>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <span class="px-4 pt-5 text-[10px] font-black uppercase tracking-wider text-slate-500 block mb-3">Privilèges Admin</span>
                    <a href="index.php?action=users" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 hover:bg-purple-500/10 text-purple-300 hover:text-purple-200 group border border-transparent hover:border-purple-500/20">
                        <span class="w-9 h-9 rounded-lg bg-purple-500/10 group-hover:bg-purple-500/20 flex items-center justify-center transition-all duration-200 group-hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-purple-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </span>
                        Gestion Équipe
                    </a>
                    <a href="index.php?action=report" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 hover:bg-purple-500/10 text-purple-300 hover:text-purple-200 group border border-transparent hover:border-purple-500/20">
                        <span class="w-9 h-9 rounded-lg bg-purple-500/10 group-hover:bg-purple-500/20 flex items-center justify-center transition-all duration-200 group-hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-purple-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </span>
                        Rapport Financier
                    </a>

                   

                <?php endif; ?>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-800/60 bg-slate-950/40 backdrop-blur-sm">
            <a href="index.php?action=logout" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-xl bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white text-xs font-black uppercase tracking-wider transition-all duration-200 border border-red-500/25 shadow-sm hover:shadow-red-500/25">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
                Déconnexion
            </a>
        </div>
    </aside>

    <div class="flex-grow lg:pl-72 min-h-screen flex flex-col w-full">

        <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30 px-4 sm:px-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-4">
                <!-- Bouton menu mobile -->
                <button type="button" onclick="toggleSidebar()" class="lg:hidden w-10 h-10 rounded-xl bg-medical-50 border border-medical-200 flex items-center justify-center text-medical-600 hover:bg-medical-100 transition-colors" aria-label="Ouvrir le menu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <div class="flex items-center gap-2.5">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs text-slate-500 font-medium hidden sm:inline">Base de données en temps réel connectée via PDO</span>
                    <span class="text-xs text-slate-500 font-medium sm:hidden">PDO connecté</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-medical-50 border border-medical-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-medical-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <span class="text-xs text-medical-700 font-semibold font-mono"><?= date('d M Y') ?></span>
                </div>
                <div class="sm:hidden text-xs text-slate-500 font-bold font-mono">
                    <?= date('d/m/Y') ?>
                </div>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8 flex-grow max-w-[1400px] w-full mx-auto main-content">
            <?= $content ?? '<div class="flex flex-col items-center justify-center py-20 text-slate-400"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-4 text-slate-300"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" /></svg><p class="font-medium">Aucun contenu disponible.</p></div>' ?>
        </main>

        <footer class="px-4 sm:px-8 py-5 bg-white border-t border-slate-200/80">
            <div class="max-w-[1400px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-slate-400 font-medium">
                <p>&copy; 2026 <span class="text-medical-700 font-bold">PharmaFEFO</span> — Algorithme FEFO Strict homologué pour l'évaluation [2023] Web & Mobile.</p>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-600 border border-emerald-200 text-[10px] font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> FEFO
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-medical-50 text-medical-600 border border-medical-200 text-[10px] font-semibold">
                        v2026
                    </span>
                </div>
            </div>
        </footer>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

</body>

</html>