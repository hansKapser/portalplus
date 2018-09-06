<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FibuAssets
 *
 * @ORM\Table(name="p17_fibu_assets", indexes={@ORM\Index(name="ticketID", columns={"ticketID"}), @ORM\Index(name="firmID", columns={"firmID"}), @ORM\Index(name="positionID", columns={"positionID"}), @ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17FibuAssets
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var int
     *
     * @ORM\Column(name="ticketID", type="integer", nullable=false)
     */
    private $ticketid;

    /**
     * @var string
     *
     * @ORM\Column(name="account", type="string", length=4, nullable=false)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="acquisitionDate", type="date", nullable=false)
     */
    private $acquisitiondate;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="targetPrice", type="integer", nullable=false)
     */
    private $targetprice;

    /**
     * @var int
     *
     * @ORM\Column(name="incidentalCost", type="integer", nullable=false)
     */
    private $incidentalcost;

    /**
     * @var int
     *
     * @ORM\Column(name="reductionCost", type="integer", nullable=false)
     */
    private $reductioncost;

    /**
     * @var int
     *
     * @ORM\Column(name="costValue", type="integer", nullable=false)
     */
    private $costvalue;

    /**
     * @var int
     *
     * @ORM\Column(name="lifetime", type="integer", nullable=false)
     */
    private $lifetime;

    /**
     * @var string
     *
     * @ORM\Column(name="method", type="string", length=10, nullable=false)
     */
    private $method;

    /**
     * @var int
     *
     * @ORM\Column(name="depreciation", type="integer", nullable=false)
     */
    private $depreciation;

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
     * @var \P17PurchasePositions
     *
     * @ORM\ManyToOne(targetEntity="P17PurchasePositions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="positionID", referencedColumnName="id")
     * })
     */
    private $positionid;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTicketid(): ?int
    {
        return $this->ticketid;
    }

    public function setTicketid(int $ticketid): self
    {
        $this->ticketid = $ticketid;

        return $this;
    }

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function setAccount(string $account): self
    {
        $this->account = $account;

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

    public function getAcquisitiondate(): ?\DateTimeInterface
    {
        return $this->acquisitiondate;
    }

    public function setAcquisitiondate(\DateTimeInterface $acquisitiondate): self
    {
        $this->acquisitiondate = $acquisitiondate;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTargetprice(): ?int
    {
        return $this->targetprice;
    }

    public function setTargetprice(int $targetprice): self
    {
        $this->targetprice = $targetprice;

        return $this;
    }

    public function getIncidentalcost(): ?int
    {
        return $this->incidentalcost;
    }

    public function setIncidentalcost(int $incidentalcost): self
    {
        $this->incidentalcost = $incidentalcost;

        return $this;
    }

    public function getReductioncost(): ?int
    {
        return $this->reductioncost;
    }

    public function setReductioncost(int $reductioncost): self
    {
        $this->reductioncost = $reductioncost;

        return $this;
    }

    public function getCostvalue(): ?int
    {
        return $this->costvalue;
    }

    public function setCostvalue(int $costvalue): self
    {
        $this->costvalue = $costvalue;

        return $this;
    }

    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    public function setLifetime(int $lifetime): self
    {
        $this->lifetime = $lifetime;

        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getDepreciation(): ?int
    {
        return $this->depreciation;
    }

    public function setDepreciation(int $depreciation): self
    {
        $this->depreciation = $depreciation;

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

    public function getPositionid(): ?P17PurchasePositions
    {
        return $this->positionid;
    }

    public function setPositionid(?P17PurchasePositions $positionid): self
    {
        $this->positionid = $positionid;

        return $this;
    }


}
