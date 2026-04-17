<?php

namespace App\Search\Client\Event;

use App\Dto\ApiConference;
use App\Entity\Conference;
use Symfony\Contracts\EventDispatcher\Event;

class ApiConferenceFetchedEvent extends Event
{
    private ?ApiConference $dto = null;
    private ?Conference $conference = null;

    public function __construct(
        private array $data,
    ) {}

    public function getData(): array
    {
        return $this->data;
    }

    public function getDto(): ?ApiConference
    {
        return $this->dto;
    }

    public function setDto(?ApiConference $dto): ApiConferenceFetchedEvent
    {
        $this->dto = $dto;

        return $this;
    }

    public function getConference(): ?Conference
    {
        return $this->conference;
    }

    public function setConference(?Conference $conference): ApiConferenceFetchedEvent
    {
        $this->conference = $conference;

        return $this;
    }
}
