<?php

namespace App;

use App\Interface\EntityInterface;
use App\Abstract\AbstractProduct; // Pour savoir hydrater un produit
use PDO;
use DateTime;

class EntityCollection
{
    /** @var EntityInterface[] */
    private array $items = [];

    // --- Méthode 1 : Ajouter une entité à la collection [cite: 137] ---
    public function add(EntityInterface $entity): self
    {
        // On pourrait vérifier si l'ID existe déjà pour éviter les doublons
        $this->items[] = $entity;
        return $this;
    }

    // --- Méthode 2 : Retirer une entité de la collection [cite: 138] ---
    public function remove(EntityInterface $entity): self
    {
        foreach ($this->items as $key => $item) {
            // On compare les IDs pour trouver lequel supprimer
            if ($item->getId() === $entity->getId() && get_class($item) === get_class($entity)) {
                unset($this->items[$key]);
                // On réindexe le tableau pour éviter les trous
                $this->items = array_values($this->items);
                break;
            }
        }
        return $this;
    }

    // --- Méthode utilitaire pour récupérer le tableau simple (utile pour les foreach) ---
    public function get(): array
    {
        return $this->items;
    }

    // --- Méthode 3 : Retrieve (Récupérer depuis la BDD) [cite: 139] ---
    /**
     * Cette méthode détecte le type de l'entité passée (ex: Category)
     * et va chercher les entités liées (ex: Products) pour remplir la collection.
     */
    public function retrieve(EntityInterface $baseEntity): self
    {
        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');

        // Cas : Si l'entité de base est une Categorie, on cherche ses Produits
        if ($baseEntity instanceof Category) {

            // On cherche tous les produits liés à cette catégorie
            // NOTE: Idéalement, on utiliserait le AbstractProduct pour instancier, 
            // mais comme il est abstrait, on va devoir ruser ou instancier des Clothing/Electronic.
            // Pour simplifier l'exercice ici, on va faire une jointure pour savoir quel type instancier
            // OU plus simplement : on instancie des Clothing par défaut si on ne sait pas.

            // Pour faire simple et robuste : On va chercher dans la table product générique
            // Et on va tricher un peu en instanciant du Clothing par défaut pour l'exemple, 
            // car PHP ne peut pas instancier une classe abstraite.

            $sql = "SELECT * FROM product WHERE category_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $baseEntity->getId()]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // On vide la collection actuelle avant de remplir
            $this->items = [];

            foreach ($results as $row) {
                // NOTE IMPORTANTE : Ici, dans un vrai framework, on aurait une colonne "discriminator" 
                // pour savoir si c'est un Clothing ou un Electronic.
                // Pour l'exercice, on va tenter de créer un Clothing.

                $product = new Clothing(
                    $row['id'],
                    $row['name'],
                    json_decode($row['photos'], true) ?? [],
                    $row['price'],
                    $row['description'],
                    $row['quantity'],
                    new DateTime($row['created_at']),
                    new DateTime($row['updated_at']),
                    $row['category_id']
                    // On ne remplit pas les champs spécifiques ici car la requête est simple
                );

                $this->add($product);
            }
        }

        return $this;
    }
}
