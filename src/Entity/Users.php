<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $phoneNumber;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private $postCode;

    #[ORM\Column(type: 'string', length: 40, nullable: true)]
    private $city;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $street;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $homeNumber;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $apartmentNumber;

    #[ORM\OneToMany(mappedBy: 'id_users', targetEntity: BookingRoom::class)]
    private $bookingRooms;

    #[ORM\ManyToOne(targetEntity: country::class, inversedBy: 'users')]
    private $id_country;

    public function __construct()
    {
        $this->bookingRooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getApartmentNumber(): ?string
    {
        return $this->apartmentNumber;
    }

    public function setApartmentNumber(?string $apartmentNumber): self
    {
        $this->apartmentNumber = $apartmentNumber;

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
            $bookingRoom->setIdUsers($this);
        }

        return $this;
    }

    public function removeBookingRoom(BookingRoom $bookingRoom): self
    {
        if ($this->bookingRooms->removeElement($bookingRoom)) {
            // set the owning side to null (unless already changed)
            if ($bookingRoom->getIdUsers() === $this) {
                $bookingRoom->setIdUsers(null);
            }
        }

        return $this;
    }

    public function getIdCountry(): ?country
    {
        return $this->id_country;
    }

    public function setIdCountry(?country $id_country): self
    {
        $this->id_country = $id_country;

        return $this;
    }
}
