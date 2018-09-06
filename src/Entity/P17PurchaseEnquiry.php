<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17PurchaseEnquiry
 *
 * @ORM\Table(name="p17_purchase_enquiry", indexes={@ORM\Index(name="projectID", columns={"projectID"}), @ORM\Index(name="ticketID", columns={"ticketID"})})
 * @ORM\Entity
 */
class P17PurchaseEnquiry
{
    /**
     * @var int
     *
     * @ORM\Column(name="projectID", type="integer", nullable=false)
     */
    private $projectid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="voucherNo", type="string", length=20, nullable=false)
     */
    private $voucherno;

    /**
     * @var int
     *
     * @ORM\Column(name="orderID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderid;

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var string
     *
     * @ORM\Column(name="supplier_company", type="string", length=50, nullable=false)
     */
    private $supplierCompany;

    /**
     * @var int
     *
     * @ORM\Column(name="supplier_firmID", type="integer", nullable=false)
     */
    private $supplierFirmid;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=50, nullable=false)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=10, nullable=false)
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
     * @ORM\Column(name="country", type="string", length=20, nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=100, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="week", type="string", length=10, nullable=false)
     */
    private $week;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=0, nullable=false)
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="classID", type="integer", nullable=false)
     */
    private $classid;

    /**
     * @var int
     *
     * @ORM\Column(name="teamID", type="integer", nullable=false)
     */
    private $teamid;

    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="integer", nullable=false)
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=25, nullable=false)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var \P17Tickets
     *
     * @ORM\ManyToOne(targetEntity="P17Tickets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ticketID", referencedColumnName="ticketID")
     * })
     */
    private $ticketid;

    public function getProjectid(): ?int
    {
        return $this->projectid;
    }

    public function setProjectid(int $projectid): self
    {
        $this->projectid = $projectid;

        return $this;
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

    public function getVoucherno(): ?string
    {
        return $this->voucherno;
    }

    public function setVoucherno(string $voucherno): self
    {
        $this->voucherno = $voucherno;

        return $this;
    }

    public function getOrderid(): ?int
    {
        return $this->orderid;
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

    public function getSupplierCompany(): ?string
    {
        return $this->supplierCompany;
    }

    public function setSupplierCompany(string $supplierCompany): self
    {
        $this->supplierCompany = $supplierCompany;

        return $this;
    }

    public function getSupplierFirmid(): ?int
    {
        return $this->supplierFirmid;
    }

    public function setSupplierFirmid(int $supplierFirmid): self
    {
        $this->supplierFirmid = $supplierFirmid;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getWeek(): ?string
    {
        return $this->week;
    }

    public function setWeek(string $week): self
    {
        $this->week = $week;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getClassid(): ?int
    {
        return $this->classid;
    }

    public function setClassid(int $classid): self
    {
        $this->classid = $classid;

        return $this;
    }

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function setTeamid(int $teamid): self
    {
        $this->teamid = $teamid;

        return $this;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

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

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getTicketid(): ?P17Tickets
    {
        return $this->ticketid;
    }

    public function setTicketid(?P17Tickets $ticketid): self
    {
        $this->ticketid = $ticketid;

        return $this;
    }


}
