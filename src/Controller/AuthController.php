<?php
// src/Controller/AuthController.php
require_once __DIR__ . '/../Repository/UserRepository.php'; 

class AuthController {
    private UserRepository $userRepo; 

    public function __construct() {
        $this->userRepo = new UserRepository(); 
    }

    public function login() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $user = $this->userRepo->findUserByEmail($email); 

            if ($user && $password===$user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['nom'] . ' ' . $user['prenom'];
                $_SESSION['user_role'] = $user['role'];

                header("Location: index.php?action=dashboard");
                exit;
            } else {
                $error = "Email ou mot de passe incorrect !";
            }
        }

        include __DIR__ . '/../../templates/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}