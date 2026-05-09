<?php

namespace App\Application\UseCases\ProductUpdate;

use App\Core\DTO;

class UpdateProductInput extends DTO
{
    public string $productId;
    public ?string $name;
    public ?float $price;

    public function __construct(array $data)
    {
        return parent::__construct($data);
    }
}