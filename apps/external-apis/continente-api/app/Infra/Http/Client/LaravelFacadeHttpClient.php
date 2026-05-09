<?php


namespace App\Infra\Http\Client;

use App\Domain\Contracts\HttpClientInterface;
use Illuminate\Support\Facades\Http;

class LaravelFacadeHttpClient implements HttpClientInterface
{
    public function post(string $url, array $data, array $headers = [])
    {
        return count($headers) > 0
            ? Http::withHeaders($headers)->post($url, $data)
            : Http::post($url, $data);
    }
}