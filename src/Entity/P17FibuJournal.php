<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FibuJournal
 *
 * @ORM\Table(name="p17_fibu_journal", indexes={@ORM\Index(name="journalID", columns={"journalID"}), @ORM\Index(name="examUserID", columns={"examUserID"}), @ORM\Index(name="mandantID", columns={"mandantID"}), @ORM\Index(name="firmID", columns={"firmID"})})
 * @ORM\Entity
 */
class P17FibuJournal
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
     * @var int|null
     *
     * @ORM\Column(name="firmID", type="integer", nullable=true)
     */
    private $firmid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ba", type="string", length=2, nullable=false, options={"fixed"=true})
     */
    private $ba = '';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datum", type="date", nullable=true)
     */
    private $datum;

    /**
     * @var string
     *
     * @ORM\Column(name="soll", type="string", length=6, nullable=false)
     */
    private $soll = '';

    /**
     * @var string
     *
     * @ORM\Column(name="haben", type="string", length=6, nullable=false)
     */
    private $haben = '';

    /**
     * @var string
     *
     * @ORM\Column(name="BN", type="string", length=1, nullable=false, options={"default"="B"})
     */
    private $bn = 'B';

    /**
     * @var string
     *
     * @ORM\Column(name="betrag", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $betrag = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="skontobetrag", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $skontobetrag = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="steuerkennzeichen", type="string", length=1, nullable=false, options={"fixed"=true})
     */
    private $steuerkennzeichen = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="steuerzeile", type="boolean", nullable=false)
     */
    private $steuerzeile = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="UStID", type="string", length=30, nullable=true)
     */
    private $ustid;

    /**
     * @var string
     *
     * @ORM\Column(name="beleg", type="string", length=15, nullable=false)
     */
    private $beleg = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="text", type="string", length=27, nullable=true)
     */
    private $text;

    /**
     * @var string|null
     *
     * @ORM\Column(name="user", type="string", length=20, nullable=true)
     */
    private $user;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="erfassungsdatum", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $erfassungsdatum = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fixiert_datum", type="date", nullable=true)
     */
    private $fixiertDatum;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fixiert_user", type="string", length=20, nullable=true)
     */
    private $fixiertUser;

    /**
     * @var int|null
     *
     * @ORM\Column(name="userID", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="examUserID", type="integer", nullable=true)
     */
    private $examuserid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var \P17FibuJournalid
     *
     * @ORM\ManyToOne(targetEntity="P17FibuJournalid")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="journalID", referencedColumnName="journalID")
     * })
     */
    private $journalid;

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

    public function setFirmid(?int $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }

    public function getBa(): ?string
    {
        return $this->ba;
    }

    public function setBa(string $ba): self
    {
        $this->ba = $ba;

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

    public function getSoll(): ?string
    {
        return $this->soll;
    }

    public function setSoll(string $soll): self
    {
        $this->soll = $soll;

        return $this;
    }

    public function getHaben(): ?string
    {
        return $this->haben;
    }

    public function setHaben(string $haben): self
    {
        $this->haben = $haben;

        return $this;
    }

    public function getBn(): ?string
    {
        return $this->bn;
    }

    public function setBn(string $bn): self
    {
        $this->bn = $bn;

        return $this;
    }

    public function getBetrag()
    {
        return $this->betrag;
    }

    public function setBetrag($betrag): self
    {
        $this->betrag = $betrag;

        return $this;
    }

    public function getSkontobetrag()
    {
        return $this->skontobetrag;
    }

    public function setSkontobetrag($skontobetrag): self
    {
        $this->skontobetrag = $skontobetrag;

        return $this;
    }

    public function getSteuerkennzeichen(): ?string
    {
        return $this->steuerkennzeichen;
    }

    public function setSteuerkennzeichen(string $steuerkennzeichen): self
    {
        $this->steuerkennzeichen = $steuerkennzeichen;

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

    public function getUstid(): ?string
    {
        return $this->ustid;
    }

    public function setUstid(?string $ustid): self
    {
        $this->ustid = $ustid;

        return $this;
    }

    public function getBeleg(): ?string
    {
        return $this->beleg;
    }

    public function setBeleg(string $beleg): self
    {
        $this->beleg = $beleg;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(?string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getErfassungsdatum(): ?\DateTimeInterface
    {
        return $this->erfassungsdatum;
    }

    public function setErfassungsdatum(?\DateTimeInterface $erfassungsdatum): self
    {
        $this->erfassungsdatum = $erfassungsdatum;

        return $this;
    }

    public function getFixiertDatum(): ?\DateTimeInterface
    {
        return $this->fixiertDatum;
    }

    public function setFixiertDatum(?\DateTimeInterface $fixiertDatum): self
    {
        $this->fixiertDatum = $fixiertDatum;

        return $this;
    }

    public function getFixiertUser(): ?string
    {
        return $this->fixiertUser;
    }

    public function setFixiertUser(?string $fixiertUser): self
    {
        $this->fixiertUser = $fixiertUser;

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

    public function getExamuserid(): ?int
    {
        return $this->examuserid;
    }

    public function setExamuserid(?int $examuserid): self
    {
        $this->examuserid = $examuserid;

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

    public function getJournalid(): ?P17FibuJournalid
    {
        return $this->journalid;
    }

    public function setJournalid(?P17FibuJournalid $journalid): self
    {
        $this->journalid = $journalid;

        return $this;
    }


}
