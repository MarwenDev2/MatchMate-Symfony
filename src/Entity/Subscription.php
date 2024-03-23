<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\SubscriptionRepository;
use Symfony\Component\Validator\Constraints as Assert;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:SubscriptionRepository::class)]
class Subscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?DateTimeInterface $startdate;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?DateTimeInterface $enddate;

    #[ORM\ManyToOne(targetEntity: Offer::class,inversedBy:'subscriptions')]
    private ?Offer $idoffer =null;

    #[ORM\ManyToOne(targetEntity: User::class,inversedBy:'subscriptions')]
    private ?User $iduser;

    #[ORM\ManyToMany(targetEntity: Payment::class, inversedBy: 'idsubscription')]
    private Collection $idpayment;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idpayment = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(\DateTimeInterface $startdate): static
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(\DateTimeInterface $enddate): static
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getIdoffer(): ?Offer
    {
        return $this->idoffer;
    }

    public function setIdoffer(?Offer $idoffer): static
    {
        $this->idoffer = $idoffer;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getIdpayment(): Collection
    {
        return $this->idpayment;
    }

    public function addIdpayment(Payment $idpayment): static
    {
        if (!$this->idpayment->contains($idpayment)) {
            $this->idpayment->add($idpayment);
        }

        return $this;
    }

    public function removeIdpayment(Payment $idpayment): static
    {
        $this->idpayment->removeElement($idpayment);

        return $this;
    }

}