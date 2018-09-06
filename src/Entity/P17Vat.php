<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Vat
 *
 * @ORM\Table(name="p17_vat", uniqueConstraints={@ORM\UniqueConstraint(name="vat_id", columns={"vat_id"})})
 * @ORM\Entity
 */
class P17Vat
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="vat_id", type="boolean", nullable=false)
     */
    private $vatId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="percentage", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $percentage;

    /**
     * @var string
     *
     * @ORM\Column(name="UV", type="string", length=1, nullable=false)
     */
    private $uv;

    /**
     * @var string
     *
     * @ORM\Column(name="konto", type="string", length=4, nullable=false)
     */
    private $konto;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getVatId(): ?bool
    {
        return $this->vatId;
    }

    public function setVatId(bool $vatId): self
    {
        $this->vatId = $vatId;

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

    public function getPercentage()
    {
        return $this->percentage;
    }

    public function setPercentage($percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function getUv(): ?string
    {
        return $this->uv;
    }

    public function setUv(string $uv): self
    {
        $this->uv = $uv;

        return $this;
    }

    public function getKonto(): ?string
    {
        return $this->konto;
    }

    public function setKonto(string $konto): self
    {
        $this->konto = $konto;

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
