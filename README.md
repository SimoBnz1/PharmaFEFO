# PharmaFEFO - Application de Gestion Intelligente des Stocks Pharmaceutiques

Projet éducatif PHP OOP permettant la gestion des stocks de médicaments selon la méthode **FEFO (First Expired, First Out)** afin de réduire les pertes financières liées aux produits périmés et garantir la sécurité sanitaire.

## Stack Technique

* **PHP 8** (Programmation Orientée Objet)
* **MySQL** (Base de données)
* **PDO** (Connexion sécurisée)
* **Tailwind CSS** (Interface utilisateur via CDN)
* **PHP Sessions** (Authentification)
* **Architecture MVC**

## Structure du Projet

```text
pharmafefo/
├── config/
│   ├── database.php
├── docs/
│   ├── shema.sql            # structure de data base
├── public/
│   ├── css/                  # Feuilles de style
│   ├── js/                   # Scripts JavaScript
│   └── index.php             # Contrôleur frontal / Routing
├── src/
│   ├── Controller/
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── StockController.php
│ 
│   ├── Entity/
│   │   ├── User.php
│   │   ├── Produit.php
│   │   ├── StockBatch.php
│   │   ├── ReturnProduct.php
│   │   └── StockMovement.php
│   │   └── Alert.php
│   ├── Enum/
│   │   └── MouvementType.php
│   ├── Middleware/
│   │   └── AuthMiddleware.php
│   └── Repository/
│       ├── UserRepository.php
│       ├── ProductRepository.php
│       ├── MouvementRepository.php
│       ├── StockBatchRepository.php
├── templates/
│   ├── dashboard/
│   │   └── add_batch.php
│   │   └── index.php
│   │   └── manage_users.php
│   │   └── notifications.php
│   │   └── report.php
│   │   └── sortie.php

│   ├── alerts/
│   │   ├── index.php
│   ├── auth/
│   │   └── login.php
│   └── layout/
│       ├── base.php
│       └── layout_header.php
└── README.md
```

## Diagramme de Classe

![classe pharmaFEFO.png](<clasee phamaFEFO.png>)
## Diagramme de Cas d’Utilisation

![use case phamaFEFO.png](<use case phamaFEFO.png>)

## Diagramme ERD

![alt text](image.png)
---

## Contexte du Projet

Les pharmacies et dépôts médicaux gèrent quotidiennement des milliers de références de médicaments.

Le principal problème réside dans la gestion des dates de péremption. Une mauvaise visibilité des lots entraîne :

* Des pertes financières importantes dues aux produits périmés.
* Des risques sanitaires liés à l'utilisation de médicaments expirés.
* Des ruptures de stock causées par une mauvaise anticipation.

L'application **PharmaFEFO** apporte une solution grâce à la méthode **FEFO (First Expired, First Out)**.

Le système :

* Priorise automatiquement les lots proches de la péremption.
* Génère des alertes visuelles selon le niveau de criticité.
* Facilite le retour fournisseur avant expiration.
* Réduit les pertes et améliore la sécurité des patients.

---

## Installation

### 1. Prérequis

* PHP 8.0 ou supérieur
* MySQL 5.7 ou supérieur
* Apache / Nginx ou serveur PHP intégré

### 2. Base de Données

```bash
mysql -u root -p < database.sql
```



### 4. Lancer le Serveur

```bash
cd public
php -S localhost:8000
```

Accéder à l'application :

```text
http://localhost:8000
```

---

## Comptes de Démonstration

| Rôle           | Email                                                         | Mot de passe |
| -------------- | ------------------------------------------------------------- | ------------ |
| Administrateur | [admin@pharmafefo.com](mailto:admin@pharma.com)           | admin123     |
| Pharmacien     | [pharmacien@pharmafefo.com](mailto:pharmacien@pharma.com) | pharma123    |
| Gestionnaire   | [stock@pharmafefo.com](mailto:stock@pharma.com)           | stock123     |

---

## Rôles et Permissions

### Gestionnaire de Stock

* Réceptionner les commandes.
* Enregistrer les entrées de stock.
* Scanner les lots.
* Effectuer les sorties de stock.

### Pharmacien

* Consulter les alertes de péremption.
* Valider les inventaires.
* Gérer les retours fournisseurs.
* Déclarer les produits périmés.

### Administrateur

* Gérer les utilisateurs.
* Configurer les seuils d'alerte.
* Consulter les rapports financiers.
* Administrer la plateforme.

---

## Fonctionnalités

### Gestion des Entrées

* Ajout de nouveaux médicaments.
* Enregistrement du numéro de lot.
* Enregistrement de la date de péremption.
* Validation automatique des dates.

### Alertes de Péremption

* Vert : Plus de 6 mois.
* Orange : Moins de 90 jours.
* Rouge : Moins de 30 jours.

### Gestion FEFO

* Sélection automatique du lot à sortir.
* Priorité au lot ayant la date de péremption la plus proche.
* Réduction automatique du stock.

### Gestion des Produits Périmés

* Déclaration des lots expirés.
* Retrait du stock disponible.
* Historique des destructions.

### Rapports

* Rapport mensuel des pertes.
* Valeur financière des produits périmés.
* Statistiques des retours fournisseurs.

---

## Architecture

### Entités Principales

#### Utilisateur

* id
* nom
* email
* motDePasse
* role

#### Produit

* id
* nom
* codeProduit
* description

#### Lot

* id
* numeroLot
* quantite
* datePeremption
* statut

#### MouvementStock

* id
* type (ENTREE / SORTIE)
* quantite
* dateMouvement

---

## Relations

* Un Produit possède plusieurs Lots.
* Un Lot appartient à un seul Produit.
* Un Produit possède plusieurs Mouvements de Stock.
* Un Utilisateur effectue plusieurs opérations.
* Un Lot peut être marqué comme Expiré.

---

## Règles SQL

* Toutes les requêtes SQL sont dans les Repository.
* Aucun SQL dans les Controllers.
* Aucun SQL dans les Views.
* Les Entités représentent uniquement les objets métier.

---

## Sécurité

* Authentification par session PHP.
* Hashage des mots de passe avec bcrypt.
* Requêtes préparées PDO.
* Protection contre les injections SQL.
* Protection XSS avec `htmlspecialchars()`.
* Contrôle d'accès basé sur les rôles.

---

## Principes SOLID Respectés

### SRP (Single Responsibility Principle)

Chaque classe possède une seule responsabilité.

### OCP (Open Closed Principle)

Le système est extensible sans modification du code existant.

### LSP (Liskov Substitution Principle)

Les classes enfants peuvent remplacer leurs classes parentes.

### ISP (Interface Segregation Principle)

Interfaces spécialisées selon les besoins.

### DIP (Dependency Inversion Principle)

Dépendance vers des abstractions plutôt que des implémentations.

---

## Auteur

Projet réalisé dans le cadre de la formation Développeur Web & Web Mobile - Simplon.
