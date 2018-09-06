<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17PurchaseRequest
 *
 * @ORM\Table(name="p17_purchase_request")
 * @ORM\Entity
 */
class P17PurchaseRequest
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="voucherNo", type="string", length=20, nullable=true)
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
     * @ORM\Column(name="ticketID", type="integer", nullable=false)
     */
    private $ticketid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="personalizeID", type="text", length=0, nullable=true)
     */
    private $personalizeid;

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var int
     *
     * @ORM\Column(name="supplier_firmID", type="integer", nullable=false)
     */
    private $supplierFirmid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="supplier_company", type="string", length=50, nullable=true)
     */
    private $supplierCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="basisPrice", type="string", length=3, nullable=false, options={"default"="K"})
     */
    private $basisprice = 'K';

    /**
     * @var string|null
     *
     * @ORM\Column(name="offerNo", type="string", length=20, nullable=true)
     */
    private $offerno;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="offerDate", type="date", nullable=true)
     */
    private $offerdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subject", type="string", length=100, nullable=true)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="week", type="string", length=10, nullable=false)
     */
    private $week = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=0, nullable=true)
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="classID", type="integer", nullable=false)
     */
    private $classid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="teamID", type="integer", nullable=false)
     */
    private $teamid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="integer", nullable=false)
     */
    private $userid = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="personalize", type="boolean", nullable=false)
     */
    private $personalize = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="user", type="string", length=25, nullable=true)
     */
    private $user;

    /**
     * @var string|null
     *
     * @ORM\Column(name="initiatorUser", type="string", length=20, nullable=true)
     */
    private $initiatoruser;

    /**
     * @var int|null
     *
     * @ORM\Column(name="bbUserID", type="integer", nullable=true)
     */
    private $bbuserid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="temp", type="string", length=20, nullable=true)
     */
    private $temp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

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

    public function setVoucherno(?string $voucherno): self
    {
        $this->voucherno = $voucherno;

        return $this;
    }

    public function getOrderid(): ?int
    {
        return $this->orderid;
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

    public function getPersonalizeid(): ?string
    {
        return $this->personalizeid;
    }

    public function setPersonalizeid(?string $personalizeid): self
    {
        $this->personalizeid = $personalizeid;

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

    public function getSupplierFirmid(): ?int
    {
        return $this->supplierFirmid;
    }

    public function setSupplierFirmid(int $supplierFirmid): self
    {
        $this->supplierFirmid = $supplierFirmid;

        return $this;
    }

    public function getSupplierCompany(): ?string
    {
        return $this->supplierCompany;
    }

    public function setSupplierCompany(?string $supplierCompany): self
    {
        $this->supplierCompany = $supplierCompany;

        return $this;
    }

    public function getBasisprice(): ?string
    {
        return $this->basisprice;
    }

    public function setBasisprice(string $basisprice): self
    {
        $this->basisprice = $basisprice;

        return $this;
    }

    public function getOfferno(): ?string
    {
        return $this->offerno;
    }

    public function setOfferno(?string $offerno): self
    {
        $this->offerno = $offerno;

        return $this;
    }

    public function getOfferdate(): ?\DateTimeInterface
    {
        return $this->offerdate;
    }

    public function setOfferdate(?\DateTimeInterface $offerdate): self
    {
        $this->offerdate = $offerdate;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
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

    public function setContent(?string $content): self
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

    public function getPersonalize(): ?bool
    {
        return $this->personalize;
    }

    public function setPersonalize(bool $personalize): self
    {
        $this->personalize = $personalize;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(?string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getInitiatoruser(): ?string
    {
        return $this->initiatoruser;
    }

    public function setInitiatoruser(?string $initiatoruser): self
    {
        $this->initiatoruser = $initiatoruser;

        return $this;
    }

    public function getBbuserid(): ?int
    {
        return $this->bbuserid;
    }

    public function setBbuserid(?int $bbuserid): self
    {
        $this->bbuserid = $bbuserid;

        return $this;
    }

    public function getTemp(): ?string
    {
        return $this->temp;
    }

    public function setTemp(?string $temp): self
    {
        $this->temp = $temp;

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
