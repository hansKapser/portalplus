<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FirmsApplication
 *
 * @ORM\Table(name="p17_firms_application")
 * @ORM\Entity
 */
class P17FirmsApplication
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
     * @var int
     *
     * @ORM\Column(name="applicationFirmID", type="integer", nullable=false)
     */
    private $applicationfirmid;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=20, nullable=false, options={"default"="Uebungsunternehmung"})
     */
    private $address = 'Uebungsunternehmung';

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=50, nullable=false)
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
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

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
     * @ORM\Column(name="BICP", type="string", length=20, nullable=true)
     */
    private $bicp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IBANP", type="string", length=50, nullable=true)
     */
    private $ibanp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="getin_IBAN", type="string", length=50, nullable=true)
     */
    private $getinIban;

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

    public function getApplicationfirmid(): ?int
    {
        return $this->applicationfirmid;
    }

    public function setApplicationfirmid(int $applicationfirmid): self
    {
        $this->applicationfirmid = $applicationfirmid;

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

    public function setCompany(string $company): self
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function getBicp(): ?string
    {
        return $this->bicp;
    }

    public function setBicp(?string $bicp): self
    {
        $this->bicp = $bicp;

        return $this;
    }

    public function getIbanp(): ?string
    {
        return $this->ibanp;
    }

    public function setIbanp(?string $ibanp): self
    {
        $this->ibanp = $ibanp;

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
