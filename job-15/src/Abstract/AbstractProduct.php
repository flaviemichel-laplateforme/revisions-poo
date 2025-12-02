<?php

namespace App\Abstract;

use DateTime;
use PDO;
use Exception;
use App\Category;

date_default_timezone_set('Europe/Paris');

abstract class AbstractProduct
{
    protected     ?int         $id;
    protected     string      $name;
    protected     array       $photos;
    protected     int         $price;
    protected     string      $description;
    protected     int         $quantity;
    protected     DateTime    $createdAt;
    protected     DateTime    $updatedAt;
    protected     ?int        $category_id;

    public function __construct(?int $id = null, string $name = "", array $photos = [], int $price = 0, string $description = "", int $quantity = 0, ?Datetime $createdAt = null, ?Datetime $updatedAt = null, ?int $category_id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
        $this->category_id = $category_id;
    }

    public function getID(): ?int
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

    public function getPhotos()
    {
        return $this->photos;
    }

    public function setPhotos(array $photos): self
    {
        $this->photos = $photos;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        if ($price < 0) {
            throw new Exception('Erreur, montant inférieur à 0, veuillez modifier le montant');
        }

        $this->price = $price;
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

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
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

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): self
    {
        $this->category_id = $category_id;
        return $this;
    }

    public function getCategory(): ?Category
    {
        // 1. On vérifie si le produit a bien une catégorie
        if ($this->category_id === null) {
            return null;
        }

        // 2. Connexion à la BDD 
        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');

        // 3. Requête pour récupérer la catégorie
        $sql = "SELECT * FROM category WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $this->category_id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            // 4. On retourne une instance de Category hydratée
            return new Category(
                $data['id'],
                $data['name'],
                $data['description'],
                new DateTime($data['created_at']),
                new DateTime($data['updated_at'])
            );
        }

        return null;
    }

    /**
     * Récupère les infos en BDD et hydrate l'instance actuelle.
     * Retourne l'objet lui-même (this) si trouvé, sinon false.
     */
    abstract public function findOneById(int $id);

    /**
     * Retourne un tableau contenant tous les produits de la base de données.
     * @return Product[]
     */
    abstract public function findAll();


    public function create()
    {
        // 1. Connexion BDD
        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');

        // 2. Préparation de la requête INSERT
        $sql = "INSERT INTO product (name, photos, price, description, quantity, created_at, updated_at, category_id) 
                VALUES (:name, :photos, :price, :description, :quantity, :created_at, :updated_at, :category_id)";

        $stmt = $pdo->prepare($sql);

        // 3. Exécution avec les données de l'objet ($this)
        $result = $stmt->execute([
            'name' => $this->name,
            'photos' => json_encode($this->photos), // Array vers JSON
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'), // DateTime vers String
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
            'category_id' => $this->category_id
        ]);

        if ($result) {
            // 4. Si ça marche, on récupère l'ID généré par la BDD
            $this->id = (int)$pdo->lastInsertId();
            return $this;
        }

        return false;
    }

    public function update(): bool
    {

        $this->updatedAt = new Datetime();

        // 1. Connexion BDD
        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');

        // 2. Préparation de la requête INSERT
        $sql = "UPDATE product SET
                    name = :name,
                    photos = :photos,
                    price = :price,
                    description = :description,
                    quantity = :quantity,
                    updated_at = :updated_at,
                    category_id = :category_id
                    WHERE id = :id";


        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'id' => $this->id,
            'name' => $this->name,
            'photos' => json_encode($this->photos), // Array vers JSON
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
            'category_id' => $this->category_id
        ]);
    }
}
