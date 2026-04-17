<?php

namespace App\Search\Client;

use App\Search\Client\Event\ApiConferenceFetchedEvent;
use App\Search\ConferenceSearchInterface;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsAlias]
#[AutoconfigureTag('app.conference_search')]
readonly class ApiConferenceSearch implements ConferenceSearchInterface
{
    public function __construct(
        #[Target('conf.client')] private HttpClientInterface $client,
        private EventDispatcherInterface $dispatcher,
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

        $data = $this->client->request('GET', '/events', [
            'query' => $query,
        ])->toArray();

        foreach ($data as $key => $datum) {
            $event = $this->dispatcher->dispatch(new ApiConferenceFetchedEvent($datum));
            $data[$key] = $event->getConference();
        }

        return $data;
    }
}
