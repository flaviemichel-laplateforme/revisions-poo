<?php

require_once __DIR__ . '/Product.php';

class Clothing extends Product
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
}
