<?php

namespace App\Interface;

interface EntityInterface
{
    public function getId(): ?int;
    public function setId(?int $id): self;
}
