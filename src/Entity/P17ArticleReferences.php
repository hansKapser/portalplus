<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17ArticleReferences
 *
 * @ORM\Table(name="p17_article_references")
 * @ORM\Entity
 */
class P17ArticleReferences
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
     * @ORM\Column(name="article_id", type="integer", nullable=false)
     */
    private $articleId;

    /**
     * @var int
     *
     * @ORM\Column(name="supplier_firmID", type="integer", nullable=false)
     */
    private $supplierFirmid;

    /**
     * @var int
     *
     * @ORM\Column(name="supplier_article_id", type="integer", nullable=false)
     */
    private $supplierArticleId;

    /**
     * @var int
     *
     * @ORM\Column(name="supplier_variation1_id", type="integer", nullable=false)
     */
    private $supplierVariation1Id;

    /**
     * @var int
     *
     * @ORM\Column(name="supplier_variation2_id", type="integer", nullable=false)
     */
    private $supplierVariation2Id;

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

    public function getFirmid(): ?int
    {
        return $this->firmid;
    }

    public function setFirmid(int $firmid): self
    {
        $this->firmid = $firmid;

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

    public function getSupplierFirmid(): ?int
    {
        return $this->supplierFirmid;
    }

    public function setSupplierFirmid(int $supplierFirmid): self
    {
        $this->supplierFirmid = $supplierFirmid;

        return $this;
    }

    public function getSupplierArticleId(): ?int
    {
        return $this->supplierArticleId;
    }

    public function setSupplierArticleId(int $supplierArticleId): self
    {
        $this->supplierArticleId = $supplierArticleId;

        return $this;
    }

    public function getSupplierVariation1Id(): ?int
    {
        return $this->supplierVariation1Id;
    }

    public function setSupplierVariation1Id(int $supplierVariation1Id): self
    {
        $this->supplierVariation1Id = $supplierVariation1Id;

        return $this;
    }

    public function getSupplierVariation2Id(): ?int
    {
        return $this->supplierVariation2Id;
    }

    public function setSupplierVariation2Id(int $supplierVariation2Id): self
    {
        $this->supplierVariation2Id = $supplierVariation2Id;

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
