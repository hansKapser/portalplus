<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17WorkflowMaster
 *
 * @ORM\Table(name="p17_workflow_master", indexes={@ORM\Index(name="firmID", columns={"firmID"})})
 * @ORM\Entity
 */
class P17WorkflowMaster
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
     * @ORM\Column(name="voucher", type="string", length=50, nullable=false)
     */
    private $voucher;

    /**
     * @var string
     *
     * @ORM\Column(name="division", type="string", length=2, nullable=false)
     */
    private $division;

    /**
     * @var string
     *
     * @ORM\Column(name="workflow", type="string", length=100, nullable=false)
     */
    private $workflow;

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

    public function getVoucher(): ?string
    {
        return $this->voucher;
    }

    public function setVoucher(string $voucher): self
    {
        $this->voucher = $voucher;

        return $this;
    }

    public function getDivision(): ?string
    {
        return $this->division;
    }

    public function setDivision(string $division): self
    {
        $this->division = $division;

        return $this;
    }

    public function getWorkflow(): ?string
    {
        return $this->workflow;
    }

    public function setWorkflow(string $workflow): self
    {
        $this->workflow = $workflow;

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
