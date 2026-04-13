<?php

namespace App;

use App\Exception\NoListenerException;
use App\Interface\EventListenerInterface;

class EventDispatcher
{
    private array $listeners = [];

    public function addListener(string $eventName, callable|EventListenerInterface $listener): void
    {
        $this->listeners[$eventName][] = $listener;
    }

    public function dispatch(object $event, ?string $eventName = null): object
    {
        //$eventName = $eventName !== null ? $eventName : $event::class;
        $eventName ??= $event::class;

        if (!\array_key_exists($eventName, $this->listeners)) {
            throw new NoListenerException($eventName, $event);
        }

        foreach ($this->listeners[$eventName] as $listener) {
            $listener instanceof EventListenerInterface
                ? $listener->handle($event)
                : $listener($event);
        }

        return $event;
    }
}