<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17TermsOfPayment
 *
 * @ORM\Table(name="p17_terms_of_payment")
 * @ORM\Entity
 */
class P17TermsOfPayment
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
     * @ORM\Column(name="discount_days", type="integer", nullable=false)
     */
    private $discountDays;

    /**
     * @var bool
     *
     * @ORM\Column(name="discount", type="boolean", nullable=false)
     */
    private $discount;

    /**
     * @var int
     *
     * @ORM\Column(name="net_days", type="integer", nullable=false)
     */
    private $netDays;

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

    public function getDiscountDays(): ?int
    {
        return $this->discountDays;
    }

    public function setDiscountDays(int $discountDays): self
    {
        $this->discountDays = $discountDays;

        return $this;
    }

    public function getDiscount(): ?bool
    {
        return $this->discount;
    }

    public function setDiscount(bool $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getNetDays(): ?int
    {
        return $this->netDays;
    }

    public function setNetDays(int $netDays): self
    {
        $this->netDays = $netDays;

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
