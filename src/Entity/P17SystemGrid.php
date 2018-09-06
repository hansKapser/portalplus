<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17SystemGrid
 *
 * @ORM\Table(name="p17_system_grid")
 * @ORM\Entity
 */
class P17SystemGrid
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
     * @ORM\Column(name="modul", type="string", length=50, nullable=false)
     */
    private $modul;

    /**
     * @var string
     *
     * @ORM\Column(name="objGrid", type="text", length=0, nullable=false)
     */
    private $objgrid;

    /**
     * @var string
     *
     * @ORM\Column(name="toolbar", type="text", length=0, nullable=false)
     */
    private $toolbar;

    /**
     * @var string
     *
     * @ORM\Column(name="colModel", type="text", length=0, nullable=false)
     */
    private $colmodel;

    /**
     * @var string
     *
     * @ORM\Column(name="dataModel", type="text", length=0, nullable=false)
     */
    private $datamodel;

    /**
     * @var string
     *
     * @ORM\Column(name="groupModel", type="text", length=0, nullable=false)
     */
    private $groupmodel;

    /**
     * @var string
     *
     * @ORM\Column(name="dialogModel", type="text", length=0, nullable=false)
     */
    private $dialogmodel;

    /**
     * @var string
     *
     * @ORM\Column(name="dialogBoxes", type="text", length=0, nullable=false)
     */
    private $dialogboxes;

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

    public function getModul(): ?string
    {
        return $this->modul;
    }

    public function setModul(string $modul): self
    {
        $this->modul = $modul;

        return $this;
    }

    public function getObjgrid(): ?string
    {
        return $this->objgrid;
    }

    public function setObjgrid(string $objgrid): self
    {
        $this->objgrid = $objgrid;

        return $this;
    }

    public function getToolbar(): ?string
    {
        return $this->toolbar;
    }

    public function setToolbar(string $toolbar): self
    {
        $this->toolbar = $toolbar;

        return $this;
    }

    public function getColmodel(): ?string
    {
        return $this->colmodel;
    }

    public function setColmodel(string $colmodel): self
    {
        $this->colmodel = $colmodel;

        return $this;
    }

    public function getDatamodel(): ?string
    {
        return $this->datamodel;
    }

    public function setDatamodel(string $datamodel): self
    {
        $this->datamodel = $datamodel;

        return $this;
    }

    public function getGroupmodel(): ?string
    {
        return $this->groupmodel;
    }

    public function setGroupmodel(string $groupmodel): self
    {
        $this->groupmodel = $groupmodel;

        return $this;
    }

    public function getDialogmodel(): ?string
    {
        return $this->dialogmodel;
    }

    public function setDialogmodel(string $dialogmodel): self
    {
        $this->dialogmodel = $dialogmodel;

        return $this;
    }

    public function getDialogboxes(): ?string
    {
        return $this->dialogboxes;
    }

    public function setDialogboxes(string $dialogboxes): self
    {
        $this->dialogboxes = $dialogboxes;

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
