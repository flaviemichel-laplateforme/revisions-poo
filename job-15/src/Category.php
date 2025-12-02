<?php

namespace App;

use DateTime;
use PDO;
use App\Abstract\AbstractProduct;
use App\Interface\StockableInterface;
use App\Interface\EntityInterface;
use App\EntityCollection;

class Category implements EntityInterface
{
    private ?int $id;
    private string $name;
    private string  $description;
    private DateTime    $createdAt;
    private DateTime    $updatedAt;

    private EntityCollection $products;

    public function __construct(?int $id = null, string $name = "", string $description = "", ?DateTime $createdAt = null, ?DateTime $updatedAt = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();

        $this->products = new EntityCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(Datetime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    //     ajouter la méthode getProducts() dans votre classe Category. Cette méthode va :

    //     Se connecter à la base de données.

    //     Sélectionner tous les produits où category_id correspond à l'ID de la catégorie actuelle.

    //     Transformer chaque ligne de résultat en un objet Product.

    //     Retourner un tableau d'objets Product.

    // Ajoutez ceci à la fin de votre classe Category (n'oubliez pas d'importer Product si vous utilisez des namespaces, mais ici nous sommes en simple require) :
    public function getProducts(): EntityCollection
    {
        // On demande à la collection de se remplir (retrieve) en se basant sur $this (la catégorie actuelle)
        // La méthode retrieve va faire la requête SQL et remplir $this->products
        return $this->products->retrieve($this);
    }

    // On peut ajouter une méthode pour récupérer le tableau brut si besoin
    public function getProductsArray(): array
    {
        return $this->products->retrieve($this)->get();
    }
}
