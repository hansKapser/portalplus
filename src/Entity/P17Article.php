<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Article
 *
 * @ORM\Table(name="p17_article", indexes={@ORM\Index(name="IDX_8C9EC47E4D16C4DD", columns={"firmID"}), @ORM\Index(name="IDX_8C9EC47EB5B63A6B", columns={"vat_id"}), @ORM\Index(name="article_code", columns={"article_code"}), @ORM\Index(name="kind", columns={"kind"}), @ORM\Index(name="group_id", columns={"group_id"})})
 * @ORM\Entity
 */
class P17Article
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
     * @ORM\Column(name="kind", type="string", length=2, nullable=false, options={"default"="S"})
     */
    private $kind = 'S';

    /**
     * @var bool
     *
     * @ORM\Column(name="isSet", type="boolean", nullable=false)
     */
    private $isset;

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var int
     *
     * @ORM\Column(name="vat_id", type="integer", nullable=false)
     */
    private $vatId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_en", type="string", length=100, nullable=false)
     */
    private $nameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=10, nullable=false)
     */
    private $shortName;

    /**
     * @var int
     *
     * @ORM\Column(name="fibu_account", type="integer", nullable=false, options={"default"="5100"})
     */
    private $fibuAccount = '5100';

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=96, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=255, nullable=false)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="delivery_days", type="integer", nullable=false)
     */
    private $deliveryDays;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var string|null
     *
     * @ORM\Column(name="old_price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $oldPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="article_code", type="string", length=25, nullable=false)
     */
    private $articleCode;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="special_offer_until", type="date", nullable=true)
     */
    private $specialOfferUntil;

    /**
     * @var string|null
     *
     * @ORM\Column(name="special_offer_price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $specialOfferPrice;

    /**
     * @var bool
     *
     * @ORM\Column(name="visible", type="boolean", nullable=false)
     */
    private $visible;

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
     * @var string
     *
     * @ORM\Column(name="retourCredit", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $retourcredit;

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
     * @var \P17ArticleGroup
     *
     * @ORM\ManyToOne(targetEntity="P17ArticleGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    private $group;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKind(): ?string
    {
        return $this->kind;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function getIsset(): ?bool
    {
        return $this->isset;
    }

    public function setIsset(bool $isset): self
    {
        $this->isset = $isset;

        return $this;
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

    public function getVatId(): ?int
    {
        return $this->vatId;
    }

    public function setVatId(int $vatId): self
    {
        $this->vatId = $vatId;

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

    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    public function setNameEn(string $nameEn): self
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getFibuAccount(): ?int
    {
        return $this->fibuAccount;
    }

    public function setFibuAccount(int $fibuAccount): self
    {
        $this->fibuAccount = $fibuAccount;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDeliveryDays(): ?int
    {
        return $this->deliveryDays;
    }

    public function setDeliveryDays(int $deliveryDays): self
    {
        $this->deliveryDays = $deliveryDays;

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

    public function getOldPrice()
    {
        return $this->oldPrice;
    }

    public function setOldPrice($oldPrice): self
    {
        $this->oldPrice = $oldPrice;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getArticleCode(): ?string
    {
        return $this->articleCode;
    }

    public function setArticleCode(string $articleCode): self
    {
        $this->articleCode = $articleCode;

        return $this;
    }

    public function getSpecialOfferUntil(): ?\DateTimeInterface
    {
        return $this->specialOfferUntil;
    }

    public function setSpecialOfferUntil(?\DateTimeInterface $specialOfferUntil): self
    {
        $this->specialOfferUntil = $specialOfferUntil;

        return $this;
    }

    public function getSpecialOfferPrice()
    {
        return $this->specialOfferPrice;
    }

    public function setSpecialOfferPrice($specialOfferPrice): self
    {
        $this->specialOfferPrice = $specialOfferPrice;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

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

    public function getRetourcredit()
    {
        return $this->retourcredit;
    }

    public function setRetourcredit($retourcredit): self
    {
        $this->retourcredit = $retourcredit;

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

    public function getGroup(): ?P17ArticleGroup
    {
        return $this->group;
    }

    public function setGroup(?P17ArticleGroup $group): self
    {
        $this->group = $group;

        return $this;
    }


}
