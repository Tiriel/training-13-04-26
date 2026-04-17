<?php

namespace App\Search\Client\Persistence;

use App\Dto\ApiConference;
use App\Entity\Conference;
use App\Repository\ConferenceRepository;
use App\Repository\OrganizationRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class ApiConferencePersister
{
    public function __construct(
        private ConferenceRepository $conferenceRepository,
        private OrganizationRepository $organizationRepository,
        private EntityManagerInterface $manager,
    ) {}

    public function findOrPersist(ApiConference $dto): Conference
    {
        $dto->setOrganizations($this->findOrCreateOrganizations($dto));

        $conference = $this->conferenceRepository->findOneBy([
            'name' => $dto->getName(),
            'startAt' => $dto->getStartAt(),
            'endAt' => $dto->getEndAt(),
        ]);

        if (null === $conference) {
            $conference = $dto->toEntity();
            $this->manager->persist($conference);
            $this->manager->flush();
        }

        return $conference;
    }

    private function findOrCreateOrganizations(ApiConference $dto): array
    {
        $persistedOrgs = false;

        $organizations = $dto->getOrganizations();
        foreach ($organizations as $key => $dtoOrganization) {
            $organization = $this->organizationRepository->findOneBy([
                'name' => $dtoOrganization->getName(),
                'presentation' => $dtoOrganization->getPresentation(),
                'createdAt' => $dtoOrganization->getCreatedAt(),
            ]);

            if (null === $organization) {
                $organization = $dtoOrganization->toEntity();
                $this->manager->persist($organization);
                $persistedOrgs = true;
            }

            $organizations[$key] = $organization;
        }

        if ($persistedOrgs) {
            $this->manager->flush();
        }

        return $organizations;
    }
}
