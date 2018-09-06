<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Distances
 *
 * @ORM\Table(name="p17_distances", indexes={@ORM\Index(name="plz1", columns={"postcode1", "postcode2"}), @ORM\Index(name="plz2", columns={"postcode2", "postcode1"})})
 * @ORM\Entity
 */
class P17Distances
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
     * @ORM\Column(name="postcode1", type="string", length=5, nullable=false)
     */
    private $postcode1;

    /**
     * @var string
     *
     * @ORM\Column(name="city1", type="string", length=50, nullable=false)
     */
    private $city1;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode2", type="string", length=5, nullable=false)
     */
    private $postcode2;

    /**
     * @var string
     *
     * @ORM\Column(name="city2", type="string", length=50, nullable=false)
     */
    private $city2;

    /**
     * @var int
     *
     * @ORM\Column(name="km", type="integer", nullable=false)
     */
    private $km = '0';

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

    public function getPostcode1(): ?string
    {
        return $this->postcode1;
    }

    public function setPostcode1(string $postcode1): self
    {
        $this->postcode1 = $postcode1;

        return $this;
    }

    public function getCity1(): ?string
    {
        return $this->city1;
    }

    public function setCity1(string $city1): self
    {
        $this->city1 = $city1;

        return $this;
    }

    public function getPostcode2(): ?string
    {
        return $this->postcode2;
    }

    public function setPostcode2(string $postcode2): self
    {
        $this->postcode2 = $postcode2;

        return $this;
    }

    public function getCity2(): ?string
    {
        return $this->city2;
    }

    public function setCity2(string $city2): self
    {
        $this->city2 = $city2;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;

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
