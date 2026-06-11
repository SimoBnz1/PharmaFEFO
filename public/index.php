<?php
// public/index.php
session_start(); // 1. Khassna dima ndiro session_start f l-lowel d l-routeur

// 2. Chargement d ga3 les Contrôleurs
require_once __DIR__ . '/../src/Controller/StockController.php';
require_once __DIR__ . '/../src/Controller/DashboardController.php';
require_once __DIR__ . '/../src/Controller/AuthController.php';

// 3. Get action
$action = $_GET['action'] ?? 'dashboard';

// 4. Instanciation
$stockController = new StockController();
$dashboardController = new DashboardController();
$authController = new AuthController();

// 5. PROTECTION DES DROITS : Ila user machi connecter o bgha chi action mn ghir login
if (!isset($_SESSION['user_id']) && $action !== 'login') {
    header("Location: index.php?action=login");
    exit;
}

// 6. Routing centralisé
switch ($action) {
    case 'login':
        $authController->login();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'dashboard':
        $dashboardController->index();
        break;

    case 'add-batch':
        $stockController->addBatch();
        break;

    case 'dispense':
        $stockController->dispense();
        break;

    case 'expire':
        // Sécurité role: ghir pharmacien wla admin li i9der i-supprimer l-périmé (US 4.1)
        if ($_SESSION['user_role'] === 'pharmacien' || $_SESSION['user_role'] === 'admin') {
            $stockController->expireBatch();
        } else {
            die("Erreur de sécurité : Droits insuffisants (Pharmacien requis).");
        }
        break;

    case 'report':
        // Sécurité role: ghir l-admin li 3ndu l-haq f l-rapport financier (US 4.2)
        if ($_SESSION['user_role'] === 'admin') {
            $stockController->financialReport();
        } else {
            die("Erreur de sécurité : Réservé à l'Administrateur.");
        }
        break;
    case 'users':
        if ($_SESSION['user_role'] === 'admin') {
            $dashboardController->manageUsers();
        } else {
            die("Erreur de sécurité : Réservé à l'Administrateur.");
        }
        break;

    default:
        $dashboardController->index();
        break;
}