<?php

require_once __DIR__ . '/AbstractProduct.php';

class Electronic extends AbstractProduct
{
    private string $brand;
    private int $waranty_fee;

    public function __construct(?int $id = null, string $name = "", array $photos = [], int $price = 0, string $description = "", int $quantity = 0, ?Datetime $createdAt = null, ?Datetime $updatedAt = null, ?int $category_id = null, string $brand = "", int $waranty_fee = 0)
    {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt, $category_id);

        $this->brand = $brand;
        $this->waranty_fee = $waranty_fee;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    public function getWaranty_fee(): int
    {
        return $this->waranty_fee;
    }

    public function setWaranty_fee(int $waranty_fee): self
    {
        $this->waranty_fee = $waranty_fee;
        return $this;
    }

    public function create()
    {
        if (!parent::create()) {
            return false;
        }

        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');

        $sql = "INSERT INTO electronic (product_id, brand, waranty_fee)
                VALUES (:product_id, :brand, :waranty_fee)";

        $stmt = $pdo->prepare($sql);

        $result = $stmt->execute([
            'product_id' => $this->getId(),
            'brand' => $this->brand,
            'waranty_fee' => $this->waranty_fee
        ]);

        return $result ? $this : false;
    }

    public function update(): bool
    {
        if (!parent::update()) {
            return false;
        }

        $pdo = new PDO("mysql:host=localhost;dbname=draft-shop;charset=utf8", 'root', '');

        $sql = "UPDATE electronic SET brand = :brand, waranty_fee = :waranty_fee
                WHERE product_id = :id";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            'id' => $this->getId(),
            'brand' => $this->brand,
            'waranty-fee' => $this->waranty_fee
        ]);
    }

    public function findOneById(int $id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=draft-shop;charset=utf8", 'root', '');

        $sql = "SELECT * FROM product
                INNER JOIN electronic ON product.id = electronic.product_id
                WHERE product.id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return false;
        }

        //HYDRATATION
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setPhotos(json_decode($data['photos'], true));
        $this->setPrice($data['price']);
        $this->setDescription($data['description']);
        $this->setQuantity($data['quantity']);
        $this->setCreatedAt(new DateTime($data['created_at']));
        $this->setUpdatedAt(new DateTime($data['updated_at']));
        $this->setCategoryId($data['category_id']);

        $this->brand = $data['brand'];
        $this->waranty_fee = $data['waranty_fee'];

        return $this;
    }

    public function findAll(): array
    {
        $pdo = new PDO('mysql:host=localhost;dbname=draft-shop;charset=utf8', 'root', '');

        $sql = "SELECT * FROM product INNER JOIN electronic ON product.id = electronic.product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $electronics = [];

        foreach ($results as $data) {
            $electronics[] = new Electronic(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true),
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['created_at']),
                new DateTime($data['updated_at']),
                $data['category_id'],
                $data['brand'],
                $data['waranty_fee']
            );
        }

        return $electronics;
    }
}
