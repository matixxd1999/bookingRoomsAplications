<?php

namespace App\Entity;

use App\Repository\HotelLocationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HotelLocationsRepository::class)]
class HotelLocations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $country;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private $postCode;

    #[ORM\Column(type: 'string', length: 40, nullable: true)]
    private $city;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $street;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $homeNumber;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $roomNumber;

    #[ORM\ManyToOne(targetEntity: BookingRoom::class, inversedBy: 'id_hotelLocations')]
    #[ORM\JoinColumn(nullable: false)]
    private $bookingRoom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getHomeNumber(): ?string
    {
        return $this->homeNumber;
    }

    public function setHomeNumber(?string $homeNumber): self
    {
        $this->homeNumber = $homeNumber;

        return $this;
    }

    public function getRoomNumber(): ?string
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(string $roomNumber): self
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    public function getBookingRoom(): ?BookingRoom
    {
        return $this->bookingRoom;
    }

    public function setBookingRoom(?BookingRoom $bookingRoom): self
    {
        $this->bookingRoom = $bookingRoom;

        return $this;
    }
}
