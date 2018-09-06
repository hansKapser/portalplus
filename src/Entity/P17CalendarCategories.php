<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17CalendarCategories
 *
 * @ORM\Table(name="p17_calendar_categories")
 * @ORM\Entity
 */
class P17CalendarCategories
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
     * @ORM\Column(name="name", type="string", length=20, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="statusRead", type="boolean", nullable=false)
     */
    private $statusread;

    /**
     * @var bool
     *
     * @ORM\Column(name="statusEdit", type="boolean", nullable=false)
     */
    private $statusedit;

    /**
     * @var bool
     *
     * @ORM\Column(name="statusDelete", type="boolean", nullable=false)
     */
    private $statusdelete;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=7, nullable=false, options={"default"="blue"})
     */
    private $color = 'blue';

    /**
     * @var string
     *
     * @ORM\Column(name="textColor", type="string", length=7, nullable=false, options={"default"="white"})
     */
    private $textcolor = 'white';

    /**
     * @var string
     *
     * @ORM\Column(name="backgroundColor", type="string", length=7, nullable=false, options={"default"="white"})
     */
    private $backgroundcolor = 'white';

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStatusread(): ?bool
    {
        return $this->statusread;
    }

    public function setStatusread(bool $statusread): self
    {
        $this->statusread = $statusread;

        return $this;
    }

    public function getStatusedit(): ?bool
    {
        return $this->statusedit;
    }

    public function setStatusedit(bool $statusedit): self
    {
        $this->statusedit = $statusedit;

        return $this;
    }

    public function getStatusdelete(): ?bool
    {
        return $this->statusdelete;
    }

    public function setStatusdelete(bool $statusdelete): self
    {
        $this->statusdelete = $statusdelete;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getTextcolor(): ?string
    {
        return $this->textcolor;
    }

    public function setTextcolor(string $textcolor): self
    {
        $this->textcolor = $textcolor;

        return $this;
    }

    public function getBackgroundcolor(): ?string
    {
        return $this->backgroundcolor;
    }

    public function setBackgroundcolor(string $backgroundcolor): self
    {
        $this->backgroundcolor = $backgroundcolor;

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
