<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FirmsNumbers
 *
 * @ORM\Table(name="p17_firms_numbers", uniqueConstraints={@ORM\UniqueConstraint(name="firmID_2", columns={"firmID", "firmIDpartner"})}, indexes={@ORM\Index(name="firmID", columns={"firmID"}), @ORM\Index(name="firmIDpartner", columns={"firmIDpartner"}), @ORM\Index(name="termPayment", columns={"termPayment"})})
 * @ORM\Entity
 */
class P17FirmsNumbers
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
     * @ORM\Column(name="debitor", type="integer", nullable=false)
     */
    private $debitor;

    /**
     * @var int
     *
     * @ORM\Column(name="creditor", type="integer", nullable=false)
     */
    private $creditor;

    /**
     * @var string
     *
     * @ORM\Column(name="minOrderValue", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $minordervalue;

    /**
     * @var string
     *
     * @ORM\Column(name="carriageFree", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $carriagefree;

    /**
     * @var string
     *
     * @ORM\Column(name="rebate", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $rebate;

    /**
     * @var string
     *
     * @ORM\Column(name="C_rating", type="string", length=3, nullable=false)
     */
    private $cRating;

    /**
     * @var string
     *
     * @ORM\Column(name="D_rating", type="string", length=3, nullable=false)
     */
    private $dRating;

    /**
     * @var bool
     *
     * @ORM\Column(name="prepayment", type="boolean", nullable=false)
     */
    private $prepayment;

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
     * @var \P17Firms
     *
     * @ORM\ManyToOne(targetEntity="P17Firms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="firmID", referencedColumnName="firmID")
     * })
     */
    private $firmid;

    /**
     * @var \P17Firms
     *
     * @ORM\ManyToOne(targetEntity="P17Firms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="firmIDpartner", referencedColumnName="firmID")
     * })
     */
    private $firmidpartner;

    /**
     * @var \P17TermsOfPayment
     *
     * @ORM\ManyToOne(targetEntity="P17TermsOfPayment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="termPayment", referencedColumnName="id")
     * })
     */
    private $termpayment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebitor(): ?int
    {
        return $this->debitor;
    }

    public function setDebitor(int $debitor): self
    {
        $this->debitor = $debitor;

        return $this;
    }

    public function getCreditor(): ?int
    {
        return $this->creditor;
    }

    public function setCreditor(int $creditor): self
    {
        $this->creditor = $creditor;

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

    public function getCarriagefree()
    {
        return $this->carriagefree;
    }

    public function setCarriagefree($carriagefree): self
    {
        $this->carriagefree = $carriagefree;

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

    public function getCRating(): ?string
    {
        return $this->cRating;
    }

    public function setCRating(string $cRating): self
    {
        $this->cRating = $cRating;

        return $this;
    }

    public function getDRating(): ?string
    {
        return $this->dRating;
    }

    public function setDRating(string $dRating): self
    {
        $this->dRating = $dRating;

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

    public function getFirmid(): ?P17Firms
    {
        return $this->firmid;
    }

    public function setFirmid(?P17Firms $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }

    public function getFirmidpartner(): ?P17Firms
    {
        return $this->firmidpartner;
    }

    public function setFirmidpartner(?P17Firms $firmidpartner): self
    {
        $this->firmidpartner = $firmidpartner;

        return $this;
    }

    public function getTermpayment(): ?P17TermsOfPayment
    {
        return $this->termpayment;
    }

    public function setTermpayment(?P17TermsOfPayment $termpayment): self
    {
        $this->termpayment = $termpayment;

        return $this;
    }


}
