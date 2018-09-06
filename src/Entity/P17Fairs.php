<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Fairs
 *
 * @ORM\Table(name="p17_fairs", indexes={@ORM\Index(name="firmID", columns={"firmID"}), @ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17Fairs
{
    /**
     * @var int
     *
     * @ORM\Column(name="fairID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fairid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFrom", type="date", nullable=false)
     */
    private $datefrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTo", type="date", nullable=false)
     */
    private $dateto;

    /**
     * @var string
     *
     * @ORM\Column(name="participation", type="string", length=1, nullable=false)
     */
    private $participation;

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
     * @var \P17Firms
     *
     * @ORM\ManyToOne(targetEntity="P17Firms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="firmID", referencedColumnName="firmID")
     * })
     */
    private $firmid;

    public function getFairid(): ?int
    {
        return $this->fairid;
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

    public function getDatefrom(): ?\DateTimeInterface
    {
        return $this->datefrom;
    }

    public function setDatefrom(\DateTimeInterface $datefrom): self
    {
        $this->datefrom = $datefrom;

        return $this;
    }

    public function getDateto(): ?\DateTimeInterface
    {
        return $this->dateto;
    }

    public function setDateto(\DateTimeInterface $dateto): self
    {
        $this->dateto = $dateto;

        return $this;
    }

    public function getParticipation(): ?string
    {
        return $this->participation;
    }

    public function setParticipation(string $participation): self
    {
        $this->participation = $participation;

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

    public function getFirmid(): ?P17Firms
    {
        return $this->firmid;
    }

    public function setFirmid(?P17Firms $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }


}
