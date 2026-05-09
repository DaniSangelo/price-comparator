<?php

namespace App\Application\UseCases\ProductUpdate;

use App\Domain\Contracts\EventPublisher;
use App\Domain\Contracts\Repositories\ProductRepositoryInterface;

class ProductUpdateUseCase
{
    public function __construct(private ProductRepositoryInterface $repository, private EventPublisher $eventPublisher) {}

    public function execute(UpdateProductInput $input)
    {
        //todo: atualizar produto
        //todo: publicar evento
    }
}