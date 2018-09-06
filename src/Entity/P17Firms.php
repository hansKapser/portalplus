<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Firms
 *
 * @ORM\Table(name="p17_firms", indexes={@ORM\Index(name="termPayment", columns={"termPayment"})})
 * @ORM\Entity
 */
class P17Firms
{
    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $firmid;

    /**
     * @var bool
     *
     * @ORM\Column(name="virtualFirm", type="boolean", nullable=false)
     */
    private $virtualfirm = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="foundingYear", type="integer", nullable=false)
     */
    private $foundingyear = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="activityStatus", type="boolean", nullable=false, options={"default"="1"})
     */
    private $activitystatus = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="schoolNo", type="integer", nullable=true)
     */
    private $schoolno;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=20, nullable=false, options={"default"="Uebungsunternehmung"})
     */
    private $address = 'Uebungsunternehmung';

    /**
     * @var string|null
     *
     * @ORM\Column(name="company", type="string", length=50, nullable=true)
     */
    private $company;

    /**
     * @var string|null
     *
     * @ORM\Column(name="company2", type="string", length=50, nullable=true)
     */
    private $company2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="street", type="string", length=100, nullable=true)
     */
    private $street;

    /**
     * @var string|null
     *
     * @ORM\Column(name="house", type="string", length=5, nullable=true)
     */
    private $house;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postcode", type="string", length=5, nullable=true)
     */
    private $postcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=2, nullable=false, options={"default"="DE"})
     */
    private $country = 'DE';

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=50, nullable=false, options={"default"="mail.your-server.de:143"})
     */
    private $host = 'mail.your-server.de:143';

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emailPass", type="string", length=50, nullable=true)
     */
    private $emailpass;

    /**
     * @var string|null
     *
     * @ORM\Column(name="host2", type="string", length=100, nullable=true)
     */
    private $host2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email2", type="string", length=150, nullable=true)
     */
    private $email2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email2Pass", type="string", length=150, nullable=true)
     */
    private $email2pass;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=50, nullable=true)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fax", type="string", length=25, nullable=true)
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="manager_first_name", type="string", length=100, nullable=true)
     */
    private $managerFirstName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="manager_name", type="string", length=100, nullable=true)
     */
    private $managerName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="UStID", type="string", length=30, nullable=true)
     */
    private $ustid;

    /**
     * @var int
     *
     * @ORM\Column(name="debitor_from", type="integer", nullable=false, options={"default"="24000"})
     */
    private $debitorFrom = '24000';

    /**
     * @var int
     *
     * @ORM\Column(name="debitor_to", type="integer", nullable=false, options={"default"="29999"})
     */
    private $debitorTo = '29999';

    /**
     * @var int
     *
     * @ORM\Column(name="creditor_from", type="integer", nullable=false, options={"default"="44000"})
     */
    private $creditorFrom = '44000';

    /**
     * @var int
     *
     * @ORM\Column(name="creditor_to", type="integer", nullable=false, options={"default"="49999"})
     */
    private $creditorTo = '49999';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="serialNumber", type="boolean", nullable=true)
     */
    private $serialnumber;

    /**
     * @var int
     *
     * @ORM\Column(name="EBK", type="integer", nullable=false, options={"default"="8000"})
     */
    private $ebk = '8000';

    /**
     * @var string
     *
     * @ORM\Column(name="bank", type="string", length=50, nullable=false, options={"default"="euroBankdirekt"})
     */
    private $bank = 'euroBankdirekt';

    /**
     * @var string|null
     *
     * @ORM\Column(name="IBAN", type="string", length=30, nullable=true)
     */
    private $iban;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PIN", type="string", length=20, nullable=true)
     */
    private $pin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="getin_IBAN", type="string", length=50, nullable=true)
     */
    private $getinIban;

    /**
     * @var string|null
     *
     * @ORM\Column(name="getin_PIN", type="string", length=20, nullable=true)
     */
    private $getinPin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="taxNo", type="string", length=30, nullable=true)
     */
    private $taxno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="wageTaxNo", type="string", length=30, nullable=true)
     */
    private $wagetaxno;

    /**
     * @var string
     *
     * @ORM\Column(name="HRDivision", type="string", length=1, nullable=false, options={"default"="B"})
     */
    private $hrdivision = 'B';

    /**
     * @var string|null
     *
     * @ORM\Column(name="HRNo", type="string", length=20, nullable=true)
     */
    private $hrno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="AOKNo", type="string", length=30, nullable=true)
     */
    private $aokno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DAKNo", type="string", length=30, nullable=true)
     */
    private $dakno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="path", type="string", length=20, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="truck_cost_km", type="decimal", precision=6, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $truckCostKm = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="truck_cost_insurance", type="decimal", precision=6, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $truckCostInsurance = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="truck_cost_fix", type="decimal", precision=6, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $truckCostFix = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="minOrderValue", type="decimal", precision=7, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $minordervalue = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="carriageFree", type="decimal", precision=7, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $carriagefree = '0.00';

    /**
     * @var int
     *
     * @ORM\Column(name="termPayment", type="integer", nullable=false, options={"default"="1"})
     */
    private $termpayment = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="M1_days", type="boolean", nullable=false, options={"default"="7"})
     */
    private $m1Days = '7';

    /**
     * @var bool
     *
     * @ORM\Column(name="M2_days", type="boolean", nullable=false, options={"default"="20"})
     */
    private $m2Days = '20';

    /**
     * @var bool
     *
     * @ORM\Column(name="M3_days", type="boolean", nullable=false, options={"default"="20"})
     */
    private $m3Days = '20';

    /**
     * @var string|null
     *
     * @ORM\Column(name="im_htaccess", type="string", length=20, nullable=true)
     */
    private $imHtaccess;

    /**
     * @var string|null
     *
     * @ORM\Column(name="im_htaccess_password", type="string", length=20, nullable=true)
     */
    private $imHtaccessPassword;

    /**
     * @var string|null
     *
     * @ORM\Column(name="im_user", type="string", length=20, nullable=true)
     */
    private $imUser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="im_user_password", type="string", length=20, nullable=true)
     */
    private $imUserPassword;

    /**
     * @var string|null
     *
     * @ORM\Column(name="im_admin", type="string", length=20, nullable=true)
     */
    private $imAdmin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="im_admin_password", type="string", length=20, nullable=true)
     */
    private $imAdminPassword;

    /**
     * @var int|null
     *
     * @ORM\Column(name="post_nummer", type="integer", nullable=true)
     */
    private $postNummer;

    /**
     * @var string|null
     *
     * @ORM\Column(name="post_password", type="string", length=30, nullable=true)
     */
    private $postPassword;

    /**
     * @var int|null
     *
     * @ORM\Column(name="shop_id", type="integer", nullable=true)
     */
    private $shopId;

    /**
     * @var bool
     *
     * @ORM\Column(name="ticketExternal", type="boolean", nullable=false, options={"default"="1"})
     */
    private $ticketexternal = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="IPlocal", type="string", length=20, nullable=true)
     */
    private $iplocal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mySQLuser", type="string", length=20, nullable=true)
     */
    private $mysqluser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mySQLpassword", type="string", length=20, nullable=true)
     */
    private $mysqlpassword;

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

    public function getFirmid(): ?int
    {
        return $this->firmid;
    }

    public function getVirtualfirm(): ?bool
    {
        return $this->virtualfirm;
    }

    public function setVirtualfirm(bool $virtualfirm): self
    {
        $this->virtualfirm = $virtualfirm;

        return $this;
    }

    public function getFoundingyear(): ?int
    {
        return $this->foundingyear;
    }

    public function setFoundingyear(int $foundingyear): self
    {
        $this->foundingyear = $foundingyear;

        return $this;
    }

    public function getActivitystatus(): ?bool
    {
        return $this->activitystatus;
    }

    public function setActivitystatus(bool $activitystatus): self
    {
        $this->activitystatus = $activitystatus;

        return $this;
    }

    public function getSchoolno(): ?int
    {
        return $this->schoolno;
    }

    public function setSchoolno(?int $schoolno): self
    {
        $this->schoolno = $schoolno;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany2(): ?string
    {
        return $this->company2;
    }

    public function setCompany2(?string $company2): self
    {
        $this->company2 = $company2;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function setHouse(?string $house): self
    {
        $this->house = $house;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailpass(): ?string
    {
        return $this->emailpass;
    }

    public function setEmailpass(?string $emailpass): self
    {
        $this->emailpass = $emailpass;

        return $this;
    }

    public function getHost2(): ?string
    {
        return $this->host2;
    }

    public function setHost2(?string $host2): self
    {
        $this->host2 = $host2;

        return $this;
    }

    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    public function setEmail2(?string $email2): self
    {
        $this->email2 = $email2;

        return $this;
    }

    public function getEmail2pass(): ?string
    {
        return $this->email2pass;
    }

    public function setEmail2pass(?string $email2pass): self
    {
        $this->email2pass = $email2pass;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getManagerFirstName(): ?string
    {
        return $this->managerFirstName;
    }

    public function setManagerFirstName(?string $managerFirstName): self
    {
        $this->managerFirstName = $managerFirstName;

        return $this;
    }

    public function getManagerName(): ?string
    {
        return $this->managerName;
    }

    public function setManagerName(?string $managerName): self
    {
        $this->managerName = $managerName;

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

    public function getDebitorFrom(): ?int
    {
        return $this->debitorFrom;
    }

    public function setDebitorFrom(int $debitorFrom): self
    {
        $this->debitorFrom = $debitorFrom;

        return $this;
    }

    public function getDebitorTo(): ?int
    {
        return $this->debitorTo;
    }

    public function setDebitorTo(int $debitorTo): self
    {
        $this->debitorTo = $debitorTo;

        return $this;
    }

    public function getCreditorFrom(): ?int
    {
        return $this->creditorFrom;
    }

    public function setCreditorFrom(int $creditorFrom): self
    {
        $this->creditorFrom = $creditorFrom;

        return $this;
    }

    public function getCreditorTo(): ?int
    {
        return $this->creditorTo;
    }

    public function setCreditorTo(int $creditorTo): self
    {
        $this->creditorTo = $creditorTo;

        return $this;
    }

    public function getSerialnumber(): ?bool
    {
        return $this->serialnumber;
    }

    public function setSerialnumber(?bool $serialnumber): self
    {
        $this->serialnumber = $serialnumber;

        return $this;
    }

    public function getEbk(): ?int
    {
        return $this->ebk;
    }

    public function setEbk(int $ebk): self
    {
        $this->ebk = $ebk;

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

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(?string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getPin(): ?string
    {
        return $this->pin;
    }

    public function setPin(?string $pin): self
    {
        $this->pin = $pin;

        return $this;
    }

    public function getGetinIban(): ?string
    {
        return $this->getinIban;
    }

    public function setGetinIban(?string $getinIban): self
    {
        $this->getinIban = $getinIban;

        return $this;
    }

    public function getGetinPin(): ?string
    {
        return $this->getinPin;
    }

    public function setGetinPin(?string $getinPin): self
    {
        $this->getinPin = $getinPin;

        return $this;
    }

    public function getTaxno(): ?string
    {
        return $this->taxno;
    }

    public function setTaxno(?string $taxno): self
    {
        $this->taxno = $taxno;

        return $this;
    }

    public function getWagetaxno(): ?string
    {
        return $this->wagetaxno;
    }

    public function setWagetaxno(?string $wagetaxno): self
    {
        $this->wagetaxno = $wagetaxno;

        return $this;
    }

    public function getHrdivision(): ?string
    {
        return $this->hrdivision;
    }

    public function setHrdivision(string $hrdivision): self
    {
        $this->hrdivision = $hrdivision;

        return $this;
    }

    public function getHrno(): ?string
    {
        return $this->hrno;
    }

    public function setHrno(?string $hrno): self
    {
        $this->hrno = $hrno;

        return $this;
    }

    public function getAokno(): ?string
    {
        return $this->aokno;
    }

    public function setAokno(?string $aokno): self
    {
        $this->aokno = $aokno;

        return $this;
    }

    public function getDakno(): ?string
    {
        return $this->dakno;
    }

    public function setDakno(?string $dakno): self
    {
        $this->dakno = $dakno;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getTruckCostKm()
    {
        return $this->truckCostKm;
    }

    public function setTruckCostKm($truckCostKm): self
    {
        $this->truckCostKm = $truckCostKm;

        return $this;
    }

    public function getTruckCostInsurance()
    {
        return $this->truckCostInsurance;
    }

    public function setTruckCostInsurance($truckCostInsurance): self
    {
        $this->truckCostInsurance = $truckCostInsurance;

        return $this;
    }

    public function getTruckCostFix()
    {
        return $this->truckCostFix;
    }

    public function setTruckCostFix($truckCostFix): self
    {
        $this->truckCostFix = $truckCostFix;

        return $this;
    }

    public function getMinordervalue()
    {
        return $this->minordervalue;
    }

    public function setMinordervalue($minordervalue): self
    {
        $this->minordervalue = $minordervalue;

        return $this;
    }

    public function getCarriagefree()
    {
        return $this->carriagefree;
    }

    public function setCarriagefree($carriagefree): self
    {
        $this->carriagefree = $carriagefree;

        return $this;
    }

    public function getTermpayment(): ?int
    {
        return $this->termpayment;
    }

    public function setTermpayment(int $termpayment): self
    {
        $this->termpayment = $termpayment;

        return $this;
    }

    public function getM1Days(): ?bool
    {
        return $this->m1Days;
    }

    public function setM1Days(bool $m1Days): self
    {
        $this->m1Days = $m1Days;

        return $this;
    }

    public function getM2Days(): ?bool
    {
        return $this->m2Days;
    }

    public function setM2Days(bool $m2Days): self
    {
        $this->m2Days = $m2Days;

        return $this;
    }

    public function getM3Days(): ?bool
    {
        return $this->m3Days;
    }

    public function setM3Days(bool $m3Days): self
    {
        $this->m3Days = $m3Days;

        return $this;
    }

    public function getImHtaccess(): ?string
    {
        return $this->imHtaccess;
    }

    public function setImHtaccess(?string $imHtaccess): self
    {
        $this->imHtaccess = $imHtaccess;

        return $this;
    }

    public function getImHtaccessPassword(): ?string
    {
        return $this->imHtaccessPassword;
    }

    public function setImHtaccessPassword(?string $imHtaccessPassword): self
    {
        $this->imHtaccessPassword = $imHtaccessPassword;

        return $this;
    }

    public function getImUser(): ?string
    {
        return $this->imUser;
    }

    public function setImUser(?string $imUser): self
    {
        $this->imUser = $imUser;

        return $this;
    }

    public function getImUserPassword(): ?string
    {
        return $this->imUserPassword;
    }

    public function setImUserPassword(?string $imUserPassword): self
    {
        $this->imUserPassword = $imUserPassword;

        return $this;
    }

    public function getImAdmin(): ?string
    {
        return $this->imAdmin;
    }

    public function setImAdmin(?string $imAdmin): self
    {
        $this->imAdmin = $imAdmin;

        return $this;
    }

    public function getImAdminPassword(): ?string
    {
        return $this->imAdminPassword;
    }

    public function setImAdminPassword(?string $imAdminPassword): self
    {
        $this->imAdminPassword = $imAdminPassword;

        return $this;
    }

    public function getPostNummer(): ?int
    {
        return $this->postNummer;
    }

    public function setPostNummer(?int $postNummer): self
    {
        $this->postNummer = $postNummer;

        return $this;
    }

    public function getPostPassword(): ?string
    {
        return $this->postPassword;
    }

    public function setPostPassword(?string $postPassword): self
    {
        $this->postPassword = $postPassword;

        return $this;
    }

    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    public function setShopId(?int $shopId): self
    {
        $this->shopId = $shopId;

        return $this;
    }

    public function getTicketexternal(): ?bool
    {
        return $this->ticketexternal;
    }

    public function setTicketexternal(bool $ticketexternal): self
    {
        $this->ticketexternal = $ticketexternal;

        return $this;
    }

    public function getIplocal(): ?string
    {
        return $this->iplocal;
    }

    public function setIplocal(?string $iplocal): self
    {
        $this->iplocal = $iplocal;

        return $this;
    }

    public function getMysqluser(): ?string
    {
        return $this->mysqluser;
    }

    public function setMysqluser(?string $mysqluser): self
    {
        $this->mysqluser = $mysqluser;

        return $this;
    }

    public function getMysqlpassword(): ?string
    {
        return $this->mysqlpassword;
    }

    public function setMysqlpassword(?string $mysqlpassword): self
    {
        $this->mysqlpassword = $mysqlpassword;

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
