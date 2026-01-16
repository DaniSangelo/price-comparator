<?php


namespace App\Application\UseCases\SearchProducts;

use App\Core\DTO;

class SearchProductsInput extends DTO
{
    public ?string $query = null;
    public int $page = 50;

    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function query(): ?string
    {
        if ($this->query === null) {
            return null;
        }

        $qry = trim($this->query);
        return $qry === '' ? null : $qry;
    }

    public function page(): int
    {
        return $this->page;
    }
}