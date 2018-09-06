<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Tickets
 *
 * @ORM\Table(name="p17_tickets", indexes={@ORM\Index(name="tickets_userID", columns={"userID"}), @ORM\Index(name="workflowID", columns={"workflowID"}), @ORM\Index(name="teamID", columns={"teamID"}), @ORM\Index(name="firmID", columns={"firmID"}), @ORM\Index(name="masterID", columns={"masterID", "userID"})})
 * @ORM\Entity
 */
class P17Tickets
{
    /**
     * @var int
     *
     * @ORM\Column(name="ticketID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ticketid;

    /**
     * @var int
     *
     * @ORM\Column(name="masterID", type="integer", nullable=false)
     */
    private $masterid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="integer", nullable=false)
     */
    private $userid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="teamID", type="integer", nullable=true)
     */
    private $teamid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="classID", type="integer", nullable=true)
     */
    private $classid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="division", type="string", length=2, nullable=false)
     */
    private $division;

    /**
     * @var int|null
     *
     * @ORM\Column(name="divisionID", type="integer", nullable=true)
     */
    private $divisionid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="workflowStatus", type="string", length=30, nullable=true)
     */
    private $workflowstatus;

    /**
     * @var int|null
     *
     * @ORM\Column(name="from_firmID", type="integer", nullable=true)
     */
    private $fromFirmid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="from_company", type="string", length=100, nullable=true)
     */
    private $fromCompany;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sender_company", type="string", length=50, nullable=true)
     */
    private $senderCompany;

    /**
     * @var string|null
     *
     * @ORM\Column(name="voucher", type="string", length=20, nullable=true)
     */
    private $voucher;

    /**
     * @var string|null
     *
     * @ORM\Column(name="voucherNoExternal", type="string", length=20, nullable=true)
     */
    private $vouchernoexternal;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="voucherDateExternal", type="date", nullable=true)
     */
    private $voucherdateexternal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="voucherNoInternal", type="string", length=20, nullable=true)
     */
    private $vouchernointernal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="voucherOpen", type="string", length=250, nullable=true)
     */
    private $voucheropen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="short_text", type="string", length=50, nullable=true)
     */
    private $shortText;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=0, nullable=true)
     */
    private $content;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text", type="text", length=0, nullable=true)
     */
    private $text;

    /**
     * @var int|null
     *
     * @ORM\Column(name="workflowID", type="integer", nullable=true)
     */
    private $workflowid;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="complete", type="datetime", nullable=true)
     */
    private $complete;

    /**
     * @var string|null
     *
     * @ORM\Column(name="user", type="string", length=25, nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="initiatorUser", type="string", length=50, nullable=false)
     */
    private $initiatoruser;

    /**
     * @var int|null
     *
     * @ORM\Column(name="prID", type="integer", nullable=true)
     */
    private $prid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="prUserID", type="integer", nullable=true)
     */
    private $pruserid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    public function getTicketid(): ?int
    {
        return $this->ticketid;
    }

    public function getMasterid(): ?int
    {
        return $this->masterid;
    }

    public function setMasterid(int $masterid): self
    {
        $this->masterid = $masterid;

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

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function setTeamid(?int $teamid): self
    {
        $this->teamid = $teamid;

        return $this;
    }

    public function getClassid(): ?int
    {
        return $this->classid;
    }

    public function setClassid(?int $classid): self
    {
        $this->classid = $classid;

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

    public function getDivisionid(): ?int
    {
        return $this->divisionid;
    }

    public function setDivisionid(?int $divisionid): self
    {
        $this->divisionid = $divisionid;

        return $this;
    }

    public function getWorkflowstatus(): ?string
    {
        return $this->workflowstatus;
    }

    public function setWorkflowstatus(?string $workflowstatus): self
    {
        $this->workflowstatus = $workflowstatus;

        return $this;
    }

    public function getFromFirmid(): ?int
    {
        return $this->fromFirmid;
    }

    public function setFromFirmid(?int $fromFirmid): self
    {
        $this->fromFirmid = $fromFirmid;

        return $this;
    }

    public function getFromCompany(): ?string
    {
        return $this->fromCompany;
    }

    public function setFromCompany(?string $fromCompany): self
    {
        $this->fromCompany = $fromCompany;

        return $this;
    }

    public function getSenderCompany(): ?string
    {
        return $this->senderCompany;
    }

    public function setSenderCompany(?string $senderCompany): self
    {
        $this->senderCompany = $senderCompany;

        return $this;
    }

    public function getVoucher(): ?string
    {
        return $this->voucher;
    }

    public function setVoucher(?string $voucher): self
    {
        $this->voucher = $voucher;

        return $this;
    }

    public function getVouchernoexternal(): ?string
    {
        return $this->vouchernoexternal;
    }

    public function setVouchernoexternal(?string $vouchernoexternal): self
    {
        $this->vouchernoexternal = $vouchernoexternal;

        return $this;
    }

    public function getVoucherdateexternal(): ?\DateTimeInterface
    {
        return $this->voucherdateexternal;
    }

    public function setVoucherdateexternal(?\DateTimeInterface $voucherdateexternal): self
    {
        $this->voucherdateexternal = $voucherdateexternal;

        return $this;
    }

    public function getVouchernointernal(): ?string
    {
        return $this->vouchernointernal;
    }

    public function setVouchernointernal(?string $vouchernointernal): self
    {
        $this->vouchernointernal = $vouchernointernal;

        return $this;
    }

    public function getVoucheropen(): ?string
    {
        return $this->voucheropen;
    }

    public function setVoucheropen(?string $voucheropen): self
    {
        $this->voucheropen = $voucheropen;

        return $this;
    }

    public function getShortText(): ?string
    {
        return $this->shortText;
    }

    public function setShortText(?string $shortText): self
    {
        $this->shortText = $shortText;

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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getWorkflowid(): ?int
    {
        return $this->workflowid;
    }

    public function setWorkflowid(?int $workflowid): self
    {
        $this->workflowid = $workflowid;

        return $this;
    }

    public function getComplete(): ?\DateTimeInterface
    {
        return $this->complete;
    }

    public function setComplete(?\DateTimeInterface $complete): self
    {
        $this->complete = $complete;

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

    public function setInitiatoruser(string $initiatoruser): self
    {
        $this->initiatoruser = $initiatoruser;

        return $this;
    }

    public function getPrid(): ?int
    {
        return $this->prid;
    }

    public function setPrid(?int $prid): self
    {
        $this->prid = $prid;

        return $this;
    }

    public function getPruserid(): ?int
    {
        return $this->pruserid;
    }

    public function setPruserid(?int $pruserid): self
    {
        $this->pruserid = $pruserid;

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
