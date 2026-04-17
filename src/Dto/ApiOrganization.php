<?php

namespace App\Dto;

use App\Entity\Organization;
use Doctrine\Common\Collections\Collection;

class ApiOrganization
{
    public function __construct(
        private ?string $name = null,
        private ?string $presentation = null,
        private ?\DateTimeImmutable $createdAt = null,
        private array $conferences,
    ) {}

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): ApiOrganization
    {
        $this->name = $name;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): ApiOrganization
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): ApiOrganization
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getConferences(): array
    {
        return $this->conferences;
    }

    public function setConferences(array $conferences): ApiOrganization
    {
        $this->conferences = $conferences;

        return $this;
    }

    public function toEntity(): Organization
    {
        $organization = (new Organization())
            ->setName($this->name)
            ->setPresentation($this->presentation)
            ->setCreatedAt($this->createdAt);

        foreach ($this->conferences as $conference) {
            $organization->addConference($conference);
        }

        return $organization;
    }
}
