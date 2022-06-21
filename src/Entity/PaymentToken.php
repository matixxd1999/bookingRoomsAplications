<?php

namespace App\Entity;

use App\Repository\PaymentTokenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentTokenRepository::class)]
class PaymentToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $typeOfPayment;

    #[ORM\OneToMany(mappedBy: 'id_paymentToken', targetEntity: BookingRoom::class)]
    private $bookingRooms;

    public function __construct()
    {
        $this->bookingRooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOfPayment(): ?string
    {
        return $this->typeOfPayment;
    }

    public function setTypeOfPayment(?string $typeOfPayment): self
    {
        $this->typeOfPayment = $typeOfPayment;

        return $this;
    }

    /**
     * @return Collection<int, BookingRoom>
     */
    public function getBookingRooms(): Collection
    {
        return $this->bookingRooms;
    }

    public function addBookingRoom(BookingRoom $bookingRoom): self
    {
        if (!$this->bookingRooms->contains($bookingRoom)) {
            $this->bookingRooms[] = $bookingRoom;
            $bookingRoom->setIdPaymentToken($this);
        }

        return $this;
    }

    public function removeBookingRoom(BookingRoom $bookingRoom): self
    {
        if ($this->bookingRooms->removeElement($bookingRoom)) {
            // set the owning side to null (unless already changed)
            if ($bookingRoom->getIdPaymentToken() === $this) {
                $bookingRoom->setIdPaymentToken(null);
            }
        }

        return $this;
    }
}
