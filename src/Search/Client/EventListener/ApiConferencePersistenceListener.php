<?php

namespace App\Search\Client\EventListener;

use App\Search\Client\Event\ApiConferenceFetchedEvent;
use App\Search\Client\Persistence\ApiConferencePersister;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(priority: 50)]
final class ApiConferencePersistenceListener
{
    public function __construct(
        private readonly ApiConferencePersister $persister,
    ) {}

    public function __invoke(ApiConferenceFetchedEvent $event): void
    {
        $dto = $event->getDto();
        $event->setConference($this->persister->findOrPersist($dto));
    }
}
