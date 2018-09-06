<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FairOrderbook
 *
 * @ORM\Table(name="p17_fair_orderbook", indexes={@ORM\Index(name="fairID", columns={"fairID"}), @ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17FairOrderbook
{
    /**
     * @var int
     *
     * @ORM\Column(name="orderID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchaseDate", type="date", nullable=false)
     */
    private $purchasedate;

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var int
     *
     * @ORM\Column(name="customer_firmID", type="integer", nullable=false)
     */
    private $customerFirmid;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=100, nullable=false)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=50, nullable=false)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=3, nullable=false)
     */
    private $country;

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
     * @var string
     *
     * @ORM\Column(name="VatID", type="string", length=50, nullable=false)
     */
    private $vatid;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=20, nullable=false)
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="examUserID", type="integer", nullable=false)
     */
    private $examuserid;

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
     * @var \P17Fairs
     *
     * @ORM\ManyToOne(targetEntity="P17Fairs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fairID", referencedColumnName="fairID")
     * })
     */
    private $fairid;

    public function getOrderid(): ?int
    {
        return $this->orderid;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPurchasedate(): ?\DateTimeInterface
    {
        return $this->purchasedate;
    }

    public function setPurchasedate(\DateTimeInterface $purchasedate): self
    {
        $this->purchasedate = $purchasedate;

        return $this;
    }

    public function getFirmid(): ?int
    {
        return $this->firmid;
    }

    public function setFirmid(int $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }

    public function getCustomerFirmid(): ?int
    {
        return $this->customerFirmid;
    }

    public function setCustomerFirmid(int $customerFirmid): self
    {
        $this->customerFirmid = $customerFirmid;

        return $this;
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

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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

    public function getVatid(): ?string
    {
        return $this->vatid;
    }

    public function setVatid(string $vatid): self
    {
        $this->vatid = $vatid;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getExamuserid(): ?int
    {
        return $this->examuserid;
    }

    public function setExamuserid(int $examuserid): self
    {
        $this->examuserid = $examuserid;

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

    public function getFairid(): ?P17Fairs
    {
        return $this->fairid;
    }

    public function setFairid(?P17Fairs $fairid): self
    {
        $this->fairid = $fairid;

        return $this;
    }


}
