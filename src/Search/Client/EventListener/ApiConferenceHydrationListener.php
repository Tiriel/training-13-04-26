<?php

namespace App\Search\Client\EventListener;

use App\Dto\ApiConference;
use App\Dto\ApiOrganization;
use App\Search\Client\Event\ApiConferenceFetchedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(priority: 100)]
final class ApiConferenceHydrationListener
{
    public function __invoke(ApiConferenceFetchedEvent $event): void
    {
        $data = $event->getData();
        $dto = $this->getConferenceDto($data);

        $event->setDto($dto);
    }

    private function getConferenceDto(array $data): ApiConference
    {
        return new ApiConference(
            $data['name'],
            $data['description'],
            $data['accessible'],
            $data['prerequisites'] ?? '',
            new \DateTimeImmutable($data['startDate']),
            new \DateTimeImmutable($data['endDate']),
            $this->getOrganizations($data['organizations']),
        );
    }

    private function getOrganizations(array $data): array
    {
        return \array_map(fn(array $org) => new ApiOrganization(
                $org['name'],
                $org['presentation'],
                new \DateTimeImmutable($data['creationDate'] ?? ''),
            ), $data ?? []);
    }
}
