<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17PostParcelStation
 *
 * @ORM\Table(name="p17_post_parcel_station", indexes={@ORM\Index(name="postNumberSender", columns={"postNumberSender"}), @ORM\Index(name="postnumberReceiver", columns={"postNumberReceiver"})})
 * @ORM\Entity
 */
class P17PostParcelStation
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
     * @ORM\Column(name="eTAN", type="integer", nullable=false)
     */
    private $etan;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

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
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="blob", length=0, nullable=false)
     */
    private $content;

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
     * @var \P17PostUser
     *
     * @ORM\ManyToOne(targetEntity="P17PostUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="postNumberSender", referencedColumnName="postNumber")
     * })
     */
    private $postnumbersender;

    /**
     * @var \P17PostUser
     *
     * @ORM\ManyToOne(targetEntity="P17PostUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="postNumberReceiver", referencedColumnName="postNumber")
     * })
     */
    private $postnumberreceiver;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtan(): ?int
    {
        return $this->etan;
    }

    public function setEtan(int $etan): self
    {
        $this->etan = $etan;

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

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): self
    {
        $this->content = $content;

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

    public function getPostnumbersender(): ?P17PostUser
    {
        return $this->postnumbersender;
    }

    public function setPostnumbersender(?P17PostUser $postnumbersender): self
    {
        $this->postnumbersender = $postnumbersender;

        return $this;
    }

    public function getPostnumberreceiver(): ?P17PostUser
    {
        return $this->postnumberreceiver;
    }

    public function setPostnumberreceiver(?P17PostUser $postnumberreceiver): self
    {
        $this->postnumberreceiver = $postnumberreceiver;

        return $this;
    }


}
