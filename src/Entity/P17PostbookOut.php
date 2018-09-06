<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17PostbookOut
 *
 * @ORM\Table(name="p17_postbook_out", indexes={@ORM\Index(name="date", columns={"date"}), @ORM\Index(name="ticketID", columns={"ticketID"}), @ORM\Index(name="orderID", columns={"orderID"}), @ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17PostbookOut
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
     * @var bool
     *
     * @ORM\Column(name="email", type="boolean", nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="to_email", type="string", length=100, nullable=false)
     */
    private $toEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var int
     *
     * @ORM\Column(name="to_firmID", type="integer", nullable=false)
     */
    private $toFirmid;

    /**
     * @var string
     *
     * @ORM\Column(name="to_company", type="string", length=100, nullable=false)
     */
    private $toCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="voucher", type="string", length=20, nullable=false)
     */
    private $voucher;

    /**
     * @var string
     *
     * @ORM\Column(name="voucherNo", type="string", length=20, nullable=false)
     */
    private $voucherno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="voucherDate", type="date", nullable=false)
     */
    private $voucherdate;

    /**
     * @var string
     *
     * @ORM\Column(name="division", type="string", length=2, nullable=false)
     */
    private $division;

    /**
     * @var int
     *
     * @ORM\Column(name="orderID", type="integer", nullable=false)
     */
    private $orderid;

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
     * @var \P17Tickets
     *
     * @ORM\ManyToOne(targetEntity="P17Tickets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ticketID", referencedColumnName="ticketID")
     * })
     */
    private $ticketid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?bool
    {
        return $this->email;
    }

    public function setEmail(bool $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getToEmail(): ?string
    {
        return $this->toEmail;
    }

    public function setToEmail(string $toEmail): self
    {
        $this->toEmail = $toEmail;

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

    public function getFirmid(): ?int
    {
        return $this->firmid;
    }

    public function setFirmid(int $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }

    public function getToFirmid(): ?int
    {
        return $this->toFirmid;
    }

    public function setToFirmid(int $toFirmid): self
    {
        $this->toFirmid = $toFirmid;

        return $this;
    }

    public function getToCompany(): ?string
    {
        return $this->toCompany;
    }

    public function setToCompany(string $toCompany): self
    {
        $this->toCompany = $toCompany;

        return $this;
    }

    public function getVoucher(): ?string
    {
        return $this->voucher;
    }

    public function setVoucher(string $voucher): self
    {
        $this->voucher = $voucher;

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

    public function getVoucherdate(): ?\DateTimeInterface
    {
        return $this->voucherdate;
    }

    public function setVoucherdate(\DateTimeInterface $voucherdate): self
    {
        $this->voucherdate = $voucherdate;

        return $this;
    }

    public function getDivision(): ?string
    {
        return $this->division;
    }

    public function setDivision(string $division): self
    {
        $this->division = $division;

        return $this;
    }

    public function getOrderid(): ?int
    {
        return $this->orderid;
    }

    public function setOrderid(int $orderid): self
    {
        $this->orderid = $orderid;

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
