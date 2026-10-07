<?php
$s = new Stock();
$s->ajouter(new Produit('P1', 'Clavier', 100, 2));
$s->ajouter(new Produit('P2', 'Souris', 50, 0));

verifier($s->compter() === 2, 'Le stock contient 2 produits');
verifier($s->trouver('P1')->getNom() === 'Clavier', 'trouver retourne le bon produit');
verifier($s->trouver('XXX') === null, 'trouver retourne null si absent');

try {
    $s->ajouter(new Produit('P1', 'Doublon', 10, 1));
    verifier(false, 'Une référence en double doit lever une exception');
} catch (InvalidArgumentException $e) {
    verifier(true, 'Une référence en double lève une exception');
}

verifier(abs($s->valeurTotale() - 200) < 0.001, 'valeurTotale vaut 2x100 + 0x50');

verifier(count($s->produitsEnRupture()) === 1, 'Un produit est en rupture');
verifier(count($s->produitsSousSeuil(3)) === 2, 'Deux produits sont sous le seuil 3');
verifier(count($s->produitsSousSeuil(2)) === 1, 'Le seuil est strict (< 2)');