<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17StockOthers
 *
 * @ORM\Table(name="p17_stock_others", indexes={@ORM\Index(name="date", columns={"date"}), @ORM\Index(name="ticketID", columns={"ticketID"}), @ORM\Index(name="positionID", columns={"positionID"}), @ORM\Index(name="orderID", columns={"orderID"}), @ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17StockOthers
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
     * @var int
     *
     * @ORM\Column(name="ticketID", type="integer", nullable=false)
     */
    private $ticketid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="use_month", type="integer", nullable=false)
     */
    private $useMonth;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="rest", type="decimal", precision=7, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $rest = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="user", type="string", length=30, nullable=true)
     */
    private $user;

    /**
     * @var int|null
     *
     * @ORM\Column(name="examUserID", type="integer", nullable=true)
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

    /**
     * @var \P17Purchasebook
     *
     * @ORM\ManyToOne(targetEntity="P17Purchasebook")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="orderID", referencedColumnName="orderID")
     * })
     */
    private $orderid;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUseMonth(): ?int
    {
        return $this->useMonth;
    }

    public function setUseMonth(int $useMonth): self
    {
        $this->useMonth = $useMonth;

        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

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

    public function getRest()
    {
        return $this->rest;
    }

    public function setRest($rest): self
    {
        $this->rest = $rest;

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

    public function getExamuserid(): ?int
    {
        return $this->examuserid;
    }

    public function setExamuserid(?int $examuserid): self
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

    public function getOrderid(): ?P17Purchasebook
    {
        return $this->orderid;
    }

    public function setOrderid(?P17Purchasebook $orderid): self
    {
        $this->orderid = $orderid;

        return $this;
    }


}
