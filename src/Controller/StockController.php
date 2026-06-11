<?php

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

               
                if ($expiryDate < $today) {
                    $error = "La date de péremption est antérieure à la date du jour ! Saisie rejetée.";
                } else {
                   
                    $result = $this->repo->saveInputBatch($productId, $lotNumber, $quantity, $expiryDateStr);
                    if ($result) {
                        $success = "Succès : Le lot a été classé précisément dans la file d'attente FEFO !";
                    } else {
                        $error = "Une erreur est survenue lors de l'enregistrement.";
                    }
                }
            }
        }

       
        $products = $this->repo->getAllProducts();

     
        ob_start();
        include __DIR__ . '/../../templates/dashboard/add_batch.php'; // Ghadi n9ado had l-vue l-ta7t
        $content = ob_get_clean();

        include __DIR__ . '/../../templates/layout/base.php';
    }
    
    public function dispense() {
        $error = null;
        $success = null;
        $suggestedBatch = null;
        $selectedProductId = isset($_GET['prod_id']) ? (int)$_GET['prod_id'] : null;

        if ($selectedProductId) {
            $suggestedBatch = $this->repo->getFefoBatchForProduct($selectedProductId);
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $batchId = (int)$_POST['lot_id'];
            $qtyToDispense = (int)$_POST['qty'];
           
            if ($qtyToDispense <= 0) {
                $error = "Erreur : La quantité doit être supérieure à 0.";
            } else {
                $result = $this->repo->dispenseBatch($batchId, $qtyToDispense);
                if ($result) {
                    $success = "Succès US 3.1 : Déstockage effectué selon la règle FEFO (Lot décrémenté en priorité) !";
                    $suggestedBatch = null; 
                } else {
                    $error = "Une erreur est survenue lors du déstockage.";
                }
            }
        }

        $products = $this->repo->getAllProducts();

       
        ob_start();
        include __DIR__ . '/../../templates/dashboard/sortie.php';
        $content = ob_get_clean();

        include __DIR__ . '/../../templates/layout/base.php';
    }

    public function expireBatch() {
        $batchId = isset($_GET['id']) ? (int)$_GET['id'] : null;
        
        if ($batchId) {
            $this->repo->markBatchAsExpired($batchId);
        }
        
      
        header("Location: index.php?action=dashboard");
        exit;
    }

    
    public function financialReport() {
     
        $totalLoss = $this->repo->getFinancialLossTotal();

     
        ob_start();
        include __DIR__ . '/../../templates/dashboard/report.php';
        $content = ob_get_clean();

        include __DIR__ . '/../../templates/layout/base.php';
    }
}