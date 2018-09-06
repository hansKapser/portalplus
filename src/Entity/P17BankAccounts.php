<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17BankAccounts
 *
 * @ORM\Table(name="p17_bank_accounts", indexes={@ORM\Index(name="firmID", columns={"firmID"}), @ORM\Index(name="IBAN", columns={"IBAN"}), @ORM\Index(name="BIC", columns={"BIC"})})
 * @ORM\Entity
 */
class P17BankAccounts
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
     * @var string
     *
     * @ORM\Column(name="IBAN", type="string", length=50, nullable=false)
     */
    private $iban;

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

    /**
     * @var \P17Banks
     *
     * @ORM\ManyToOne(targetEntity="P17Banks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="BIC", referencedColumnName="BIC")
     * })
     */
    private $bic;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBic(): ?P17Banks
    {
        return $this->bic;
    }

    public function setBic(?P17Banks $bic): self
    {
        $this->bic = $bic;

        return $this;
    }


}
