<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17ExamFibuJournalid
 *
 * @ORM\Table(name="p17_exam_fibu_journalID", indexes={@ORM\Index(name="ticketID", columns={"orderID"}), @ORM\Index(name="mandantID", columns={"mandantID"})})
 * @ORM\Entity
 */
class P17ExamFibuJournalid
{
    /**
     * @var int
     *
     * @ORM\Column(name="journalID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $journalid;

    /**
     * @var int
     *
     * @ORM\Column(name="mandantID", type="integer", nullable=false)
     */
    private $mandantid;

    /**
     * @var int
     *
     * @ORM\Column(name="orderID", type="integer", nullable=false)
     */
    private $orderid;

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

    public function getJournalid(): ?int
    {
        return $this->journalid;
    }

    public function getMandantid(): ?int
    {
        return $this->mandantid;
    }

    public function setMandantid(int $mandantid): self
    {
        $this->mandantid = $mandantid;

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
