<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Offer
 *
 * @ORM\Table(name="p17_offer", indexes={@ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17Offer
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
     * @ORM\Column(name="customer_firmID", type="integer", nullable=false)
     */
    private $customerFirmid;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_company", type="string", length=100, nullable=false)
     */
    private $customerCompany;

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
     * @var int
     *
     * @ORM\Column(name="ticketID", type="integer", nullable=false)
     */
    private $ticketid;

    /**
     * @var string
     *
     * @ORM\Column(name="receiver", type="string", length=100, nullable=false)
     */
    private $receiver;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=50, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=0, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sentDate", type="date", nullable=false)
     */
    private $sentdate;

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

    public function getCustomerFirmid(): ?int
    {
        return $this->customerFirmid;
    }

    public function setCustomerFirmid(int $customerFirmid): self
    {
        $this->customerFirmid = $customerFirmid;

        return $this;
    }

    public function getCustomerCompany(): ?string
    {
        return $this->customerCompany;
    }

    public function setCustomerCompany(string $customerCompany): self
    {
        $this->customerCompany = $customerCompany;

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

    public function getTicketid(): ?int
    {
        return $this->ticketid;
    }

    public function setTicketid(int $ticketid): self
    {
        $this->ticketid = $ticketid;

        return $this;
    }

    public function getReceiver(): ?string
    {
        return $this->receiver;
    }

    public function setReceiver(string $receiver): self
    {
        $this->receiver = $receiver;

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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSentdate(): ?\DateTimeInterface
    {
        return $this->sentdate;
    }

    public function setSentdate(\DateTimeInterface $sentdate): self
    {
        $this->sentdate = $sentdate;

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


}
