<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17PostbookIn
 *
 * @ORM\Table(name="p17_postbook_in", indexes={@ORM\Index(name="ticketID", columns={"ticketID"}), @ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17PostbookIn
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
     * @ORM\Column(name="from_firmID", type="integer", nullable=false)
     */
    private $fromFirmid;

    /**
     * @var string
     *
     * @ORM\Column(name="from_company", type="string", length=100, nullable=false)
     */
    private $fromCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="sender_company", type="string", length=50, nullable=false, options={"default"="from_company"})
     */
    private $senderCompany = 'from_company';

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
     * @ORM\Column(name="voucherNoInternal", type="string", length=20, nullable=false)
     */
    private $vouchernointernal;

    /**
     * @var string
     *
     * @ORM\Column(name="division", type="string", length=2, nullable=false)
     */
    private $division;

    /**
     * @var int
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=20, nullable=false)
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="integer", nullable=false)
     */
    private $userid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="examUserID", type="integer", nullable=true)
     */
    private $examuserid;

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

    public function getFromFirmid(): ?int
    {
        return $this->fromFirmid;
    }

    public function setFromFirmid(int $fromFirmid): self
    {
        $this->fromFirmid = $fromFirmid;

        return $this;
    }

    public function getFromCompany(): ?string
    {
        return $this->fromCompany;
    }

    public function setFromCompany(string $fromCompany): self
    {
        $this->fromCompany = $fromCompany;

        return $this;
    }

    public function getSenderCompany(): ?string
    {
        return $this->senderCompany;
    }

    public function setSenderCompany(string $senderCompany): self
    {
        $this->senderCompany = $senderCompany;

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

    public function getVouchernointernal(): ?string
    {
        return $this->vouchernointernal;
    }

    public function setVouchernointernal(string $vouchernointernal): self
    {
        $this->vouchernointernal = $vouchernointernal;

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

    public function getUid(): ?int
    {
        return $this->uid;
    }

    public function setUid(int $uid): self
    {
        $this->uid = $uid;

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

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getExamuserid(): ?int
    {
        return $this->examuserid;
    }

    public function setExamuserid(?int $examuserid): self
    {
        $this->examuserid = $examuserid;

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
