<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PharmaFEFO Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <nav class="bg-indigo-700 text-white shadow-md p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center font-bold">
            <a href="index.php?action=dashboard" class="text-xl tracking-wider">💊 PharmaFEFO</a>
            <div class="space-x-6 text-sm font-medium">
                <a href="index.php?action=dashboard" class="hover:text-indigo-200">📊 Dashboard</a>
                <a href="index.php?action=add-batch" class="hover:text-indigo-200">📥 Entrée Lot</a>
                <a href="index.php?action=dispense" class="hover:text-indigo-200">📦 Sortie FEFO</a>
                <a href="index.php?action=report" class="hover:text-indigo-200">💰 Rapport Financier</a>
            </div>
        </div>
    </nav>
    <main class="container mx-auto p-4">