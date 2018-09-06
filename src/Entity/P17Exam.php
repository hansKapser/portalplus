<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Exam
 *
 * @ORM\Table(name="p17_exam", uniqueConstraints={@ORM\UniqueConstraint(name="ticketID", columns={"ticketID"})}, indexes={@ORM\Index(name="classID", columns={"classID"})})
 * @ORM\Entity
 */
class P17Exam
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
     * @ORM\Column(name="locked", type="boolean", nullable=false)
     */
    private $locked;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="division", type="string", length=1, nullable=false)
     */
    private $division;

    /**
     * @var string
     *
     * @ORM\Column(name="userIDs", type="text", length=0, nullable=false)
     */
    private $userids;

    /**
     * @var string
     *
     * @ORM\Column(name="checkSelected", type="string", length=100, nullable=false)
     */
    private $checkselected;

    /**
     * @var string
     *
     * @ORM\Column(name="pForm", type="string", length=100, nullable=false)
     */
    private $pform;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=5, nullable=false)
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="print_form", type="string", length=10, nullable=false)
     */
    private $printForm;

    /**
     * @var string
     *
     * @ORM\Column(name="payment", type="string", length=20, nullable=false)
     */
    private $payment;

    /**
     * @var string
     *
     * @ORM\Column(name="statementNo", type="string", length=10, nullable=false)
     */
    private $statementno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="statementDate", type="date", nullable=false)
     */
    private $statementdate;

    /**
     * @var string
     *
     * @ORM\Column(name="paymentAmount", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $paymentamount;

    /**
     * @var string
     *
     * @ORM\Column(name="paymentReason", type="text", length=0, nullable=false)
     */
    private $paymentreason;

    /**
     * @var string
     *
     * @ORM\Column(name="initiatorUser", type="string", length=20, nullable=false, options={"default"="GF"})
     */
    private $initiatoruser = 'GF';

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

    /**
     * @var \P17UserClasses
     *
     * @ORM\ManyToOne(targetEntity="P17UserClasses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="classID", referencedColumnName="id")
     * })
     */
    private $classid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocked(): ?bool
    {
        return $this->locked;
    }

    public function setLocked(bool $locked): self
    {
        $this->locked = $locked;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getDivision(): ?string
    {
        return $this->division;
    }

    public function setDivision(string $division): self
    {
        $this->division = $division;

        return $this;
    }

    public function getUserids(): ?string
    {
        return $this->userids;
    }

    public function setUserids(string $userids): self
    {
        $this->userids = $userids;

        return $this;
    }

    public function getCheckselected(): ?string
    {
        return $this->checkselected;
    }

    public function setCheckselected(string $checkselected): self
    {
        $this->checkselected = $checkselected;

        return $this;
    }

    public function getPform(): ?string
    {
        return $this->pform;
    }

    public function setPform(string $pform): self
    {
        $this->pform = $pform;

        return $this;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function getPrintForm(): ?string
    {
        return $this->printForm;
    }

    public function setPrintForm(string $printForm): self
    {
        $this->printForm = $printForm;

        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function setPayment(string $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getStatementno(): ?string
    {
        return $this->statementno;
    }

    public function setStatementno(string $statementno): self
    {
        $this->statementno = $statementno;

        return $this;
    }

    public function getStatementdate(): ?\DateTimeInterface
    {
        return $this->statementdate;
    }

    public function setStatementdate(\DateTimeInterface $statementdate): self
    {
        $this->statementdate = $statementdate;

        return $this;
    }

    public function getPaymentamount()
    {
        return $this->paymentamount;
    }

    public function setPaymentamount($paymentamount): self
    {
        $this->paymentamount = $paymentamount;

        return $this;
    }

    public function getPaymentreason(): ?string
    {
        return $this->paymentreason;
    }

    public function setPaymentreason(string $paymentreason): self
    {
        $this->paymentreason = $paymentreason;

        return $this;
    }

    public function getInitiatoruser(): ?string
    {
        return $this->initiatoruser;
    }

    public function setInitiatoruser(string $initiatoruser): self
    {
        $this->initiatoruser = $initiatoruser;

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

    public function getClassid(): ?P17UserClasses
    {
        return $this->classid;
    }

    public function setClassid(?P17UserClasses $classid): self
    {
        $this->classid = $classid;

        return $this;
    }


}
