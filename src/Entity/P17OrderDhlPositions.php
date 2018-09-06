<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17OrderDhlPositions
 *
 * @ORM\Table(name="p17_order_DHL_positions", indexes={@ORM\Index(name="orderID", columns={"orderID"}), @ORM\Index(name="DHL_id", columns={"DHL_id"}), @ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17OrderDhlPositions
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
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

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
     * @var \P17Orderbook
     *
     * @ORM\ManyToOne(targetEntity="P17Orderbook")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="orderID", referencedColumnName="orderID")
     * })
     */
    private $orderid;

    /**
     * @var \P17PostFees
     *
     * @ORM\ManyToOne(targetEntity="P17PostFees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DHL_id", referencedColumnName="id")
     * })
     */
    private $dhl;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOrderid(): ?P17Orderbook
    {
        return $this->orderid;
    }

    public function setOrderid(?P17Orderbook $orderid): self
    {
        $this->orderid = $orderid;

        return $this;
    }

    public function getDhl(): ?P17PostFees
    {
        return $this->dhl;
    }

    public function setDhl(?P17PostFees $dhl): self
    {
        $this->dhl = $dhl;

        return $this;
    }


}
