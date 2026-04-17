<?php

namespace App\Dto;

use App\Entity\Conference;
use Doctrine\Common\Collections\Collection;

class ApiConference
{
    public function __construct(
        private ?string $name = null,
        private ?string $description = null,
        private ?bool $accessible = null,
        private ?string $prerequisites = null,
        private ?\DateTimeImmutable $startAt = null,
        private ?\DateTimeImmutable $endAt = null,
        private array $organizations,
    ) {}

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): ApiConference
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): ApiConference
    {
        $this->description = $description;

        return $this;
    }

    public function getAccessible(): ?bool
    {
        return $this->accessible;
    }

    public function setAccessible(?bool $accessible): ApiConference
    {
        $this->accessible = $accessible;

        return $this;
    }

    public function getPrerequisites(): ?string
    {
        return $this->prerequisites;
    }

    public function setPrerequisites(?string $prerequisites): ApiConference
    {
        $this->prerequisites = $prerequisites;

        return $this;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(?\DateTimeImmutable $startAt): ApiConference
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeImmutable $endAt): ApiConference
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getOrganizations(): array
    {
        return $this->organizations;
    }

    public function setOrganizations(array $organizations): ApiConference
    {
        $this->organizations = $organizations;

        return $this;
    }

    public function toEntity(): Conference
    {
        $conference = (new Conference())
            ->setName($this->name)
            ->setDescription($this->description)
            ->setAccessible($this->accessible)
            ->setPrerequisites($this->prerequisites)
            ->setStartAt($this->startAt)
            ->setEndAt($this->endAt);

        foreach ($this->organizations as $organization) {
            $conference->addOrganization($organization);
        }

        return $conference;
    }
}
