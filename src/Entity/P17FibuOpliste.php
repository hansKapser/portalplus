<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FibuOpliste
 *
 * @ORM\Table(name="p17_fibu_opliste", indexes={@ORM\Index(name="ticketID", columns={"ticketID"}), @ORM\Index(name="examUserID", columns={"examUserID"}), @ORM\Index(name="journalID", columns={"journalID"}), @ORM\Index(name="firmID", columns={"firmID"})})
 * @ORM\Entity
 */
class P17FibuOpliste
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
    private $firmid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="ticketID", type="integer", nullable=false)
     */
    private $ticketid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ausgleich_journalID", type="string", length=50, nullable=true)
     */
    private $ausgleichJournalid;

    /**
     * @var string
     *
     * @ORM\Column(name="ba", type="string", length=2, nullable=false, options={"fixed"=true})
     */
    private $ba = '';

    /**
     * @var string
     *
     * @ORM\Column(name="op_nummer", type="string", length=15, nullable=false)
     */
    private $opNummer = '';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datum", type="date", nullable=true)
     */
    private $datum;

    /**
     * @var int
     *
     * @ORM\Column(name="kontonummer", type="integer", nullable=false)
     */
    private $kontonummer = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="betrag", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $betrag = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="UStID", type="string", length=30, nullable=true)
     */
    private $ustid;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="faellig", type="date", nullable=true)
     */
    private $faellig;

    /**
     * @var int
     *
     * @ORM\Column(name="skontotage", type="integer", nullable=false)
     */
    private $skontotage = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="skontoprozent", type="decimal", precision=5, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $skontoprozent = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="skontobetrag", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $skontobetrag = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="ausgleichbetrag", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $ausgleichbetrag = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="nettotage", type="integer", nullable=true)
     */
    private $nettotage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="erfassungsdatum", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $erfassungsdatum = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=20, nullable=false)
     */
    private $user = '';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="bezahlt", type="date", nullable=true)
     */
    private $bezahlt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="M0_datum", type="date", nullable=true)
     */
    private $m0Datum;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="M1_datum", type="date", nullable=true)
     */
    private $m1Datum;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="M2_datum", type="date", nullable=true)
     */
    private $m2Datum;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="M3_datum", type="date", nullable=true)
     */
    private $m3Datum;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="M0_erfolgt", type="date", nullable=true)
     */
    private $m0Erfolgt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="M1_erfolgt", type="date", nullable=true)
     */
    private $m1Erfolgt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="M2_erfolgt", type="date", nullable=true)
     */
    private $m2Erfolgt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="M3_erfolgt", type="date", nullable=true)
     */
    private $m3Erfolgt;

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

    public function setFirmid(int $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }

    public function getTicketid(): ?int
    {
        return $this->ticketid;
    }

    public function setTicketid(int $ticketid): self
    {
        $this->ticketid = $ticketid;

        return $this;
    }

    public function getAusgleichJournalid(): ?string
    {
        return $this->ausgleichJournalid;
    }

    public function setAusgleichJournalid(?string $ausgleichJournalid): self
    {
        $this->ausgleichJournalid = $ausgleichJournalid;

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

    public function getOpNummer(): ?string
    {
        return $this->opNummer;
    }

    public function setOpNummer(string $opNummer): self
    {
        $this->opNummer = $opNummer;

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

    public function getKontonummer(): ?int
    {
        return $this->kontonummer;
    }

    public function setKontonummer(int $kontonummer): self
    {
        $this->kontonummer = $kontonummer;

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

    public function getUstid(): ?string
    {
        return $this->ustid;
    }

    public function setUstid(?string $ustid): self
    {
        $this->ustid = $ustid;

        return $this;
    }

    public function getFaellig(): ?\DateTimeInterface
    {
        return $this->faellig;
    }

    public function setFaellig(?\DateTimeInterface $faellig): self
    {
        $this->faellig = $faellig;

        return $this;
    }

    public function getSkontotage(): ?int
    {
        return $this->skontotage;
    }

    public function setSkontotage(int $skontotage): self
    {
        $this->skontotage = $skontotage;

        return $this;
    }

    public function getSkontoprozent()
    {
        return $this->skontoprozent;
    }

    public function setSkontoprozent($skontoprozent): self
    {
        $this->skontoprozent = $skontoprozent;

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

    public function getAusgleichbetrag()
    {
        return $this->ausgleichbetrag;
    }

    public function setAusgleichbetrag($ausgleichbetrag): self
    {
        $this->ausgleichbetrag = $ausgleichbetrag;

        return $this;
    }

    public function getNettotage(): ?int
    {
        return $this->nettotage;
    }

    public function setNettotage(?int $nettotage): self
    {
        $this->nettotage = $nettotage;

        return $this;
    }

    public function getErfassungsdatum(): ?\DateTimeInterface
    {
        return $this->erfassungsdatum;
    }

    public function setErfassungsdatum(\DateTimeInterface $erfassungsdatum): self
    {
        $this->erfassungsdatum = $erfassungsdatum;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBezahlt(): ?\DateTimeInterface
    {
        return $this->bezahlt;
    }

    public function setBezahlt(?\DateTimeInterface $bezahlt): self
    {
        $this->bezahlt = $bezahlt;

        return $this;
    }

    public function getM0Datum(): ?\DateTimeInterface
    {
        return $this->m0Datum;
    }

    public function setM0Datum(?\DateTimeInterface $m0Datum): self
    {
        $this->m0Datum = $m0Datum;

        return $this;
    }

    public function getM1Datum(): ?\DateTimeInterface
    {
        return $this->m1Datum;
    }

    public function setM1Datum(?\DateTimeInterface $m1Datum): self
    {
        $this->m1Datum = $m1Datum;

        return $this;
    }

    public function getM2Datum(): ?\DateTimeInterface
    {
        return $this->m2Datum;
    }

    public function setM2Datum(?\DateTimeInterface $m2Datum): self
    {
        $this->m2Datum = $m2Datum;

        return $this;
    }

    public function getM3Datum(): ?\DateTimeInterface
    {
        return $this->m3Datum;
    }

    public function setM3Datum(?\DateTimeInterface $m3Datum): self
    {
        $this->m3Datum = $m3Datum;

        return $this;
    }

    public function getM0Erfolgt(): ?\DateTimeInterface
    {
        return $this->m0Erfolgt;
    }

    public function setM0Erfolgt(?\DateTimeInterface $m0Erfolgt): self
    {
        $this->m0Erfolgt = $m0Erfolgt;

        return $this;
    }

    public function getM1Erfolgt(): ?\DateTimeInterface
    {
        return $this->m1Erfolgt;
    }

    public function setM1Erfolgt(?\DateTimeInterface $m1Erfolgt): self
    {
        $this->m1Erfolgt = $m1Erfolgt;

        return $this;
    }

    public function getM2Erfolgt(): ?\DateTimeInterface
    {
        return $this->m2Erfolgt;
    }

    public function setM2Erfolgt(?\DateTimeInterface $m2Erfolgt): self
    {
        $this->m2Erfolgt = $m2Erfolgt;

        return $this;
    }

    public function getM3Erfolgt(): ?\DateTimeInterface
    {
        return $this->m3Erfolgt;
    }

    public function setM3Erfolgt(?\DateTimeInterface $m3Erfolgt): self
    {
        $this->m3Erfolgt = $m3Erfolgt;

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
