<?php

require_once __DIR__ . '/Product.php';

class Electronic extends Product
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
}
