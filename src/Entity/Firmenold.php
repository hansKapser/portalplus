<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Firmenold
 *
 * @ORM\Table(name="firmenOld", indexes={@ORM\Index(name="schulID", columns={"schulID"})})
 * @ORM\Entity
 */
class Firmenold
{
    /**
     * @var int
     *
     * @ORM\Column(name="firmenID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $firmenid;

    /**
     * @var int
     *
     * @ORM\Column(name="schulID", type="integer", nullable=false)
     */
    private $schulid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="firma1", type="string", length=50, nullable=false)
     */
    private $firma1;

    /**
     * @var string
     *
     * @ORM\Column(name="firma2", type="string", length=50, nullable=false)
     */
    private $firma2;

    /**
     * @var string
     *
     * @ORM\Column(name="branche1", type="string", length=40, nullable=false)
     */
    private $branche1;

    /**
     * @var string
     *
     * @ORM\Column(name="branche2", type="string", length=40, nullable=false)
     */
    private $branche2;

    /**
     * @var string
     *
     * @ORM\Column(name="telefon", type="string", length=20, nullable=false)
     */
    private $telefon;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=false)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="email2", type="string", length=50, nullable=false)
     */
    private $email2;

    /**
     * @var string
     *
     * @ORM\Column(name="email_password", type="string", length=20, nullable=false)
     */
    private $emailPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="email2_password", type="string", length=30, nullable=false)
     */
    private $email2Password;

    /**
     * @var string
     *
     * @ORM\Column(name="homepage", type="string", length=75, nullable=false)
     */
    private $homepage;

    /**
     * @var string
     *
     * @ORM\Column(name="katalog_site", type="string", length=75, nullable=false, options={"default"="Katalog.pdf"})
     */
    private $katalogSite = 'Katalog.pdf';

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=20, nullable=false)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="GF_anrede", type="string", length=5, nullable=false)
     */
    private $gfAnrede;

    /**
     * @var string
     *
     * @ORM\Column(name="GF_name", type="string", length=60, nullable=false)
     */
    private $gfName;

    /**
     * @var string
     *
     * @ORM\Column(name="GF_vorname", type="string", length=30, nullable=false)
     */
    private $gfVorname;

    /**
     * @var string
     *
     * @ORM\Column(name="GF2_name", type="string", length=60, nullable=false)
     */
    private $gf2Name;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="gr_jahr", type="integer", nullable=false)
     */
    private $grJahr = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="konto1", type="integer", nullable=true)
     */
    private $konto1 = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="konto2", type="integer", nullable=true)
     */
    private $konto2 = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="lieferbedingung", type="string", length=100, nullable=false)
     */
    private $lieferbedingung;

    /**
     * @var string
     *
     * @ORM\Column(name="freihaus_ab", type="decimal", precision=8, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $freihausAb = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="frachtkosten_km", type="decimal", precision=5, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $frachtkostenKm = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="frachtkosten_prozent", type="decimal", precision=5, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $frachtkostenProzent = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="frachtkosten_fix", type="decimal", precision=6, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $frachtkostenFix = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="kennzeichen", type="string", length=10, nullable=false)
     */
    private $kennzeichen;

    /**
     * @var int
     *
     * @ORM\Column(name="skontotage", type="integer", nullable=false)
     */
    private $skontotage = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="skontosatz", type="decimal", precision=4, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $skontosatz = '0.00';

    /**
     * @var bool
     *
     * @ORM\Column(name="skontoversand", type="boolean", nullable=false)
     */
    private $skontoversand;

    /**
     * @var int
     *
     * @ORM\Column(name="nettotage", type="integer", nullable=false)
     */
    private $nettotage = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="zahlungsbedingungID", type="boolean", nullable=true, options={"default"="1"})
     */
    private $zahlungsbedingungid = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="verpackungskostenID", type="boolean", nullable=true, options={"default"="1"})
     */
    private $verpackungskostenid = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="freigabe_bestellung", type="boolean", nullable=false)
     */
    private $freigabeBestellung = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="freigabe_auftrag", type="boolean", nullable=false)
     */
    private $freigabeAuftrag = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="freigabe_lieferschein", type="boolean", nullable=false)
     */
    private $freigabeLieferschein = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="freigabe_rechnung", type="boolean", nullable=false)
     */
    private $freigabeRechnung = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="freigabe_email", type="boolean", nullable=false)
     */
    private $freigabeEmail = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="freigabe_bestellung_ausland", type="boolean", nullable=false)
     */
    private $freigabeBestellungAusland = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="freigabe_UNvB", type="boolean", nullable=false)
     */
    private $freigabeUnvb = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="project", type="boolean", nullable=false)
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\Column(name="HR_abteilung", type="string", length=1, nullable=false, options={"fixed"=true})
     */
    private $hrAbteilung;

    /**
     * @var string
     *
     * @ORM\Column(name="HR_nummer", type="string", length=20, nullable=false)
     */
    private $hrNummer;

    /**
     * @var string
     *
     * @ORM\Column(name="UStNr", type="string", length=15, nullable=false)
     */
    private $ustnr;

    /**
     * @var string
     *
     * @ORM\Column(name="LStNr", type="string", length=15, nullable=false)
     */
    private $lstnr;

    /**
     * @var string
     *
     * @ORM\Column(name="USTID", type="string", length=15, nullable=false)
     */
    private $ustid;

    /**
     * @var string
     *
     * @ORM\Column(name="AOK_betriebsnummer", type="string", length=20, nullable=false)
     */
    private $aokBetriebsnummer;

    /**
     * @var string
     *
     * @ORM\Column(name="DAK_betriebsnummer", type="string", length=20, nullable=false)
     */
    private $dakBetriebsnummer;

    /**
     * @var string
     *
     * @ORM\Column(name="LINGUA_FRANCA", type="string", length=20, nullable=false)
     */
    private $linguaFranca;

    /**
     * @var string
     *
     * @ORM\Column(name="mindestbestellwert", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $mindestbestellwert = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="eurobank_BIC", type="string", length=11, nullable=false, options={"default"="EURODEM1"})
     */
    private $eurobankBic = 'EURODEM1';

    /**
     * @var int
     *
     * @ORM\Column(name="eurobank_konto", type="integer", nullable=false)
     */
    private $eurobankKonto;

    /**
     * @var string
     *
     * @ORM\Column(name="eurobank_iban", type="string", length=30, nullable=false)
     */
    private $eurobankIban;

    /**
     * @var string
     *
     * @ORM\Column(name="eurobank_PIN", type="string", length=10, nullable=false)
     */
    private $eurobankPin;

    /**
     * @var string
     *
     * @ORM\Column(name="eurobank_ccPIN", type="string", length=10, nullable=false)
     */
    private $eurobankCcpin;

    /**
     * @var int
     *
     * @ORM\Column(name="postbank_konto", type="integer", nullable=false)
     */
    private $postbankKonto;

    /**
     * @var string
     *
     * @ORM\Column(name="postbank_iban", type="string", length=30, nullable=false)
     */
    private $postbankIban;

    /**
     * @var string
     *
     * @ORM\Column(name="postbank_PIN", type="string", length=10, nullable=false)
     */
    private $postbankPin;

    /**
     * @var string
     *
     * @ORM\Column(name="postbank_ccPIN", type="string", length=10, nullable=false)
     */
    private $postbankCcpin;

    /**
     * @var string
     *
     * @ORM\Column(name="getin_BIC", type="string", length=11, nullable=false, options={"default"="GETIGIM2"})
     */
    private $getinBic = 'GETIGIM2';

    /**
     * @var int
     *
     * @ORM\Column(name="getin_konto", type="integer", nullable=false)
     */
    private $getinKonto;

    /**
     * @var string
     *
     * @ORM\Column(name="getin_iban", type="string", length=50, nullable=false)
     */
    private $getinIban;

    /**
     * @var string
     *
     * @ORM\Column(name="getin_PIN", type="string", length=10, nullable=false)
     */
    private $getinPin;

    /**
     * @var string
     *
     * @ORM\Column(name="getin_ccPIN", type="string", length=10, nullable=false)
     */
    private $getinCcpin;

    /**
     * @var int
     *
     * @ORM\Column(name="zertifikat_jahr", type="integer", nullable=false)
     */
    private $zertifikatJahr;

    /**
     * @var string
     *
     * @ORM\Column(name="mp_auth", type="string", length=20, nullable=false, options={"default"="marktplatz"})
     */
    private $mpAuth = 'marktplatz';

    /**
     * @var string
     *
     * @ORM\Column(name="mp_auth_password", type="string", length=30, nullable=false)
     */
    private $mpAuthPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="mp_login", type="string", length=20, nullable=false)
     */
    private $mpLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="mp_login_password", type="string", length=30, nullable=false)
     */
    private $mpLoginPassword;

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

    public function getFirmenid(): ?int
    {
        return $this->firmenid;
    }

    public function getSchulid(): ?int
    {
        return $this->schulid;
    }

    public function setSchulid(int $schulid): self
    {
        $this->schulid = $schulid;

        return $this;
    }

    public function getFirma1(): ?string
    {
        return $this->firma1;
    }

    public function setFirma1(string $firma1): self
    {
        $this->firma1 = $firma1;

        return $this;
    }

    public function getFirma2(): ?string
    {
        return $this->firma2;
    }

    public function setFirma2(string $firma2): self
    {
        $this->firma2 = $firma2;

        return $this;
    }

    public function getBranche1(): ?string
    {
        return $this->branche1;
    }

    public function setBranche1(string $branche1): self
    {
        $this->branche1 = $branche1;

        return $this;
    }

    public function getBranche2(): ?string
    {
        return $this->branche2;
    }

    public function setBranche2(string $branche2): self
    {
        $this->branche2 = $branche2;

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

    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    public function setEmail2(string $email2): self
    {
        $this->email2 = $email2;

        return $this;
    }

    public function getEmailPassword(): ?string
    {
        return $this->emailPassword;
    }

    public function setEmailPassword(string $emailPassword): self
    {
        $this->emailPassword = $emailPassword;

        return $this;
    }

    public function getEmail2Password(): ?string
    {
        return $this->email2Password;
    }

    public function setEmail2Password(string $email2Password): self
    {
        $this->email2Password = $email2Password;

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

    public function getKatalogSite(): ?string
    {
        return $this->katalogSite;
    }

    public function setKatalogSite(string $katalogSite): self
    {
        $this->katalogSite = $katalogSite;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getGfAnrede(): ?string
    {
        return $this->gfAnrede;
    }

    public function setGfAnrede(string $gfAnrede): self
    {
        $this->gfAnrede = $gfAnrede;

        return $this;
    }

    public function getGfName(): ?string
    {
        return $this->gfName;
    }

    public function setGfName(string $gfName): self
    {
        $this->gfName = $gfName;

        return $this;
    }

    public function getGfVorname(): ?string
    {
        return $this->gfVorname;
    }

    public function setGfVorname(string $gfVorname): self
    {
        $this->gfVorname = $gfVorname;

        return $this;
    }

    public function getGf2Name(): ?string
    {
        return $this->gf2Name;
    }

    public function setGf2Name(string $gf2Name): self
    {
        $this->gf2Name = $gf2Name;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getGrJahr(): ?int
    {
        return $this->grJahr;
    }

    public function setGrJahr(int $grJahr): self
    {
        $this->grJahr = $grJahr;

        return $this;
    }

    public function getKonto1(): ?int
    {
        return $this->konto1;
    }

    public function setKonto1(?int $konto1): self
    {
        $this->konto1 = $konto1;

        return $this;
    }

    public function getKonto2(): ?int
    {
        return $this->konto2;
    }

    public function setKonto2(?int $konto2): self
    {
        $this->konto2 = $konto2;

        return $this;
    }

    public function getLieferbedingung(): ?string
    {
        return $this->lieferbedingung;
    }

    public function setLieferbedingung(string $lieferbedingung): self
    {
        $this->lieferbedingung = $lieferbedingung;

        return $this;
    }

    public function getFreihausAb()
    {
        return $this->freihausAb;
    }

    public function setFreihausAb($freihausAb): self
    {
        $this->freihausAb = $freihausAb;

        return $this;
    }

    public function getFrachtkostenKm()
    {
        return $this->frachtkostenKm;
    }

    public function setFrachtkostenKm($frachtkostenKm): self
    {
        $this->frachtkostenKm = $frachtkostenKm;

        return $this;
    }

    public function getFrachtkostenProzent()
    {
        return $this->frachtkostenProzent;
    }

    public function setFrachtkostenProzent($frachtkostenProzent): self
    {
        $this->frachtkostenProzent = $frachtkostenProzent;

        return $this;
    }

    public function getFrachtkostenFix()
    {
        return $this->frachtkostenFix;
    }

    public function setFrachtkostenFix($frachtkostenFix): self
    {
        $this->frachtkostenFix = $frachtkostenFix;

        return $this;
    }

    public function getKennzeichen(): ?string
    {
        return $this->kennzeichen;
    }

    public function setKennzeichen(string $kennzeichen): self
    {
        $this->kennzeichen = $kennzeichen;

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

    public function getSkontosatz()
    {
        return $this->skontosatz;
    }

    public function setSkontosatz($skontosatz): self
    {
        $this->skontosatz = $skontosatz;

        return $this;
    }

    public function getSkontoversand(): ?bool
    {
        return $this->skontoversand;
    }

    public function setSkontoversand(bool $skontoversand): self
    {
        $this->skontoversand = $skontoversand;

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

    public function getZahlungsbedingungid(): ?bool
    {
        return $this->zahlungsbedingungid;
    }

    public function setZahlungsbedingungid(?bool $zahlungsbedingungid): self
    {
        $this->zahlungsbedingungid = $zahlungsbedingungid;

        return $this;
    }

    public function getVerpackungskostenid(): ?bool
    {
        return $this->verpackungskostenid;
    }

    public function setVerpackungskostenid(?bool $verpackungskostenid): self
    {
        $this->verpackungskostenid = $verpackungskostenid;

        return $this;
    }

    public function getFreigabeBestellung(): ?bool
    {
        return $this->freigabeBestellung;
    }

    public function setFreigabeBestellung(bool $freigabeBestellung): self
    {
        $this->freigabeBestellung = $freigabeBestellung;

        return $this;
    }

    public function getFreigabeAuftrag(): ?bool
    {
        return $this->freigabeAuftrag;
    }

    public function setFreigabeAuftrag(bool $freigabeAuftrag): self
    {
        $this->freigabeAuftrag = $freigabeAuftrag;

        return $this;
    }

    public function getFreigabeLieferschein(): ?bool
    {
        return $this->freigabeLieferschein;
    }

    public function setFreigabeLieferschein(bool $freigabeLieferschein): self
    {
        $this->freigabeLieferschein = $freigabeLieferschein;

        return $this;
    }

    public function getFreigabeRechnung(): ?bool
    {
        return $this->freigabeRechnung;
    }

    public function setFreigabeRechnung(bool $freigabeRechnung): self
    {
        $this->freigabeRechnung = $freigabeRechnung;

        return $this;
    }

    public function getFreigabeEmail(): ?bool
    {
        return $this->freigabeEmail;
    }

    public function setFreigabeEmail(bool $freigabeEmail): self
    {
        $this->freigabeEmail = $freigabeEmail;

        return $this;
    }

    public function getFreigabeBestellungAusland(): ?bool
    {
        return $this->freigabeBestellungAusland;
    }

    public function setFreigabeBestellungAusland(bool $freigabeBestellungAusland): self
    {
        $this->freigabeBestellungAusland = $freigabeBestellungAusland;

        return $this;
    }

    public function getFreigabeUnvb(): ?bool
    {
        return $this->freigabeUnvb;
    }

    public function setFreigabeUnvb(bool $freigabeUnvb): self
    {
        $this->freigabeUnvb = $freigabeUnvb;

        return $this;
    }

    public function getProject(): ?bool
    {
        return $this->project;
    }

    public function setProject(bool $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getHrAbteilung(): ?string
    {
        return $this->hrAbteilung;
    }

    public function setHrAbteilung(string $hrAbteilung): self
    {
        $this->hrAbteilung = $hrAbteilung;

        return $this;
    }

    public function getHrNummer(): ?string
    {
        return $this->hrNummer;
    }

    public function setHrNummer(string $hrNummer): self
    {
        $this->hrNummer = $hrNummer;

        return $this;
    }

    public function getUstnr(): ?string
    {
        return $this->ustnr;
    }

    public function setUstnr(string $ustnr): self
    {
        $this->ustnr = $ustnr;

        return $this;
    }

    public function getLstnr(): ?string
    {
        return $this->lstnr;
    }

    public function setLstnr(string $lstnr): self
    {
        $this->lstnr = $lstnr;

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

    public function getAokBetriebsnummer(): ?string
    {
        return $this->aokBetriebsnummer;
    }

    public function setAokBetriebsnummer(string $aokBetriebsnummer): self
    {
        $this->aokBetriebsnummer = $aokBetriebsnummer;

        return $this;
    }

    public function getDakBetriebsnummer(): ?string
    {
        return $this->dakBetriebsnummer;
    }

    public function setDakBetriebsnummer(string $dakBetriebsnummer): self
    {
        $this->dakBetriebsnummer = $dakBetriebsnummer;

        return $this;
    }

    public function getLinguaFranca(): ?string
    {
        return $this->linguaFranca;
    }

    public function setLinguaFranca(string $linguaFranca): self
    {
        $this->linguaFranca = $linguaFranca;

        return $this;
    }

    public function getMindestbestellwert()
    {
        return $this->mindestbestellwert;
    }

    public function setMindestbestellwert($mindestbestellwert): self
    {
        $this->mindestbestellwert = $mindestbestellwert;

        return $this;
    }

    public function getEurobankBic(): ?string
    {
        return $this->eurobankBic;
    }

    public function setEurobankBic(string $eurobankBic): self
    {
        $this->eurobankBic = $eurobankBic;

        return $this;
    }

    public function getEurobankKonto(): ?int
    {
        return $this->eurobankKonto;
    }

    public function setEurobankKonto(int $eurobankKonto): self
    {
        $this->eurobankKonto = $eurobankKonto;

        return $this;
    }

    public function getEurobankIban(): ?string
    {
        return $this->eurobankIban;
    }

    public function setEurobankIban(string $eurobankIban): self
    {
        $this->eurobankIban = $eurobankIban;

        return $this;
    }

    public function getEurobankPin(): ?string
    {
        return $this->eurobankPin;
    }

    public function setEurobankPin(string $eurobankPin): self
    {
        $this->eurobankPin = $eurobankPin;

        return $this;
    }

    public function getEurobankCcpin(): ?string
    {
        return $this->eurobankCcpin;
    }

    public function setEurobankCcpin(string $eurobankCcpin): self
    {
        $this->eurobankCcpin = $eurobankCcpin;

        return $this;
    }

    public function getPostbankKonto(): ?int
    {
        return $this->postbankKonto;
    }

    public function setPostbankKonto(int $postbankKonto): self
    {
        $this->postbankKonto = $postbankKonto;

        return $this;
    }

    public function getPostbankIban(): ?string
    {
        return $this->postbankIban;
    }

    public function setPostbankIban(string $postbankIban): self
    {
        $this->postbankIban = $postbankIban;

        return $this;
    }

    public function getPostbankPin(): ?string
    {
        return $this->postbankPin;
    }

    public function setPostbankPin(string $postbankPin): self
    {
        $this->postbankPin = $postbankPin;

        return $this;
    }

    public function getPostbankCcpin(): ?string
    {
        return $this->postbankCcpin;
    }

    public function setPostbankCcpin(string $postbankCcpin): self
    {
        $this->postbankCcpin = $postbankCcpin;

        return $this;
    }

    public function getGetinBic(): ?string
    {
        return $this->getinBic;
    }

    public function setGetinBic(string $getinBic): self
    {
        $this->getinBic = $getinBic;

        return $this;
    }

    public function getGetinKonto(): ?int
    {
        return $this->getinKonto;
    }

    public function setGetinKonto(int $getinKonto): self
    {
        $this->getinKonto = $getinKonto;

        return $this;
    }

    public function getGetinIban(): ?string
    {
        return $this->getinIban;
    }

    public function setGetinIban(string $getinIban): self
    {
        $this->getinIban = $getinIban;

        return $this;
    }

    public function getGetinPin(): ?string
    {
        return $this->getinPin;
    }

    public function setGetinPin(string $getinPin): self
    {
        $this->getinPin = $getinPin;

        return $this;
    }

    public function getGetinCcpin(): ?string
    {
        return $this->getinCcpin;
    }

    public function setGetinCcpin(string $getinCcpin): self
    {
        $this->getinCcpin = $getinCcpin;

        return $this;
    }

    public function getZertifikatJahr(): ?int
    {
        return $this->zertifikatJahr;
    }

    public function setZertifikatJahr(int $zertifikatJahr): self
    {
        $this->zertifikatJahr = $zertifikatJahr;

        return $this;
    }

    public function getMpAuth(): ?string
    {
        return $this->mpAuth;
    }

    public function setMpAuth(string $mpAuth): self
    {
        $this->mpAuth = $mpAuth;

        return $this;
    }

    public function getMpAuthPassword(): ?string
    {
        return $this->mpAuthPassword;
    }

    public function setMpAuthPassword(string $mpAuthPassword): self
    {
        $this->mpAuthPassword = $mpAuthPassword;

        return $this;
    }

    public function getMpLogin(): ?string
    {
        return $this->mpLogin;
    }

    public function setMpLogin(string $mpLogin): self
    {
        $this->mpLogin = $mpLogin;

        return $this;
    }

    public function getMpLoginPassword(): ?string
    {
        return $this->mpLoginPassword;
    }

    public function setMpLoginPassword(string $mpLoginPassword): self
    {
        $this->mpLoginPassword = $mpLoginPassword;

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
