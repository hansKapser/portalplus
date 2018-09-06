<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17ExamOrderPurchase
 *
 * @ORM\Table(name="p17_exam_order_purchase", indexes={@ORM\Index(name="ticketID", columns={"ticketID"})})
 * @ORM\Entity
 */
class P17ExamOrderPurchase
{
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
     * @var int
     *
     * @ORM\Column(name="projectID", type="integer", nullable=false)
     */
    private $projectid;

    /**
     * @var string
     *
     * @ORM\Column(name="purchaseNo", type="string", length=25, nullable=false)
     */
    private $purchaseno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchaseDate", type="date", nullable=false)
     */
    private $purchasedate;

    /**
     * @var bool
     *
     * @ORM\Column(name="week", type="boolean", nullable=false)
     */
    private $week;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", length=2, nullable=false)
     */
    private $reason;

    /**
     * @var string
     *
     * @ORM\Column(name="basisPrice", type="string", length=2, nullable=false)
     */
    private $basisprice;

    /**
     * @var string
     *
     * @ORM\Column(name="offerNo", type="string", length=20, nullable=false)
     */
    private $offerno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="offerDate", type="date", nullable=false)
     */
    private $offerdate;

    /**
     * @var string
     *
     * @ORM\Column(name="deliveryCondition", type="string", length=10, nullable=false)
     */
    private $deliverycondition;

    /**
     * @var string
     *
     * @ORM\Column(name="shippingCosts", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $shippingcosts;

    /**
     * @var string
     *
     * @ORM\Column(name="packingCost", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $packingcost;

    /**
     * @var bool
     *
     * @ORM\Column(name="termPayment", type="boolean", nullable=false)
     */
    private $termpayment;

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

    public function getProjectid(): ?int
    {
        return $this->projectid;
    }

    public function setProjectid(int $projectid): self
    {
        $this->projectid = $projectid;

        return $this;
    }

    public function getPurchaseno(): ?string
    {
        return $this->purchaseno;
    }

    public function setPurchaseno(string $purchaseno): self
    {
        $this->purchaseno = $purchaseno;

        return $this;
    }

    public function getPurchasedate(): ?\DateTimeInterface
    {
        return $this->purchasedate;
    }

    public function setPurchasedate(\DateTimeInterface $purchasedate): self
    {
        $this->purchasedate = $purchasedate;

        return $this;
    }

    public function getWeek(): ?bool
    {
        return $this->week;
    }

    public function setWeek(bool $week): self
    {
        $this->week = $week;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

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

    public function setOfferno(string $offerno): self
    {
        $this->offerno = $offerno;

        return $this;
    }

    public function getOfferdate(): ?\DateTimeInterface
    {
        return $this->offerdate;
    }

    public function setOfferdate(\DateTimeInterface $offerdate): self
    {
        $this->offerdate = $offerdate;

        return $this;
    }

    public function getDeliverycondition(): ?string
    {
        return $this->deliverycondition;
    }

    public function setDeliverycondition(string $deliverycondition): self
    {
        $this->deliverycondition = $deliverycondition;

        return $this;
    }

    public function getShippingcosts()
    {
        return $this->shippingcosts;
    }

    public function setShippingcosts($shippingcosts): self
    {
        $this->shippingcosts = $shippingcosts;

        return $this;
    }

    public function getPackingcost()
    {
        return $this->packingcost;
    }

    public function setPackingcost($packingcost): self
    {
        $this->packingcost = $packingcost;

        return $this;
    }

    public function getTermpayment(): ?bool
    {
        return $this->termpayment;
    }

    public function setTermpayment(bool $termpayment): self
    {
        $this->termpayment = $termpayment;

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
