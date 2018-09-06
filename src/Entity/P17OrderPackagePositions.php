<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17OrderPackagePositions
 *
 * @ORM\Table(name="p17_order_package_positions", indexes={@ORM\Index(name="orderID", columns={"orderID"}), @ORM\Index(name="variation1_id", columns={"variation1_id"}), @ORM\Index(name="variation2_id", columns={"variation2_id"}), @ORM\Index(name="article_id", columns={"article_id"}), @ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17OrderPackagePositions
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
     * @ORM\Column(name="article_id", type="integer", nullable=false)
     */
    private $articleId;

    /**
     * @var string
     *
     * @ORM\Column(name="article_code", type="string", length=20, nullable=false)
     */
    private $articleCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="variation1_id", type="integer", nullable=false)
     */
    private $variation1Id = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="variation2_id", type="integer", nullable=false)
     */
    private $variation2Id = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="decimal", precision=8, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $quantity = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="quantity_unit", type="string", length=5, nullable=true)
     */
    private $quantityUnit;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="decimal", precision=8, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $weight = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="gross_weight", type="decimal", precision=5, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $grossWeight = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="string", length=30, nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=8, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $price = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="retourCredit", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $retourcredit;

    /**
     * @var bool
     *
     * @ORM\Column(name="vat_id", type="boolean", nullable=false, options={"default"="3"})
     */
    private $vatId = '3';

    /**
     * @var string|null
     *
     * @ORM\Column(name="user", type="string", length=25, nullable=true)
     */
    private $user;

    /**
     * @var int|null
     *
     * @ORM\Column(name="userID", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="examUserID", type="integer", nullable=true)
     */
    private $examuserid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var \P17Orderbook
     *
     * @ORM\ManyToOne(targetEntity="P17Orderbook")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="orderID", referencedColumnName="orderID")
     * })
     */
    private $orderid;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getArticleCode(): ?string
    {
        return $this->articleCode;
    }

    public function setArticleCode(string $articleCode): self
    {
        $this->articleCode = $articleCode;

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

    public function setQuantityUnit(?string $quantityUnit): self
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

    public function getGrossWeight()
    {
        return $this->grossWeight;
    }

    public function setGrossWeight($grossWeight): self
    {
        $this->grossWeight = $grossWeight;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

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

    public function getVatId(): ?bool
    {
        return $this->vatId;
    }

    public function setVatId(bool $vatId): self
    {
        $this->vatId = $vatId;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(?string $user): self
    {
        $this->user = $user;

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

    public function getExamuserid(): ?int
    {
        return $this->examuserid;
    }

    public function setExamuserid(?int $examuserid): self
    {
        $this->examuserid = $examuserid;

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

    public function getOrderid(): ?P17Orderbook
    {
        return $this->orderid;
    }

    public function setOrderid(?P17Orderbook $orderid): self
    {
        $this->orderid = $orderid;

        return $this;
    }


}
