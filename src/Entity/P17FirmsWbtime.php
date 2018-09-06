<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FirmsWbtime
 *
 * @ORM\Table(name="p17_firms_wbtime", indexes={@ORM\Index(name="firmID", columns={"firmID"})})
 * @ORM\Entity
 */
class P17FirmsWbtime
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
     * @ORM\Column(name="dow", type="integer", nullable=false)
     */
    private $dow = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="bt_from", type="string", length=5, nullable=false, options={"fixed"=true})
     */
    private $btFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="bt_to", type="string", length=5, nullable=false, options={"fixed"=true})
     */
    private $btTo;

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=10, nullable=false, options={"fixed"=true})
     */
    private $timezone;

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
     * @var \Firmenold
     *
     * @ORM\ManyToOne(targetEntity="Firmenold")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="firmID", referencedColumnName="firmenID")
     * })
     */
    private $firmid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDow(): ?int
    {
        return $this->dow;
    }

    public function setDow(int $dow): self
    {
        $this->dow = $dow;

        return $this;
    }

    public function getBtFrom(): ?string
    {
        return $this->btFrom;
    }

    public function setBtFrom(string $btFrom): self
    {
        $this->btFrom = $btFrom;

        return $this;
    }

    public function getBtTo(): ?string
    {
        return $this->btTo;
    }

    public function setBtTo(string $btTo): self
    {
        $this->btTo = $btTo;

        return $this;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;

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

    public function getFirmid(): ?Firmenold
    {
        return $this->firmid;
    }

    public function setFirmid(?Firmenold $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }


}
