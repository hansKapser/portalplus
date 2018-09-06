<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Hawali
 *
 * @ORM\Table(name="p17_hawali")
 * @ORM\Entity
 */
class P17Hawali
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
     * @var string
     *
     * @ORM\Column(name="lastOrderNo", type="string", length=20, nullable=false, options={"default"="0000-00-00 00000"})
     */
    private $lastorderno = '0000-00-00 00000';

    /**
     * @var string
     *
     * @ORM\Column(name="rebate", type="decimal", precision=10, scale=0, nullable=false, options={"default"="30"})
     */
    private $rebate = '30';

    /**
     * @var string
     *
     * @ORM\Column(name="rebateR", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $rebater = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="rebate_till", type="date", nullable=true)
     */
    private $rebateTill;

    /**
     * @var string
     *
     * @ORM\Column(name="minOrderValue", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $minordervalue = '0.00';

    /**
     * @var int
     *
     * @ORM\Column(name="termPayment", type="integer", nullable=false, options={"default"="1"})
     */
    private $termpayment = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="prepayment", type="boolean", nullable=false)
     */
    private $prepayment = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="deliveryDays", type="integer", nullable=false, options={"default"="1"})
     */
    private $deliverydays = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="carriageFree", type="decimal", precision=10, scale=0, nullable=false, options={"default"="500"})
     */
    private $carriagefree = '500';

    /**
     * @var string
     *
     * @ORM\Column(name="shippingCosts", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $shippingcosts = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="dispatch", type="string", length=250, nullable=false, options={"default"="LKW"})
     */
    private $dispatch = 'LKW';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dispatchstop_till", type="date", nullable=true)
     */
    private $dispatchstopTill;

    /**
     * @var string|null
     *
     * @ORM\Column(name="quality", type="text", length=65535, nullable=true)
     */
    private $quality;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=2, nullable=false, options={"default"="de"})
     */
    private $lang = 'de';

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

    public function getFirmid(): ?int
    {
        return $this->firmid;
    }

    public function setFirmid(int $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }

    public function getLastorderno(): ?string
    {
        return $this->lastorderno;
    }

    public function setLastorderno(string $lastorderno): self
    {
        $this->lastorderno = $lastorderno;

        return $this;
    }

    public function getRebate()
    {
        return $this->rebate;
    }

    public function setRebate($rebate): self
    {
        $this->rebate = $rebate;

        return $this;
    }

    public function getRebater()
    {
        return $this->rebater;
    }

    public function setRebater($rebater): self
    {
        $this->rebater = $rebater;

        return $this;
    }

    public function getRebateTill(): ?\DateTimeInterface
    {
        return $this->rebateTill;
    }

    public function setRebateTill(?\DateTimeInterface $rebateTill): self
    {
        $this->rebateTill = $rebateTill;

        return $this;
    }

    public function getMinordervalue()
    {
        return $this->minordervalue;
    }

    public function setMinordervalue($minordervalue): self
    {
        $this->minordervalue = $minordervalue;

        return $this;
    }

    public function getTermpayment(): ?int
    {
        return $this->termpayment;
    }

    public function setTermpayment(int $termpayment): self
    {
        $this->termpayment = $termpayment;

        return $this;
    }

    public function getPrepayment(): ?bool
    {
        return $this->prepayment;
    }

    public function setPrepayment(bool $prepayment): self
    {
        $this->prepayment = $prepayment;

        return $this;
    }

    public function getDeliverydays(): ?int
    {
        return $this->deliverydays;
    }

    public function setDeliverydays(int $deliverydays): self
    {
        $this->deliverydays = $deliverydays;

        return $this;
    }

    public function getCarriagefree()
    {
        return $this->carriagefree;
    }

    public function setCarriagefree($carriagefree): self
    {
        $this->carriagefree = $carriagefree;

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

    public function getDispatch(): ?string
    {
        return $this->dispatch;
    }

    public function setDispatch(string $dispatch): self
    {
        $this->dispatch = $dispatch;

        return $this;
    }

    public function getDispatchstopTill(): ?\DateTimeInterface
    {
        return $this->dispatchstopTill;
    }

    public function setDispatchstopTill(?\DateTimeInterface $dispatchstopTill): self
    {
        $this->dispatchstopTill = $dispatchstopTill;

        return $this;
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setQuality(?string $quality): self
    {
        $this->quality = $quality;

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
