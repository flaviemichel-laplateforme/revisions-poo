<?php

// Job 01
// Nous allons prendre un exemple réaliste afin de coller au mieux à ce que vous pourriez
// rencontrer dans une application. Pour cela, nous allons commencer par créer une
// classe Product, permettant de représenter par exemple un produit dans une boutique.
// Cette classe aura les propriétés privées suivantes :
// - id : un entier naturel
// - name : une chaîne de caractères
// - photos : un tableau de chaînes de caractères
// - price : un entier naturel
// - description : une chaîne de caractères
// - quantity : un entier naturel
// - createdAt : une instance d’un objet DateTime
// - updatedAt : une instance d’un objet DateTime
// Créez ensuite les getters et les setters associés à cette classe. Pour rappel, les getters
// d’une classe permettent d’accéder à des propriétés privées en dehors de la classe et les
// setters permettent de modifier les valeurs de ces propriétés.
// Faites en sorte d’initialiser les propriétés de votre classe avec le constructeur de

class Product
{
    private     ?int         $id;
    private     string      $name;
    private     array       $photos;
    private     int         $price;
    private     string      $description;
    private     int         $quantity;
    private     DateTime    $createdAt;
    private     DateTime    $updatedAt;

    public function __construct(?int $id, string $name, array $photos, int $price, string $description, int $quantity, Datetime $createdAt, Datetime $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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
            throw new Exception('Erreur, montant inférieur à 0, modifier le montnant');
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
}
