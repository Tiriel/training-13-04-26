<?php

require_once __DIR__.'/EventDispatcher.php';

$dispatcher = new EventDispatcher();
$dispatcher->addListener('event_foo', function($event) {
    echo 'Event Foo dispatched!'.\PHP_EOL;
});

$dispatcher->dispatch(new stdClass(), 'event_foo');
