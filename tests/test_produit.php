<?php
$produit = new Produit('P001', 'Clavier', 150, 10);
verifier($produit->getReference() === 'P001', 'La référence est P001');
verifier($produit->getNom() === 'Clavier', 'Le nom est Clavier');
verifier($produit->getPrix() === 150.0, 'Le prix est 150');
verifier($produit->getQuantite() === 10, 'La quantité initiale est 10');

$exceptionPrix = false;
try { new Produit('P002', 'Souris', -5, 1); }
catch (InvalidArgumentException $e) { $exceptionPrix = true; }
verifier($exceptionPrix, 'Un prix négatif lève une exception');

$exceptionQte = false;
try { new Produit('P003', 'Écran', 100, -1); }
catch (InvalidArgumentException $e) { $exceptionQte = true; }
verifier($exceptionQte, 'Une quantité négative lève une exception');