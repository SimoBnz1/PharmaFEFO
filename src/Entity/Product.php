<?php
// src/Entity/Product.php

class Product {
    private ?int $id;
    private string $nom;
    private string $reference;
    private float $prix;

    public function __construct(string $nom, string $reference, float $prix, ?int $id = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->reference = $reference;
        $this->prix = $prix;
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getReference(): string { return $this->reference; }
    public function getPrix(): float { return $this->prix; }
}