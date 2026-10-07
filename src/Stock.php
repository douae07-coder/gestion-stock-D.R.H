<?php

class Stock
{
    /** @var Produit[] */
    private array $produits = [];

    public function ajouter(Produit $p): void
    {
        if (isset($this->produits[$p->getReference()])) {
            throw new InvalidArgumentException("La reference " . $p->getReference() . " existe deja");
        }
        $this->produits[$p->getReference()] = $p;
    }

    public function trouver(string $reference): ?Produit
    {
        return $this->produits[$reference] ?? null;
    }
}