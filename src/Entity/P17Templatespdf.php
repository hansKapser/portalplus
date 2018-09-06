<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Templatespdf
 *
 * @ORM\Table(name="p17_templatesPdf")
 * @ORM\Entity
 */
class P17Templatespdf
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
     * @ORM\Column(name="division", type="string", length=2, nullable=false)
     */
    private $division;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content_de", type="blob", length=0, nullable=false)
     */
    private $contentDe;

    /**
     * @var string
     *
     * @ORM\Column(name="content_en", type="blob", length=65535, nullable=false)
     */
    private $contentEn;

    /**
     * @var string
     *
     * @ORM\Column(name="contentText_de", type="text", length=0, nullable=false)
     */
    private $contenttextDe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contentText_en", type="text", length=0, nullable=true)
     */
    private $contenttextEn;

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

    public function getDivision(): ?string
    {
        return $this->division;
    }

    public function setDivision(string $division): self
    {
        $this->division = $division;

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

    public function getContentDe()
    {
        return $this->contentDe;
    }

    public function setContentDe($contentDe): self
    {
        $this->contentDe = $contentDe;

        return $this;
    }

    public function getContentEn()
    {
        return $this->contentEn;
    }

    public function setContentEn($contentEn): self
    {
        $this->contentEn = $contentEn;

        return $this;
    }

    public function getContenttextDe(): ?string
    {
        return $this->contenttextDe;
    }

    public function setContenttextDe(string $contenttextDe): self
    {
        $this->contenttextDe = $contenttextDe;

        return $this;
    }

    public function getContenttextEn(): ?string
    {
        return $this->contenttextEn;
    }

    public function setContenttextEn(?string $contenttextEn): self
    {
        $this->contenttextEn = $contenttextEn;

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
