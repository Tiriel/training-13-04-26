<?php

namespace App\Search\Client\EventListener;

use App\Search\Client\Event\ApiConferenceFetchedEvent;
use App\Search\Client\Persistence\ApiConferencePersister;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class ApiConferencePersistenceListener
{
    public function __construct(
        private readonly ApiConferencePersister $persister,
    ) {}

    #[AsEventListener(priority: 50)]
    public function onApiConferenceFetchedEvent(ApiConferenceFetchedEvent $event): void
    {
        // ...
    }
}
