<?php

class EventDispatcher
{
    private array $listeners = [];

    public function addListener(string $eventName, callable $listener): void
    {
        $this->listeners[$eventName][] = $listener;
    }

    public function dispatch(object $event, ?string $eventName = null): object
    {
        //$eventName = $eventName !== null ? $eventName : $event::class;
        $eventName ??= $event::class;

        foreach ($this->listeners[$eventName] as $listener) {
            $listener($event);
        }

        return $event;
    }
}