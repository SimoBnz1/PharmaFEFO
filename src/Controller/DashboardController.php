<?php
// src/Controller/DashboardController.php
require_once __DIR__ . '/../Repository/StockBatchRepository.php';
require_once __DIR__ . '/../Repository/UserRepository.php'; 
class DashboardController {
    private StockBatchRepository $repo;
    private UserRepository $userRepo; 

    public function __construct() {
        $this->repo = new StockBatchRepository();
        $this->userRepo = new UserRepository(); 
    }

    public function index() {
        $filter = $_GET['filter'] ?? null;
        $rawLots = $this->repo->getDashboardLots($filter);
        $notifications = $this->repo->getNextMonthAlerts();
        $processedLots = [];
        $today = new DateTime();

        foreach ($rawLots as $l) {
            $dlu = new DateTime($l['date_peremption']);
            $diff = $today->diff($dlu);
            $jours = $diff->days * ($diff->invert ? -1 : 1);

            if ($jours < 30) {
                $l['color_classes'] = 'bg-red-50 text-red-900 border-red-200';
                $l['badge_text'] = ' Rouge (< 30 jours)';
            } elseif ($jours < 90) {
                $l['color_classes'] = 'bg-orange-50 text-orange-900 border-orange-200';
                $l['badge_text'] = ' Orange (< 90 jours)';
            } else {
                $l['color_classes'] = 'bg-green-50 text-green-900 border-green-200';
                $l['badge_text'] = ' Vert (> 6 mois)';
            }
            $processedLots[] = $l;
        }

        ob_start();
        include __DIR__ . '/../../templates/dashboard/index.php';
        $content = ob_get_clean();
        include __DIR__ . '/../../templates/layout/base.php';
    }

    // Action dyal Gestion des utilisateurs 
    public function manageUsers() {
        if ($_SESSION['user_role'] !== 'admin') {
            die("Erreur de sécurité : Accès réservé à l'Administrateur.");
        }

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom']);
            $prenom = trim($_POST['prenom']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
                $error = "Tous les champs sont obligatoires.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                
               
                $result = $this->userRepo->createUser($nom, $prenom, $email, $hashedPassword, $role);
                if ($result) {
                    $success = "L'utilisateur a été créé avec succès !";
                } else {
                    $error = "Une erreur est survenue (l'email est peut-être déjà utilisé).";
                }
            }
        }

        
        $usersList = $this->userRepo->getAllUsers();

        ob_start();
        include __DIR__ . '/../../templates/dashboard/manage_users.php';
        $content = ob_get_clean();
        include __DIR__ . '/../../templates/layout/base.php';
    }
}