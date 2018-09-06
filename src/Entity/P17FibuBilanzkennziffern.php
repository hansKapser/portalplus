<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FibuBilanzkennziffern
 *
 * @ORM\Table(name="p17_fibu_bilanzkennziffern")
 * @ORM\Entity
 */
class P17FibuBilanzkennziffern
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
     * @var string
     *
     * @ORM\Column(name="BKZ", type="string", length=4, nullable=false)
     */
    private $bkz = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bezeichnung", type="string", length=100, nullable=false)
     */
    private $bezeichnung = '';

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

    public function getBkz(): ?string
    {
        return $this->bkz;
    }

    public function setBkz(string $bkz): self
    {
        $this->bkz = $bkz;

        return $this;
    }

    public function getBezeichnung(): ?string
    {
        return $this->bezeichnung;
    }

    public function setBezeichnung(string $bezeichnung): self
    {
        $this->bezeichnung = $bezeichnung;

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
