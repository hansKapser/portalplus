<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17ArticleSet
 *
 * @ORM\Table(name="p17_article_set", indexes={@ORM\Index(name="id", columns={"set_article_id"}), @ORM\Index(name="article_id", columns={"article_id"})})
 * @ORM\Entity
 */
class P17ArticleSet
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
     * @ORM\Column(name="set_variation1_id", type="integer", nullable=false)
     */
    private $setVariation1Id;

    /**
     * @var int
     *
     * @ORM\Column(name="set_variation2_id", type="integer", nullable=false)
     */
    private $setVariation2Id;

    /**
     * @var int
     *
     * @ORM\Column(name="article_id", type="integer", nullable=false)
     */
    private $articleId;

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
     * @ORM\Column(name="quantity", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity_unit", type="string", length=5, nullable=false)
     */
    private $quantityUnit;

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
     *   @ORM\JoinColumn(name="set_article_id", referencedColumnName="id")
     * })
     */
    private $setArticle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSetVariation1Id(): ?int
    {
        return $this->setVariation1Id;
    }

    public function setSetVariation1Id(int $setVariation1Id): self
    {
        $this->setVariation1Id = $setVariation1Id;

        return $this;
    }

    public function getSetVariation2Id(): ?int
    {
        return $this->setVariation2Id;
    }

    public function setSetVariation2Id(int $setVariation2Id): self
    {
        $this->setVariation2Id = $setVariation2Id;

        return $this;
    }

    public function getArticleId(): ?int
    {
        return $this->articleId;
    }

    public function setArticleId(int $articleId): self
    {
        $this->articleId = $articleId;

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

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getQuantityUnit(): ?string
    {
        return $this->quantityUnit;
    }

    public function setQuantityUnit(string $quantityUnit): self
    {
        $this->quantityUnit = $quantityUnit;

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

    public function getSetArticle(): ?P17Article
    {
        return $this->setArticle;
    }

    public function setSetArticle(?P17Article $setArticle): self
    {
        $this->setArticle = $setArticle;

        return $this;
    }


}
