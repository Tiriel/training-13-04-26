<?php


use App\EventDispatcher;
use App\Exception\NoListenerException;
use App\Interface\EventListenerInterface;

spl_autoload_register(function (string $classname) {
    $classname = str_replace('\\', '/', $classname);
    $path = strtr($classname, ['App/' => __DIR__.'/src/']).'.php';
    require_once $path;
});

$dispatcher = new EventDispatcher();
$dispatcher->addListener('event_foo', function($event) {
    echo 'Event Foo dispatched!'.\PHP_EOL;
});
$dispatcher->addListener('event_foo', new class implements EventListenerInterface {
    public function handle(object $event): void
    {
        echo 'Event Foo listened from Interface'.\PHP_EOL;
    }
});

try {
    $dispatcher->dispatch(new stdClass(), 'event_foo');
} catch (NoListenerException $e) {
    echo $e->getMessage().\PHP_EOL;
    echo "Event name : ".$e->eventName.\PHP_EOL;
}
