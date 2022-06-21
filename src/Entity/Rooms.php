<?php

namespace App\Entity;

use App\Repository\RoomsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomsRepository::class)]
class Rooms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $roomName;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $beds;

    #[ORM\Column(type: 'float', nullable: true)]
    private $price;

    #[ORM\ManyToOne(targetEntity: status::class, inversedBy: 'rooms')]
    private $id_status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomName(): ?string
    {
        return $this->roomName;
    }

    public function setRoomName(?string $roomName): self
    {
        $this->roomName = $roomName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBeds(): ?int
    {
        return $this->beds;
    }

    public function setBeds(?int $beds): self
    {
        $this->beds = $beds;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIdStatus(): ?status
    {
        return $this->id_status;
    }

    public function setIdStatus(?status $id_status): self
    {
        $this->id_status = $id_status;

        return $this;
    }
}
