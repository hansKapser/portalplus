<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17FibuJournalid
 *
 * @ORM\Table(name="p17_fibu_journalID", indexes={@ORM\Index(name="ticketID", columns={"ticketID"}), @ORM\Index(name="mandantID", columns={"mandantID"})})
 * @ORM\Entity
 */
class P17FibuJournalid
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
     * @ORM\Column(name="ticketID", type="integer", nullable=false)
     */
    private $ticketid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="examUserID", type="integer", nullable=true)
     */
    private $examuserid;

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

    public function getTicketid(): ?int
    {
        return $this->ticketid;
    }

    public function setTicketid(int $ticketid): self
    {
        $this->ticketid = $ticketid;

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
