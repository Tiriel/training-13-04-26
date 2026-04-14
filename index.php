<?php


use App\EventDispatcher;
use App\Exception\NoListenerException;
use App\Interface\EventListenerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__.'/vendor/autoload.php';

$twig = new Environment(new FilesystemLoader(__DIR__.'/templates'));

$dispatcher = new EventDispatcher();
$dispatcher->addListener('event_foo', function($event) {
    //echo 'Event Foo dispatched!'.\PHP_EOL;
});
$dispatcher->addListener('event_foo', new class($twig) implements EventListenerInterface {
    public function __construct(private Environment $twig) {}
    public function handle(object $event): void
    {
        echo $this->twig->render('event.html.twig', ['event_name' => 'event_foo']);
    }
});

try {
    $dispatcher->dispatch(new stdClass(), 'event_foo');
} catch (NoListenerException $e) {
    echo $e->getMessage().\PHP_EOL;
    echo "Event name : ".$e->eventName.\PHP_EOL;
}
