<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17ArticleImages
 *
 * @ORM\Table(name="p17_article_images", uniqueConstraints={@ORM\UniqueConstraint(name="firmID", columns={"firmID", "article_id", "variation1_id", "variation2_id"})}, indexes={@ORM\Index(name="article_id", columns={"article_id"})})
 * @ORM\Entity
 */
class P17ArticleImages
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
     * @var int
     *
     * @ORM\Column(name="variation1_id", type="integer", nullable=false)
     */
    private $variation1Id;

    /**
     * @var int
     *
     * @ORM\Column(name="variation2_id", type="integer", nullable=false)
     */
    private $variation2Id;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

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
     * @var \P17Article
     *
     * @ORM\ManyToOne(targetEntity="P17Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     * })
     */
    private $article;

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

    public function getVariation1Id(): ?int
    {
        return $this->variation1Id;
    }

    public function setVariation1Id(int $variation1Id): self
    {
        $this->variation1Id = $variation1Id;

        return $this;
    }

    public function getVariation2Id(): ?int
    {
        return $this->variation2Id;
    }

    public function setVariation2Id(int $variation2Id): self
    {
        $this->variation2Id = $variation2Id;

        return $this;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getArticle(): ?P17Article
    {
        return $this->article;
    }

    public function setArticle(?P17Article $article): self
    {
        $this->article = $article;

        return $this;
    }


}
