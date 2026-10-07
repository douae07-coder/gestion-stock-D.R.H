<?php
$prodC = new Produit('C001', 'Cable', 10, 5);
$cmdC = new Commande(1);
$cmdC->ajouterLigne($prodC, 2);
verifier(abs($cmdC->total() - 20) < 0.001, 'Commande : total = 2 x 10');
$cmdC->valider();
verifier($prodC->getQuantite() === 3, 'Commande : stock reduit apres validation');
verifier($cmdC->estValidee(), 'Commande : estValidee() vrai');