<?php
require __DIR__ . '/autoload.php';

$stock = new Stock();
$numeroCommande = 1;

function lire(string $q): string {
    echo $q;
    return trim(fgets(STDIN));
}

while (true) {
    echo "\n1 Ajouter un produit\n2 Lister le stock\n3 Reapprovisionner\n";
    echo "4 Nouvelle commande\n5 Ruptures / sous seuil\n0 Quitter\n";
    $choix = lire("Choix : ");

    try {
        switch ($choix) {
            case '1':
                $stock->ajouter(new Produit(
                    lire("Reference : "), lire("Nom : "),
                    (float) lire("Prix : "), (int) lire("Quantite : ")));
                echo "Produit ajoute.\n";
                break;
            case '2':
                foreach ($stock->tous() as $p) {
                    echo "{$p->getReference()} | {$p->getNom()} | {$p->getPrix()} | {$p->getQuantite()}\n";
                }
                echo "Valeur totale : " . $stock->valeurTotale() . "\n";
                break;
            case '3':
                $p = $stock->trouver(lire("Reference : "));
                if ($p === null) { echo "Introuvable.\n"; break; }
                $p->ajouterQuantite((int) lire("Quantite a ajouter : "));
                echo "Stock mis a jour.\n";
                break;
            case '4':
                $cmd = new Commande($numeroCommande++);
                while (($ref = lire("Reference (vide pour finir) : ")) !== '') {
                    $p = $stock->trouver($ref);
                    if ($p === null) { echo "Introuvable.\n"; continue; }
                    try {
                        $cmd->ajouterLigne($p, (int) lire("Quantite : "));
                    } catch (InvalidArgumentException $e) {
                        echo "Erreur : " . $e->getMessage() . "\n";
                    }
                }
                $cmd->valider();
                echo $cmd->afficher();
                break;
            case '5':
                echo "Ruptures :\n";
                foreach ($stock->produitsEnRupture() as $p) { echo " - {$p->getNom()}\n"; }
                $seuil = (int) lire("Seuil : ");
                echo "Sous le seuil :\n";
                foreach ($stock->produitsSousSeuil($seuil) as $p) { echo " - {$p->getNom()} ({$p->getQuantite()})\n"; }
                break;
            case '0':
                exit(0);
            default:
                echo "Choix invalide.\n";
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage() . "\n";
    }
}