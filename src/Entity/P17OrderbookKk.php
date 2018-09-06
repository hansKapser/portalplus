<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17OrderbookKk
 *
 * @ORM\Table(name="p17_orderbook_KK", indexes={@ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17OrderbookKk
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
     * @var string
     *
     * @ORM\Column(name="voucherNo", type="string", length=20, nullable=false)
     */
    private $voucherno;

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var int
     *
     * @ORM\Column(name="customer_firmID", type="integer", nullable=false, options={"default"="5"})
     */
    private $customerFirmid = '5';

    /**
     * @var string
     *
     * @ORM\Column(name="customer_company", type="string", length=50, nullable=false)
     */
    private $customerCompany;

    /**
     * @var int
     *
     * @ORM\Column(name="KKID", type="integer", nullable=false, options={"default"="5"})
     */
    private $kkid = '5';

    /**
     * @var string
     *
     * @ORM\Column(name="orderNo", type="string", length=25, nullable=false)
     */
    private $orderno;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="week", type="boolean", nullable=false)
     */
    private $week;

    /**
     * @var bool
     *
     * @ORM\Column(name="personalize", type="boolean", nullable=false)
     */
    private $personalize;

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
     * @ORM\Column(name="offerNo", type="string", length=25, nullable=false)
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
     * @ORM\Column(name="sum_weight", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $sumWeight;

    /**
     * @var int
     *
     * @ORM\Column(name="km", type="integer", nullable=false)
     */
    private $km;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dispatchDate", type="date", nullable=false)
     */
    private $dispatchdate;

    /**
     * @var string
     *
     * @ORM\Column(name="dispatch", type="string", length=10, nullable=false)
     */
    private $dispatch;

    /**
     * @var string
     *
     * @ORM\Column(name="postNumberReceiver", type="string", length=30, nullable=false)
     */
    private $postnumberreceiver;

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
     * @var \DateTime
     *
     * @ORM\Column(name="receiptDate", type="date", nullable=false)
     */
    private $receiptdate;

    /**
     * @var bool
     *
     * @ORM\Column(name="termPayment", type="boolean", nullable=false)
     */
    private $termpayment;

    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="integer", nullable=false)
     */
    private $userid;

    /**
     * @var int
     *
     * @ORM\Column(name="teamID", type="integer", nullable=false)
     */
    private $teamid;

    /**
     * @var int
     *
     * @ORM\Column(name="classID", type="integer", nullable=false)
     */
    private $classid;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=25, nullable=false)
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="examUserID", type="integer", nullable=false)
     */
    private $examuserid;

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

    public function getVoucherno(): ?string
    {
        return $this->voucherno;
    }

    public function setVoucherno(string $voucherno): self
    {
        $this->voucherno = $voucherno;

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

    public function getKkid(): ?int
    {
        return $this->kkid;
    }

    public function setKkid(int $kkid): self
    {
        $this->kkid = $kkid;

        return $this;
    }

    public function getOrderno(): ?string
    {
        return $this->orderno;
    }

    public function setOrderno(string $orderno): self
    {
        $this->orderno = $orderno;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getPersonalize(): ?bool
    {
        return $this->personalize;
    }

    public function setPersonalize(bool $personalize): self
    {
        $this->personalize = $personalize;

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

    public function getSumWeight()
    {
        return $this->sumWeight;
    }

    public function setSumWeight($sumWeight): self
    {
        $this->sumWeight = $sumWeight;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getDispatchdate(): ?\DateTimeInterface
    {
        return $this->dispatchdate;
    }

    public function setDispatchdate(\DateTimeInterface $dispatchdate): self
    {
        $this->dispatchdate = $dispatchdate;

        return $this;
    }

    public function getDispatch(): ?string
    {
        return $this->dispatch;
    }

    public function setDispatch(string $dispatch): self
    {
        $this->dispatch = $dispatch;

        return $this;
    }

    public function getPostnumberreceiver(): ?string
    {
        return $this->postnumberreceiver;
    }

    public function setPostnumberreceiver(string $postnumberreceiver): self
    {
        $this->postnumberreceiver = $postnumberreceiver;

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

    public function getReceiptdate(): ?\DateTimeInterface
    {
        return $this->receiptdate;
    }

    public function setReceiptdate(\DateTimeInterface $receiptdate): self
    {
        $this->receiptdate = $receiptdate;

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

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

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

    public function getClassid(): ?int
    {
        return $this->classid;
    }

    public function setClassid(int $classid): self
    {
        $this->classid = $classid;

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
