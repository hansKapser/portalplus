<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FibuSachkonten
 *
 * @ORM\Table(name="p17_fibu_sachkonten", uniqueConstraints={@ORM\UniqueConstraint(name="mandantID_kontonummer", columns={"firmID", "kontonummer"})})
 * @ORM\Entity
 */
class P17FibuSachkonten
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
     * @ORM\Column(name="firmID", type="integer", nullable=false, options={"default"="1"})
     */
    private $firmid = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="kontonummer", type="string", length=4, nullable=false)
     */
    private $kontonummer = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="kontenart", type="string", length=1, nullable=false, options={"fixed"=true})
     */
    private $kontenart = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="aktiv", type="boolean", nullable=false, options={"default"="1"})
     */
    private $aktiv = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="kontoname", type="string", length=50, nullable=false)
     */
    private $kontoname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="kontoname2", type="string", length=27, nullable=false)
     */
    private $kontoname2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="kostenart", type="string", length=4, nullable=false)
     */
    private $kostenart = '';

    /**
     * @var string
     *
     * @ORM\Column(name="kostenstelle", type="string", length=4, nullable=false)
     */
    private $kostenstelle = '';

    /**
     * @var string
     *
     * @ORM\Column(name="kostentraeger", type="string", length=4, nullable=false)
     */
    private $kostentraeger = '';

    /**
     * @var string
     *
     * @ORM\Column(name="konsolidkonto", type="string", length=5, nullable=false)
     */
    private $konsolidkonto = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bkz1", type="string", length=4, nullable=false)
     */
    private $bkz1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bkz2", type="string", length=4, nullable=false)
     */
    private $bkz2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bwa1", type="string", length=4, nullable=false)
     */
    private $bwa1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bwa2", type="string", length=4, nullable=false)
     */
    private $bwa2 = '';

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
     * @var string
     *
     * @ORM\Column(name="BN", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $bn = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="skonto_konto", type="string", length=4, nullable=false)
     */
    private $skontoKonto;

    /**
     * @var bool
     *
     * @ORM\Column(name="raffer", type="boolean", nullable=false)
     */
    private $raffer = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="belegart", type="string", length=3, nullable=false, options={"fixed"=true})
     */
    private $belegart = '';

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

    public function getFirmid(): ?int
    {
        return $this->firmid;
    }

    public function setFirmid(int $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }

    public function getKontonummer(): ?string
    {
        return $this->kontonummer;
    }

    public function setKontonummer(string $kontonummer): self
    {
        $this->kontonummer = $kontonummer;

        return $this;
    }

    public function getKontenart(): ?string
    {
        return $this->kontenart;
    }

    public function setKontenart(string $kontenart): self
    {
        $this->kontenart = $kontenart;

        return $this;
    }

    public function getAktiv(): ?bool
    {
        return $this->aktiv;
    }

    public function setAktiv(bool $aktiv): self
    {
        $this->aktiv = $aktiv;

        return $this;
    }

    public function getKontoname(): ?string
    {
        return $this->kontoname;
    }

    public function setKontoname(string $kontoname): self
    {
        $this->kontoname = $kontoname;

        return $this;
    }

    public function getKontoname2(): ?string
    {
        return $this->kontoname2;
    }

    public function setKontoname2(string $kontoname2): self
    {
        $this->kontoname2 = $kontoname2;

        return $this;
    }

    public function getKostenart(): ?string
    {
        return $this->kostenart;
    }

    public function setKostenart(string $kostenart): self
    {
        $this->kostenart = $kostenart;

        return $this;
    }

    public function getKostenstelle(): ?string
    {
        return $this->kostenstelle;
    }

    public function setKostenstelle(string $kostenstelle): self
    {
        $this->kostenstelle = $kostenstelle;

        return $this;
    }

    public function getKostentraeger(): ?string
    {
        return $this->kostentraeger;
    }

    public function setKostentraeger(string $kostentraeger): self
    {
        $this->kostentraeger = $kostentraeger;

        return $this;
    }

    public function getKonsolidkonto(): ?string
    {
        return $this->konsolidkonto;
    }

    public function setKonsolidkonto(string $konsolidkonto): self
    {
        $this->konsolidkonto = $konsolidkonto;

        return $this;
    }

    public function getBkz1(): ?string
    {
        return $this->bkz1;
    }

    public function setBkz1(string $bkz1): self
    {
        $this->bkz1 = $bkz1;

        return $this;
    }

    public function getBkz2(): ?string
    {
        return $this->bkz2;
    }

    public function setBkz2(string $bkz2): self
    {
        $this->bkz2 = $bkz2;

        return $this;
    }

    public function getBwa1(): ?string
    {
        return $this->bwa1;
    }

    public function setBwa1(string $bwa1): self
    {
        $this->bwa1 = $bwa1;

        return $this;
    }

    public function getBwa2(): ?string
    {
        return $this->bwa2;
    }

    public function setBwa2(string $bwa2): self
    {
        $this->bwa2 = $bwa2;

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

    public function getBn(): ?string
    {
        return $this->bn;
    }

    public function setBn(string $bn): self
    {
        $this->bn = $bn;

        return $this;
    }

    public function getSkontoKonto(): ?string
    {
        return $this->skontoKonto;
    }

    public function setSkontoKonto(string $skontoKonto): self
    {
        $this->skontoKonto = $skontoKonto;

        return $this;
    }

    public function getRaffer(): ?bool
    {
        return $this->raffer;
    }

    public function setRaffer(bool $raffer): self
    {
        $this->raffer = $raffer;

        return $this;
    }

    public function getBelegart(): ?string
    {
        return $this->belegart;
    }

    public function setBelegart(string $belegart): self
    {
        $this->belegart = $belegart;

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
