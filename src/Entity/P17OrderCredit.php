<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17OrderCredit
 *
 * @ORM\Table(name="p17_order_credit", indexes={@ORM\Index(name="ticketID", columns={"ticketID"}), @ORM\Index(name="orderID", columns={"orderID"}), @ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17OrderCredit
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
     * @var string
     *
     * @ORM\Column(name="kind", type="string", length=1, nullable=false)
     */
    private $kind;

    /**
     * @var string
     *
     * @ORM\Column(name="creditNo", type="string", length=20, nullable=false)
     */
    private $creditno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creditDate", type="date", nullable=false)
     */
    private $creditdate;

    /**
     * @var string
     *
     * @ORM\Column(name="merchandiseNetVn", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $merchandisenetvn;

    /**
     * @var string
     *
     * @ORM\Column(name="merchandiseNetVr", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $merchandisenetvr;

    /**
     * @var string
     *
     * @ORM\Column(name="packageNetVn", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $packagenetvn;

    /**
     * @var string
     *
     * @ORM\Column(name="packageNetVr", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $packagenetvr;

    /**
     * @var string
     *
     * @ORM\Column(name="dispatchNetVn", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $dispatchnetvn;

    /**
     * @var string
     *
     * @ORM\Column(name="dispatchNetVr", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $dispatchnetvr;

    /**
     * @var string
     *
     * @ORM\Column(name="NetVn", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $netvn;

    /**
     * @var string
     *
     * @ORM\Column(name="NetVr", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $netvr;

    /**
     * @var string
     *
     * @ORM\Column(name="VATn", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $vatn;

    /**
     * @var string
     *
     * @ORM\Column(name="VATr", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $vatr;

    /**
     * @var string
     *
     * @ORM\Column(name="Gross", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $gross;

    /**
     * @var string
     *
     * @ORM\Column(name="tradeDiscount", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $tradediscount;

    /**
     * @var string
     *
     * @ORM\Column(name="creditAmount", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $creditamount;

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

    /**
     * @var \P17Orderbook
     *
     * @ORM\ManyToOne(targetEntity="P17Orderbook")
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

    public function getKind(): ?string
    {
        return $this->kind;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function getCreditno(): ?string
    {
        return $this->creditno;
    }

    public function setCreditno(string $creditno): self
    {
        $this->creditno = $creditno;

        return $this;
    }

    public function getCreditdate(): ?\DateTimeInterface
    {
        return $this->creditdate;
    }

    public function setCreditdate(\DateTimeInterface $creditdate): self
    {
        $this->creditdate = $creditdate;

        return $this;
    }

    public function getMerchandisenetvn()
    {
        return $this->merchandisenetvn;
    }

    public function setMerchandisenetvn($merchandisenetvn): self
    {
        $this->merchandisenetvn = $merchandisenetvn;

        return $this;
    }

    public function getMerchandisenetvr()
    {
        return $this->merchandisenetvr;
    }

    public function setMerchandisenetvr($merchandisenetvr): self
    {
        $this->merchandisenetvr = $merchandisenetvr;

        return $this;
    }

    public function getPackagenetvn()
    {
        return $this->packagenetvn;
    }

    public function setPackagenetvn($packagenetvn): self
    {
        $this->packagenetvn = $packagenetvn;

        return $this;
    }

    public function getPackagenetvr()
    {
        return $this->packagenetvr;
    }

    public function setPackagenetvr($packagenetvr): self
    {
        $this->packagenetvr = $packagenetvr;

        return $this;
    }

    public function getDispatchnetvn()
    {
        return $this->dispatchnetvn;
    }

    public function setDispatchnetvn($dispatchnetvn): self
    {
        $this->dispatchnetvn = $dispatchnetvn;

        return $this;
    }

    public function getDispatchnetvr()
    {
        return $this->dispatchnetvr;
    }

    public function setDispatchnetvr($dispatchnetvr): self
    {
        $this->dispatchnetvr = $dispatchnetvr;

        return $this;
    }

    public function getNetvn()
    {
        return $this->netvn;
    }

    public function setNetvn($netvn): self
    {
        $this->netvn = $netvn;

        return $this;
    }

    public function getNetvr()
    {
        return $this->netvr;
    }

    public function setNetvr($netvr): self
    {
        $this->netvr = $netvr;

        return $this;
    }

    public function getVatn()
    {
        return $this->vatn;
    }

    public function setVatn($vatn): self
    {
        $this->vatn = $vatn;

        return $this;
    }

    public function getVatr()
    {
        return $this->vatr;
    }

    public function setVatr($vatr): self
    {
        $this->vatr = $vatr;

        return $this;
    }

    public function getGross()
    {
        return $this->gross;
    }

    public function setGross($gross): self
    {
        $this->gross = $gross;

        return $this;
    }

    public function getTradediscount()
    {
        return $this->tradediscount;
    }

    public function setTradediscount($tradediscount): self
    {
        $this->tradediscount = $tradediscount;

        return $this;
    }

    public function getCreditamount()
    {
        return $this->creditamount;
    }

    public function setCreditamount($creditamount): self
    {
        $this->creditamount = $creditamount;

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

    public function getOrderid(): ?P17Orderbook
    {
        return $this->orderid;
    }

    public function setOrderid(?P17Orderbook $orderid): self
    {
        $this->orderid = $orderid;

        return $this;
    }


}
