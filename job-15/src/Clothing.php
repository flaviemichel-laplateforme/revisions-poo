<?php

namespace App;

use DateTime;
use PDO;
use App\Abstract\AbstractProduct;
use App\Interface\StockableInterface;

class Clothing extends AbstractProduct implements StockableInterface
{
    private string  $size;
    private string  $color;
    private string  $type;
    private int     $material_fee;

    public function __construct(
        ?int $id = null,
        string $name = "",
        array $photos = [],
        int $price = 0,
        string $description = "",
        int $quantity = 0,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null,
        ?int $category_id = null,
        // 2. Paramètres de l'Enfant (Clothing)
        string $size = "",
        string $color = "",
        string $type = "",
        int $material_fee = 0
    ) {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt, $category_id);

        $this->size = $size;
        $this->color = $color;
        $this->type = $type;
        $this->material_fee = $material_fee;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;
        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getMaterial_fee(): int
    {
        return $this->material_fee;
    }

    public function setMaterial_fee(int $material_fee): self
    {
        $this->material_fee = $material_fee;
        return $this;
    }

    public function create()
    {
        if (!parent::create()) {
            return false;
        }

        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');

        $sql = "INSERT INTO clothing (product_id, size, color, type, material_fee)
                VALUES (:product_id, :size, :color, :type, :material_fee)";

        $stmt = $pdo->prepare($sql);

        $result = $stmt->execute([
            'product_id' => $this->getId(),
            'size' => $this->size,
            'color' => $this->color,
            'type' => $this->type,
            'material_fee' => $this->material_fee
        ]);
        return $result ? $this : false;
    }

    public function findOneById(int $id)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');
        $sql = "SELECT * FROM product
                INNER JOIN clothing ON product.id = clothing.product_id
                WHERE product.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return false;
        }

        // Hydratation manuelle (Parent + Enfant)
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setPhotos(json_decode($data['photos'], true));
        $this->setPrice($data['price']);
        $this->setDescription($data['description']);
        $this->setQuantity($data['quantity']);
        $this->setCreatedAt(new DateTime($data['created_at']));
        $this->setUpdatedAt(new DateTime($data['updated_at']));
        $this->setCategoryId($data['category_id']);

        // Infos spécifiques Clothing
        $this->size = $data['size'];
        $this->color = $data['color'];
        $this->type = $data['type'];
        $this->material_fee = $data['material_fee'];

        return $this;
    }

    public function findAll(): array
    {
        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');

        $sql = "SELECT * FROM product INNER JOIN clothing ON product.id = clothing.product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clothes = [];

        foreach ($results as $data) {
            $c = new Clothing(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true),
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['created_at']),
                new DateTime($data['updated_at']),
                $data['category_id'],
                $data['size'],
                $data['color'],
                $data['type'],
                $data['material_fee']
            );
            $clothes[] = $c;
        }

        return $clothes;
    }

    public function update(): bool
    {
        // 1. On met à jour la partie parente
        if (!parent::update()) {
            return false;
        }

        // 2. On met à jour la partie spécifique
        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');

        $sql = "UPDATE clothing SET 
                size = :size, color = :color, type = :type, material_fee = :material_fee 
                WHERE product_id = :id";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            'id' => $this->getId(),
            'size' => $this->size,
            'color' => $this->color,
            'type' => $this->type,
            'material_fee' => $this->material_fee
        ]);
    }

    public function addStocks(int $stock): self
    {
        $this->quantity += $stock;
        return $this;
    }

    public function removeStocks(int $stock): self
    {
        $this->quantity -= $stock;
        return $this;
    }
}
