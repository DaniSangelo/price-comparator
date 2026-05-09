<?php


namespace App\Domain\Contracts;

interface HttpClientInterface
{
    public function post(string $url, array $data);
}