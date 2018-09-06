<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17UserActivities
 *
 * @ORM\Table(name="p17_user_activities")
 * @ORM\Entity
 */
class P17UserActivities
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
     * @ORM\Column(name="userID", type="integer", nullable=false)
     */
    private $userid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var string|null
     *
     * @ORM\Column(name="p17_table", type="string", length=50, nullable=true)
     */
    private $p17Table;

    /**
     * @var int|null
     *
     * @ORM\Column(name="table_id", type="integer", nullable=true)
     */
    private $tableId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="action", type="string", length=50, nullable=true)
     */
    private $action;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
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

    public function getP17Table(): ?string
    {
        return $this->p17Table;
    }

    public function setP17Table(?string $p17Table): self
    {
        $this->p17Table = $p17Table;

        return $this;
    }

    public function getTableId(): ?int
    {
        return $this->tableId;
    }

    public function setTableId(?int $tableId): self
    {
        $this->tableId = $tableId;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(?string $action): self
    {
        $this->action = $action;

        return $this;
    }


}
