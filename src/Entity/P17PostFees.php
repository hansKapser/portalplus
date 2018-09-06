<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17PostFees
 *
 * @ORM\Table(name="p17_post_fees")
 * @ORM\Entity
 */
class P17PostFees
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="weight_from", type="integer", nullable=false)
     */
    private $weightFrom = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="weight_to", type="integer", nullable=false)
     */
    private $weightTo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=8, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $price = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="memo", type="text", length=65535, nullable=false)
     */
    private $memo;

    /**
     * @var string
     *
     * @ORM\Column(name="formel", type="string", length=200, nullable=false)
     */
    private $formel;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    public function getWeightFrom(): ?int
    {
        return $this->weightFrom;
    }

    public function setWeightFrom(int $weightFrom): self
    {
        $this->weightFrom = $weightFrom;

        return $this;
    }

    public function getWeightTo(): ?int
    {
        return $this->weightTo;
    }

    public function setWeightTo(int $weightTo): self
    {
        $this->weightTo = $weightTo;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    public function getFormel(): ?string
    {
        return $this->formel;
    }

    public function setFormel(string $formel): self
    {
        $this->formel = $formel;

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
