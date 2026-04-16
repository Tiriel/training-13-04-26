<?php

namespace App\Search\Client;

use App\Search\ConferenceSearchInterface;

class ApiConferenceSearch implements ConferenceSearchInterface
{

    public function searchByName(?string $name = null, ?int $page = null): array
    {
        // TODO: Implement searchByName() method.
    }
}
