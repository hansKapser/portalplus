<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FirmsDocuments
 *
 * @ORM\Table(name="p17_firms_documents", uniqueConstraints={@ORM\UniqueConstraint(name="firmID", columns={"firmID"})}, indexes={@ORM\Index(name="folderID", columns={"folderID"})})
 * @ORM\Entity
 */
class P17FirmsDocuments
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
     * @ORM\Column(name="content", type="blob", length=0, nullable=false)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="size", type="integer", nullable=false)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;

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
     * @var \P17FirmsDocumentsFolder
     *
     * @ORM\ManyToOne(targetEntity="P17FirmsDocumentsFolder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="folderID", referencedColumnName="id")
     * })
     */
    private $folderid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): self
    {
        $this->content = $content;

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

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getFolderid(): ?P17FirmsDocumentsFolder
    {
        return $this->folderid;
    }

    public function setFolderid(?P17FirmsDocumentsFolder $folderid): self
    {
        $this->folderid = $folderid;

        return $this;
    }


}
