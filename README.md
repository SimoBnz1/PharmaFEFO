# 🩺 MedFlow — Système de Gestion de Pharmacie Clinique & Traçabilité FEFO

MedFlow est une plateforme SaaS haute performance dédiée à la gestion des stocks de médicaments, à la traçabilité réglementaire des lots, et à l'optimisation financière des pertes au sein des structures cliniques. 

Conçu avec une interface ultra-moderne (Bento Grid aesthetics), l'application implémente de manière stricte la règle **FEFO (First Expired, First Out)** pour sécuriser le circuit du médicament.

---

## 🚀 Fonctionnalités Clés

* **Surveillance Globale des Lots :** Tableau de bord haute densité avec indicateurs diagnostics dynamiques (Critique `< 30j`, Vigilance `< 90j`, Conforme `> 6m`).
* **Sécurisation Strict du Stock (Règle Métier) :** Les actions de retrait sont structurellement bloquées pour les lots conformes. Le bouton de destruction n'apparaît **que** si le statut du lot passe à `EXPIRED`.
* **Moteur de Calcul des Pertes Financières :** Lors du retrait d'un lot périmé, le système calcule automatiquement l'impact financier négatif direct selon la formule :
    $$\text{Valeur de la Perte} = \text{Quantité Physique} \times \text{Prix d'Achat}$$
* **Rapports de Gâchis en Temps Réel :** Enregistrement transactionnel (ACID) dans la table des pertes pour un suivi analytique destiné à la direction.
* **Contrôle d'Accès par Rôles (RBAC) :** Interface adaptative selon les privilèges (`admin`, `pharmacien`, `collaborateur`).

---

## 📊 Architecture & Modélisation

### 1. Diagramme de Cas d'Utilisation (Use Case)
> Permet de visualiser les limites du système et les actions restrictives du Pharmacien/Admin sur les lots périmés.

```text
[ Insère ton diagramme Use Case ici : (ex: docs/diagrammes/use_case.png) ]
