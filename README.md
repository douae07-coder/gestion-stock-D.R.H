# Nom du groupe : Gestion de stock

Application PHP en ligne de commande qui gère le stock d'un magasin
(produits, quantités, valeur du stock, commandes).

## Contrat d'interface

- **Produit** (A) : reference, nom, prix, quantite, ajouterQuantite(), retirerQuantite(), valeurStock()
- **Stock** (B) : ajouter(), trouver(), tous(), compter(), valeurTotale(), produitsEnRupture(), produitsSousSeuil()
- **Commande** (C) : ajouterLigne(), total(), valider(), estValidee(), afficher()

## Équipe
## Étudiant C - Classe Commande & Menu
- Implémentation de la classe Commande (gestion des lignes, total, validation)
- Création des tests unitaires pour Commande
- Développement du menu interactif dans index.php
