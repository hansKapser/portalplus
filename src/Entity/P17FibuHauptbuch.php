<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FibuHauptbuch
 *
 * @ORM\Table(name="p17_fibu_hauptbuch", indexes={@ORM\Index(name="journalID", columns={"journalID"}), @ORM\Index(name="mandantID", columns={"mandantID"}), @ORM\Index(name="examUserID", columns={"examUserID"}), @ORM\Index(name="firmID", columns={"firmID"})})
 * @ORM\Entity
 */
class P17FibuHauptbuch
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
     * @ORM\Column(name="mandantID", type="integer", nullable=false)
     */
    private $mandantid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datum", type="date", nullable=true)
     */
    private $datum;

    /**
     * @var int
     *
     * @ORM\Column(name="journalID", type="integer", nullable=false)
     */
    private $journalid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="konto", type="string", length=6, nullable=false)
     */
    private $konto = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="soll", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $soll = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="haben", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $haben = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="UStID", type="string", length=30, nullable=false)
     */
    private $ustid;

    /**
     * @var bool
     *
     * @ORM\Column(name="steuerzeile", type="boolean", nullable=false)
     */
    private $steuerzeile = '0';

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMandantid(): ?int
    {
        return $this->mandantid;
    }

    public function setMandantid(int $mandantid): self
    {
        $this->mandantid = $mandantid;

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

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(?\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getJournalid(): ?int
    {
        return $this->journalid;
    }

    public function setJournalid(int $journalid): self
    {
        $this->journalid = $journalid;

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

    public function getSoll()
    {
        return $this->soll;
    }

    public function setSoll($soll): self
    {
        $this->soll = $soll;

        return $this;
    }

    public function getHaben()
    {
        return $this->haben;
    }

    public function setHaben($haben): self
    {
        $this->haben = $haben;

        return $this;
    }

    public function getUstid(): ?string
    {
        return $this->ustid;
    }

    public function setUstid(string $ustid): self
    {
        $this->ustid = $ustid;

        return $this;
    }

    public function getSteuerzeile(): ?bool
    {
        return $this->steuerzeile;
    }

    public function setSteuerzeile(bool $steuerzeile): self
    {
        $this->steuerzeile = $steuerzeile;

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


}
