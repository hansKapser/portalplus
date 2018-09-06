<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17StockTransaction
 *
 * @ORM\Table(name="p17_stock_transaction", indexes={@ORM\Index(name="transaction", columns={"transaction", "article_id", "variation1_id", "variation2_id"}), @ORM\Index(name="positionID", columns={"positionID"}), @ORM\Index(name="examUserID", columns={"examUserID"}), @ORM\Index(name="positionID_2", columns={"positionID"}), @ORM\Index(name="orderID", columns={"orderID"}), @ORM\Index(name="ticketID", columns={"ticketID"}), @ORM\Index(name="date", columns={"date"})})
 * @ORM\Entity
 */
class P17StockTransaction
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="ticketID", type="integer", nullable=false)
     */
    private $ticketid;

    /**
     * @var int
     *
     * @ORM\Column(name="orderID", type="integer", nullable=false)
     */
    private $orderid;

    /**
     * @var string
     *
     * @ORM\Column(name="division", type="string", length=1, nullable=false)
     */
    private $division;

    /**
     * @var int
     *
     * @ORM\Column(name="positionID", type="integer", nullable=false)
     */
    private $positionid;

    /**
     * @var int
     *
     * @ORM\Column(name="article_id", type="integer", nullable=false)
     */
    private $articleId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="variation1_id", type="integer", nullable=true)
     */
    private $variation1Id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="variation2_id", type="integer", nullable=true)
     */
    private $variation2Id;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction", type="string", length=2, nullable=false)
     */
    private $transaction;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $quantity;

    /**
     * @var bool
     *
     * @ORM\Column(name="OK", type="boolean", nullable=false)
     */
    private $ok = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="oldDisponible", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $olddisponible = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="oldReal", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $oldreal = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="user", type="string", length=30, nullable=true)
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTicketid(): ?int
    {
        return $this->ticketid;
    }

    public function setTicketid(int $ticketid): self
    {
        $this->ticketid = $ticketid;

        return $this;
    }

    public function getOrderid(): ?int
    {
        return $this->orderid;
    }

    public function setOrderid(int $orderid): self
    {
        $this->orderid = $orderid;

        return $this;
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

    public function getPositionid(): ?int
    {
        return $this->positionid;
    }

    public function setPositionid(int $positionid): self
    {
        $this->positionid = $positionid;

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

    public function setVariation1Id(?int $variation1Id): self
    {
        $this->variation1Id = $variation1Id;

        return $this;
    }

    public function getVariation2Id(): ?int
    {
        return $this->variation2Id;
    }

    public function setVariation2Id(?int $variation2Id): self
    {
        $this->variation2Id = $variation2Id;

        return $this;
    }

    public function getTransaction(): ?string
    {
        return $this->transaction;
    }

    public function setTransaction(string $transaction): self
    {
        $this->transaction = $transaction;

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

    public function getOk(): ?bool
    {
        return $this->ok;
    }

    public function setOk(bool $ok): self
    {
        $this->ok = $ok;

        return $this;
    }

    public function getOlddisponible()
    {
        return $this->olddisponible;
    }

    public function setOlddisponible($olddisponible): self
    {
        $this->olddisponible = $olddisponible;

        return $this;
    }

    public function getOldreal()
    {
        return $this->oldreal;
    }

    public function setOldreal($oldreal): self
    {
        $this->oldreal = $oldreal;

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


}
