<?php

namespace App\Search\Client\EventListener;

use App\Search\Client\Event\ApiConferenceFetchedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class ApiConferenceHydrationListener
{
    #[AsEventListener(priority: 100)]
    public function onApiConferenceFetchedEvent(ApiConferenceFetchedEvent $event): void
    {
        // ...
    }
}
