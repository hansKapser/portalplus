<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17UserProfiles
 *
 * @ORM\Table(name="p17_user_profiles", indexes={@ORM\Index(name="fk_users_firmID", columns={"firmID"})})
 * @ORM\Entity
 */
class P17UserProfiles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="autoPurchase", type="boolean", nullable=false)
     */
    private $autopurchase;

    /**
     * @var bool
     *
     * @ORM\Column(name="emailPurchase", type="boolean", nullable=false)
     */
    private $emailpurchase;

    /**
     * @var bool
     *
     * @ORM\Column(name="autoSale", type="boolean", nullable=false)
     */
    private $autosale;

    /**
     * @var bool
     *
     * @ORM\Column(name="emailSale", type="boolean", nullable=false)
     */
    private $emailsale;

    /**
     * @var bool
     *
     * @ORM\Column(name="autoStock", type="boolean", nullable=false)
     */
    private $autostock;

    /**
     * @var bool
     *
     * @ORM\Column(name="autoAccounting", type="boolean", nullable=false)
     */
    private $autoaccounting;

    /**
     * @var string
     *
     * @ORM\Column(name="hiddenMenu", type="string", length=50, nullable=false)
     */
    private $hiddenmenu;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAutopurchase(): ?bool
    {
        return $this->autopurchase;
    }

    public function setAutopurchase(bool $autopurchase): self
    {
        $this->autopurchase = $autopurchase;

        return $this;
    }

    public function getEmailpurchase(): ?bool
    {
        return $this->emailpurchase;
    }

    public function setEmailpurchase(bool $emailpurchase): self
    {
        $this->emailpurchase = $emailpurchase;

        return $this;
    }

    public function getAutosale(): ?bool
    {
        return $this->autosale;
    }

    public function setAutosale(bool $autosale): self
    {
        $this->autosale = $autosale;

        return $this;
    }

    public function getEmailsale(): ?bool
    {
        return $this->emailsale;
    }

    public function setEmailsale(bool $emailsale): self
    {
        $this->emailsale = $emailsale;

        return $this;
    }

    public function getAutostock(): ?bool
    {
        return $this->autostock;
    }

    public function setAutostock(bool $autostock): self
    {
        $this->autostock = $autostock;

        return $this;
    }

    public function getAutoaccounting(): ?bool
    {
        return $this->autoaccounting;
    }

    public function setAutoaccounting(bool $autoaccounting): self
    {
        $this->autoaccounting = $autoaccounting;

        return $this;
    }

    public function getHiddenmenu(): ?string
    {
        return $this->hiddenmenu;
    }

    public function setHiddenmenu(string $hiddenmenu): self
    {
        $this->hiddenmenu = $hiddenmenu;

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
