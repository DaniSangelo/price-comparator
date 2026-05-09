<?php

namespace App\Domain\Contracts;

interface EventPublisher
{
    public function publish(object $event): void;
}
