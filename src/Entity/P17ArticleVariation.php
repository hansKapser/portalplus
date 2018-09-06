<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17ArticleVariation
 *
 * @ORM\Table(name="p17_article_variation", indexes={@ORM\Index(name="IDX_571053DDDC3D4F5B", columns={"variation_group_id"})})
 * @ORM\Entity
 */
class P17ArticleVariation
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

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
     * @var \P17ArticleVariationGroup
     *
     * @ORM\ManyToOne(targetEntity="P17ArticleVariationGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="variation_group_id", referencedColumnName="id")
     * })
     */
    private $variationGroup;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getVariationGroup(): ?P17ArticleVariationGroup
    {
        return $this->variationGroup;
    }

    public function setVariationGroup(?P17ArticleVariationGroup $variationGroup): self
    {
        $this->variationGroup = $variationGroup;

        return $this;
    }


}
