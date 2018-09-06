<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FibuPersonenkonten
 *
 * @ORM\Table(name="p17_fibu_personenkonten")
 * @ORM\Entity
 */
class P17FibuPersonenkonten
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
     * @ORM\Column(name="mandantID", type="integer", nullable=false, options={"default"="1"})
     */
    private $mandantid = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="firmenID", type="integer", nullable=false)
     */
    private $firmenid;

    /**
     * @var int
     *
     * @ORM\Column(name="kontonummer", type="integer", nullable=false)
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
     * @ORM\Column(name="anrede", type="string", length=10, nullable=false, options={"default"="Firma"})
     */
    private $anrede = 'Firma';

    /**
     * @var string
     *
     * @ORM\Column(name="kontoname", type="string", length=27, nullable=false)
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
     * @ORM\Column(name="zuhanden", type="string", length=100, nullable=false)
     */
    private $zuhanden = '';

    /**
     * @var string
     *
     * @ORM\Column(name="strasse", type="string", length=27, nullable=false)
     */
    private $strasse = '';

    /**
     * @var string
     *
     * @ORM\Column(name="land", type="string", length=3, nullable=false, options={"fixed"=true})
     */
    private $land = '';

    /**
     * @var string
     *
     * @ORM\Column(name="plz", type="string", length=5, nullable=false)
     */
    private $plz = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ort", type="string", length=27, nullable=false)
     */
    private $ort = '';

    /**
     * @var string
     *
     * @ORM\Column(name="telefon", type="string", length=27, nullable=false)
     */
    private $telefon = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=27, nullable=false)
     */
    private $fax = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email = '';

    /**
     * @var string
     *
     * @ORM\Column(name="homepage", type="string", length=100, nullable=false)
     */
    private $homepage = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bank", type="string", length=50, nullable=false)
     */
    private $bank;

    /**
     * @var string
     *
     * @ORM\Column(name="blz", type="string", length=8, nullable=false)
     */
    private $blz = '';

    /**
     * @var string
     *
     * @ORM\Column(name="iban", type="string", length=16, nullable=false)
     */
    private $iban = '';

    /**
     * @var string
     *
     * @ORM\Column(name="BIC", type="string", length=10, nullable=false)
     */
    private $bic;

    /**
     * @var string
     *
     * @ORM\Column(name="bank2", type="string", length=50, nullable=false)
     */
    private $bank2;

    /**
     * @var string
     *
     * @ORM\Column(name="iban2", type="string", length=30, nullable=false)
     */
    private $iban2;

    /**
     * @var int
     *
     * @ORM\Column(name="blz2", type="integer", nullable=false)
     */
    private $blz2;

    /**
     * @var string
     *
     * @ORM\Column(name="BIC2", type="string", length=10, nullable=false)
     */
    private $bic2;

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
     * @var int
     *
     * @ORM\Column(name="nettotage", type="integer", nullable=false)
     */
    private $nettotage = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="zahlungskennzeichen", type="string", length=3, nullable=false, options={"fixed"=true})
     */
    private $zahlungskennzeichen = '';

    /**
     * @var int
     *
     * @ORM\Column(name="zahlungsbedingungID", type="integer", nullable=false, options={"default"="1"})
     */
    private $zahlungsbedingungid = '1';

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
     * @ORM\Column(name="bkz3", type="string", length=4, nullable=false)
     */
    private $bkz3 = '';

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
     * @var int
     *
     * @ORM\Column(name="kredit_warnen", type="integer", nullable=false)
     */
    private $kreditWarnen = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="kredit_sperren", type="integer", nullable=false)
     */
    private $kreditSperren = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="mahnsperre", type="boolean", nullable=false)
     */
    private $mahnsperre = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="mahnsperre_bis", type="date", nullable=true)
     */
    private $mahnsperreBis;

    /**
     * @var bool
     *
     * @ORM\Column(name="raffer", type="boolean", nullable=false)
     */
    private $raffer = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="preisliste", type="string", length=3, nullable=false, options={"fixed"=true})
     */
    private $preisliste = '';

    /**
     * @var string
     *
     * @ORM\Column(name="rabattleiste", type="string", length=3, nullable=false, options={"fixed"=true})
     */
    private $rabattleiste = '';

    /**
     * @var string
     *
     * @ORM\Column(name="kundengruppe", type="string", length=3, nullable=false, options={"fixed"=true})
     */
    private $kundengruppe = '';

    /**
     * @var string
     *
     * @ORM\Column(name="belegart", type="string", length=3, nullable=false, options={"fixed"=true})
     */
    private $belegart = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="mahnintervall", type="boolean", nullable=false)
     */
    private $mahnintervall;

    /**
     * @var string
     *
     * @ORM\Column(name="UStID", type="string", length=20, nullable=false)
     */
    private $ustid;

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

    public function getFirmenid(): ?int
    {
        return $this->firmenid;
    }

    public function setFirmenid(int $firmenid): self
    {
        $this->firmenid = $firmenid;

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

    public function getAnrede(): ?string
    {
        return $this->anrede;
    }

    public function setAnrede(string $anrede): self
    {
        $this->anrede = $anrede;

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

    public function getZuhanden(): ?string
    {
        return $this->zuhanden;
    }

    public function setZuhanden(string $zuhanden): self
    {
        $this->zuhanden = $zuhanden;

        return $this;
    }

    public function getStrasse(): ?string
    {
        return $this->strasse;
    }

    public function setStrasse(string $strasse): self
    {
        $this->strasse = $strasse;

        return $this;
    }

    public function getLand(): ?string
    {
        return $this->land;
    }

    public function setLand(string $land): self
    {
        $this->land = $land;

        return $this;
    }

    public function getPlz(): ?string
    {
        return $this->plz;
    }

    public function setPlz(string $plz): self
    {
        $this->plz = $plz;

        return $this;
    }

    public function getOrt(): ?string
    {
        return $this->ort;
    }

    public function setOrt(string $ort): self
    {
        $this->ort = $ort;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getHomepage(): ?string
    {
        return $this->homepage;
    }

    public function setHomepage(string $homepage): self
    {
        $this->homepage = $homepage;

        return $this;
    }

    public function getBank(): ?string
    {
        return $this->bank;
    }

    public function setBank(string $bank): self
    {
        $this->bank = $bank;

        return $this;
    }

    public function getBlz(): ?string
    {
        return $this->blz;
    }

    public function setBlz(string $blz): self
    {
        $this->blz = $blz;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getBic(): ?string
    {
        return $this->bic;
    }

    public function setBic(string $bic): self
    {
        $this->bic = $bic;

        return $this;
    }

    public function getBank2(): ?string
    {
        return $this->bank2;
    }

    public function setBank2(string $bank2): self
    {
        $this->bank2 = $bank2;

        return $this;
    }

    public function getIban2(): ?string
    {
        return $this->iban2;
    }

    public function setIban2(string $iban2): self
    {
        $this->iban2 = $iban2;

        return $this;
    }

    public function getBlz2(): ?int
    {
        return $this->blz2;
    }

    public function setBlz2(int $blz2): self
    {
        $this->blz2 = $blz2;

        return $this;
    }

    public function getBic2(): ?string
    {
        return $this->bic2;
    }

    public function setBic2(string $bic2): self
    {
        $this->bic2 = $bic2;

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

    public function getNettotage(): ?int
    {
        return $this->nettotage;
    }

    public function setNettotage(int $nettotage): self
    {
        $this->nettotage = $nettotage;

        return $this;
    }

    public function getZahlungskennzeichen(): ?string
    {
        return $this->zahlungskennzeichen;
    }

    public function setZahlungskennzeichen(string $zahlungskennzeichen): self
    {
        $this->zahlungskennzeichen = $zahlungskennzeichen;

        return $this;
    }

    public function getZahlungsbedingungid(): ?int
    {
        return $this->zahlungsbedingungid;
    }

    public function setZahlungsbedingungid(int $zahlungsbedingungid): self
    {
        $this->zahlungsbedingungid = $zahlungsbedingungid;

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

    public function getBkz3(): ?string
    {
        return $this->bkz3;
    }

    public function setBkz3(string $bkz3): self
    {
        $this->bkz3 = $bkz3;

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

    public function getKreditWarnen(): ?int
    {
        return $this->kreditWarnen;
    }

    public function setKreditWarnen(int $kreditWarnen): self
    {
        $this->kreditWarnen = $kreditWarnen;

        return $this;
    }

    public function getKreditSperren(): ?int
    {
        return $this->kreditSperren;
    }

    public function setKreditSperren(int $kreditSperren): self
    {
        $this->kreditSperren = $kreditSperren;

        return $this;
    }

    public function getMahnsperre(): ?bool
    {
        return $this->mahnsperre;
    }

    public function setMahnsperre(bool $mahnsperre): self
    {
        $this->mahnsperre = $mahnsperre;

        return $this;
    }

    public function getMahnsperreBis(): ?\DateTimeInterface
    {
        return $this->mahnsperreBis;
    }

    public function setMahnsperreBis(?\DateTimeInterface $mahnsperreBis): self
    {
        $this->mahnsperreBis = $mahnsperreBis;

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

    public function getPreisliste(): ?string
    {
        return $this->preisliste;
    }

    public function setPreisliste(string $preisliste): self
    {
        $this->preisliste = $preisliste;

        return $this;
    }

    public function getRabattleiste(): ?string
    {
        return $this->rabattleiste;
    }

    public function setRabattleiste(string $rabattleiste): self
    {
        $this->rabattleiste = $rabattleiste;

        return $this;
    }

    public function getKundengruppe(): ?string
    {
        return $this->kundengruppe;
    }

    public function setKundengruppe(string $kundengruppe): self
    {
        $this->kundengruppe = $kundengruppe;

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

    public function getMahnintervall(): ?bool
    {
        return $this->mahnintervall;
    }

    public function setMahnintervall(bool $mahnintervall): self
    {
        $this->mahnintervall = $mahnintervall;

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
