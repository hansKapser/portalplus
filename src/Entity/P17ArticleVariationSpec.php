<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17ArticleVariationSpec
 *
 * @ORM\Table(name="p17_article_variation_spec", uniqueConstraints={@ORM\UniqueConstraint(name="variation1_id", columns={"variation1_id", "variation2_id", "article_id"})}, indexes={@ORM\Index(name="article_id", columns={"article_id"})})
 * @ORM\Entity
 */
class P17ArticleVariationSpec
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
     * @ORM\Column(name="quantity_unit", type="string", length=5, nullable=false)
     */
    private $quantityUnit;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="decimal", precision=8, scale=3, nullable=false)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="retourCredit", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $retourcredit;

    /**
     * @var bool
     *
     * @ORM\Column(name="inventory", type="boolean", nullable=false)
     */
    private $inventory;

    /**
     * @var string
     *
     * @ORM\Column(name="min_stock", type="decimal", precision=8, scale=3, nullable=false)
     */
    private $minStock;

    /**
     * @var string
     *
     * @ORM\Column(name="max_stock", type="decimal", precision=8, scale=3, nullable=false)
     */
    private $maxStock;

    /**
     * @var string
     *
     * @ORM\Column(name="reorder_stock", type="decimal", precision=8, scale=3, nullable=false)
     */
    private $reorderStock;

    /**
     * @var string
     *
     * @ORM\Column(name="purchase_quantity", type="decimal", precision=8, scale=3, nullable=false)
     */
    private $purchaseQuantity;

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

    public function getQuantityUnit(): ?string
    {
        return $this->quantityUnit;
    }

    public function setQuantityUnit(string $quantityUnit): self
    {
        $this->quantityUnit = $quantityUnit;

        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRetourcredit()
    {
        return $this->retourcredit;
    }

    public function setRetourcredit($retourcredit): self
    {
        $this->retourcredit = $retourcredit;

        return $this;
    }

    public function getInventory(): ?bool
    {
        return $this->inventory;
    }

    public function setInventory(bool $inventory): self
    {
        $this->inventory = $inventory;

        return $this;
    }

    public function getMinStock()
    {
        return $this->minStock;
    }

    public function setMinStock($minStock): self
    {
        $this->minStock = $minStock;

        return $this;
    }

    public function getMaxStock()
    {
        return $this->maxStock;
    }

    public function setMaxStock($maxStock): self
    {
        $this->maxStock = $maxStock;

        return $this;
    }

    public function getReorderStock()
    {
        return $this->reorderStock;
    }

    public function setReorderStock($reorderStock): self
    {
        $this->reorderStock = $reorderStock;

        return $this;
    }

    public function getPurchaseQuantity()
    {
        return $this->purchaseQuantity;
    }

    public function setPurchaseQuantity($purchaseQuantity): self
    {
        $this->purchaseQuantity = $purchaseQuantity;

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
