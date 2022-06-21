<?php

namespace App\Entity;

use App\Repository\BookingRoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRoomRepository::class)]
class BookingRoom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'bookingRoom', targetEntity: hotelLocations::class)]
    private $id_hotelLocations;

    #[ORM\ManyToOne(targetEntity: users::class, inversedBy: 'bookingRooms')]
    private $id_users;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $startDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $endDate;

    #[ORM\ManyToOne(targetEntity: paymentToken::class, inversedBy: 'bookingRooms')]
    private $id_paymentToken;

    public function __construct()
    {
        $this->id_hotelLocations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, hotelLocations>
     */
    public function getIdHotelLocations(): Collection
    {
        return $this->id_hotelLocations;
    }

    public function addIdHotelLocation(hotelLocations $idHotelLocation): self
    {
        if (!$this->id_hotelLocations->contains($idHotelLocation)) {
            $this->id_hotelLocations[] = $idHotelLocation;
            $idHotelLocation->setBookingRoom($this);
        }

        return $this;
    }

    public function removeIdHotelLocation(hotelLocations $idHotelLocation): self
    {
        if ($this->id_hotelLocations->removeElement($idHotelLocation)) {
            // set the owning side to null (unless already changed)
            if ($idHotelLocation->getBookingRoom() === $this) {
                $idHotelLocation->setBookingRoom(null);
            }
        }

        return $this;
    }

    public function getIdUsers(): ?users
    {
        return $this->id_users;
    }

    public function setIdUsers(?users $id_users): self
    {
        $this->id_users = $id_users;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getIdPaymentToken(): ?paymentToken
    {
        return $this->id_paymentToken;
    }

    public function setIdPaymentToken(?paymentToken $id_paymentToken): self
    {
        $this->id_paymentToken = $id_paymentToken;

        return $this;
    }
}
