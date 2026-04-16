<?php

namespace App\Search\Client;

use App\Search\ConferenceSearchInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class ApiConferenceSearch implements ConferenceSearchInterface
{
    public function __construct(
        private HttpClientInterface $client,
        #[Autowire(env: 'CONF_API_KEY')]
        private string $apiKey
    ) {}

    public function searchByName(?string $name = null, ?int $page = null): array
    {
        $query = [];

        if (\is_string($name)) {
            $query['name'] = $name;
        }

        if (\is_int($page)) {
            $query['page'] = $page;
        }

        return $this->client->request('GET', 'https://www.devevents-api.fr/events', [
            'query' => $query,
            'headers' => [
                'Accept' => 'application/json',
                'apikey' => $this->apiKey,
            ],
        ])->toArray();
    }
}
