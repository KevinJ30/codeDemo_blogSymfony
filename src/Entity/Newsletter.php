<?php

namespace App\Entity;

use App\Repository\NewsletterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewsletterRepository::class)
 */
class Newsletter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $registration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistration(): ?\DateTimeImmutable
    {
        return $this->registration;
    }

    public function setRegistration(\DateTimeImmutable $registration): self
    {
        $this->registration = $registration;

        return $this;
    }
}
