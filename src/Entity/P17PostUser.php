<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17PostUser
 *
 * @ORM\Table(name="p17_post_user", indexes={@ORM\Index(name="firmID", columns={"firmID"}), @ORM\Index(name="postNumber", columns={"postNumber"})})
 * @ORM\Entity
 */
class P17PostUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=50, nullable=false)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="parcelStationNo", type="integer", nullable=false)
     */
    private $parcelstationno;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=50, nullable=false)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=5, nullable=false)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var int
     *
     * @ORM\Column(name="postNumber", type="integer", nullable=false)
     */
    private $postnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="postPassword", type="string", length=50, nullable=false)
     */
    private $postpassword;

    /**
     * @var int|null
     *
     * @ORM\Column(name="userID", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var \P17Firms
     *
     * @ORM\ManyToOne(targetEntity="P17Firms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="firmID", referencedColumnName="firmID")
     * })
     */
    private $firmid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
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

    public function getParcelstationno(): ?int
    {
        return $this->parcelstationno;
    }

    public function setParcelstationno(int $parcelstationno): self
    {
        $this->parcelstationno = $parcelstationno;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostnumber(): ?int
    {
        return $this->postnumber;
    }

    public function setPostnumber(int $postnumber): self
    {
        $this->postnumber = $postnumber;

        return $this;
    }

    public function getPostpassword(): ?string
    {
        return $this->postpassword;
    }

    public function setPostpassword(string $postpassword): self
    {
        $this->postpassword = $postpassword;

        return $this;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(?int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getFirmid(): ?P17Firms
    {
        return $this->firmid;
    }

    public function setFirmid(?P17Firms $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }


}
