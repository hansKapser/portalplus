<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17PurchaseKkPositions
 *
 * @ORM\Table(name="p17_purchase_KK_positions", indexes={@ORM\Index(name="orderID", columns={"orderID"}), @ORM\Index(name="variation1_id", columns={"variation1_id"}), @ORM\Index(name="variation2_id", columns={"variation2_id"}), @ORM\Index(name="article_id", columns={"article_id"})})
 * @ORM\Entity
 */
class P17PurchaseKkPositions
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
     * @var string
     *
     * @ORM\Column(name="quantity_unit", type="string", length=5, nullable=false, options={"default"="Stk."})
     */
    private $quantityUnit = 'Stk.';

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=8, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $price = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="discount", type="decimal", precision=5, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $discount = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="sumPosition", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $sumposition = '0.00';

    /**
     * @var bool
     *
     * @ORM\Column(name="vat_id", type="boolean", nullable=false)
     */
    private $vatId = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="faultID", type="boolean", nullable=false)
     */
    private $faultid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="fault", type="string", length=50, nullable=true)
     */
    private $fault;

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
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var \P17PurchaseKk
     *
     * @ORM\ManyToOne(targetEntity="P17PurchaseKk")
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

    public function setQuantityUnit(string $quantityUnit): self
    {
        $this->quantityUnit = $quantityUnit;

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

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount($discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getSumposition()
    {
        return $this->sumposition;
    }

    public function setSumposition($sumposition): self
    {
        $this->sumposition = $sumposition;

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

    public function getFaultid(): ?bool
    {
        return $this->faultid;
    }

    public function setFaultid(bool $faultid): self
    {
        $this->faultid = $faultid;

        return $this;
    }

    public function getFault(): ?string
    {
        return $this->fault;
    }

    public function setFault(?string $fault): self
    {
        $this->fault = $fault;

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

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getOrderid(): ?P17PurchaseKk
    {
        return $this->orderid;
    }

    public function setOrderid(?P17PurchaseKk $orderid): self
    {
        $this->orderid = $orderid;

        return $this;
    }


}
