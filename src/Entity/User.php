<?php
// src/Entity/User.php

class User {
    private ?int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $role;

    public function __construct(?int $id, string $nom, string $prenom, string $email, string $role) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->role = $role;
    }

    public function getId(): ?int { return $this->id; }
    public function getNomComplet(): string { return $this->prenom . ' ' . $this->nom; }
    public function getEmail(): string { return $this->email; }
    public function getRole(): string { return $this->role; }
}