<?php
// src/Controller/StockController.php
require_once __DIR__ . '/../Repository/StockBatchRepository.php';

class StockController {
    private StockBatchRepository $repo;

    public function __construct() {
        $this->repo = new StockBatchRepository();
    }

    public function addBatch() {
        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = (int)$_POST['produit_id'];
            $lotNumber = trim($_POST['numero_lot']);
            $quantity = (int)$_POST['quantite'];
            $expiryDateStr = $_POST['date_peremption'];

          
            if (empty($expiryDateStr)) {
                $error = "Erreur : La date de péremption ne peut pas être vide !";
            } else {
                $expiryDate = new DateTime($expiryDateStr);
                $today = new DateTime((new DateTime())->format('Y-m-d')); 

                // Critère d'acceptation 2 : Refuser si antérieure à la date du jour
                if ($expiryDate < $today) {
                    $error = "La date de péremption est antérieure à la date du jour ! Saisie rejetée.";
                } else {
                    // Ila kolchi s7i7, n-sivtouh l database
                    $result = $this->repo->saveInputBatch($productId, $lotNumber, $quantity, $expiryDateStr);
                    if ($result) {
                        $success = "Succès : Le lot a été classé précisément dans la file d'attente FEFO !";
                    } else {
                        $error = "Une erreur est survenue lors de l'enregistrement.";
                    }
                }
            }
        }

        // Kangibo l-médicaments bch i-banou f l-formulaire drop-down list
        $products = $this->repo->getAllProducts();

        // Kachwfo l-Vue HTML dyalna wast l-Layout central dyal base.php
        // Khdma basique bla t9g9id
        ob_start();
        include __DIR__ . '/../../templates/dashboard/add_batch.php'; // Ghadi n9ado had l-vue l-ta7t
        $content = ob_get_clean();

        include __DIR__ . '/../../templates/layout/base.php';
    }
    // Action dyal l-User Story 3.1 (Sortie FEFO)
    public function dispense() {
        $error = null;
        $success = null;
        $suggestedBatch = null;
        $selectedProductId = isset($_GET['prod_id']) ? (int)$_GET['prod_id'] : null;

        // 1. Ila l-user khtar l-médicament bch i-analysih ssystem
        if ($selectedProductId) {
            $suggestedBatch = $this->repo->getFefoBatchForProduct($selectedProductId);
        }

        // 2. Ila l-user rke3 3la bouton "Confirmer la sortie / Vendre" (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $batchId = (int)$_POST['lot_id'];
            $qtyToDispense = (int)$_POST['qty'];
            
            // Validation basique dyal l-quantité safe
            if ($qtyToDispense <= 0) {
                $error = "Erreur : La quantité doit être supérieure à 0.";
            } else {
                $result = $this->repo->dispenseBatch($batchId, $qtyToDispense);
                if ($result) {
                    $success = "Succès US 3.1 : Déstockage effectué selon la règle FEFO (Lot décrémenté en priorité) !";
                    $suggestedBatch = null; // Re-initialiser bch t-7iyd l-formulaire
                } else {
                    $error = "Une erreur est survenue lors du déstockage.";
                }
            }
        }

        // Kangibo ga3 l-médicaments bch n-affichiwhom f l-formulaire l-fou9
        $products = $this->repo->getAllProducts();

        // Affichage wast l-layout base.php
        ob_start();
        include __DIR__ . '/../../templates/dashboard/sortie.php';
        $content = ob_get_clean();

        include __DIR__ . '/../../templates/layout/base.php';
    }
    // Action dyal l-User Story 4.1 (Forcer Expire)
    public function expireBatch() {
        $batchId = isset($_GET['id']) ? (int)$_GET['id'] : null;
        
        if ($batchId) {
            $this->repo->markBatchAsExpired($batchId);
        }
        
        // Mnin kaysali, ssystem kay-rediriger l-user automatic l l-Dashboard
        header("Location: index.php?action=dashboard");
        exit;
    }

    // Action dyal l-User Story 4.2 (Rapport Financier)
    public function financialReport() {
        // Ngibo l-calcul d l-perte mn l-Repository
        $totalLoss = $this->repo->getFinancialLossTotal();

        // Affichage wast l-layout base.php
        ob_start();
        include __DIR__ . '/../../templates/dashboard/report.php';
        $content = ob_get_clean();

        include __DIR__ . '/../../templates/layout/base.php';
    }
}