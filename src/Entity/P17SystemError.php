<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17SystemError
 *
 * @ORM\Table(name="p17_system_error", uniqueConstraints={@ORM\UniqueConstraint(name="file", columns={"file", "line"})})
 * @ORM\Entity
 */
class P17SystemError
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false)
     */
    private $datetime;

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=100, nullable=false)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="line", type="string", length=50, nullable=false)
     */
    private $line;

    /**
     * @var string
     *
     * @ORM\Column(name="function", type="string", length=100, nullable=false)
     */
    private $function;

    /**
     * @var string
     *
     * @ORM\Column(name="args", type="text", length=0, nullable=false)
     */
    private $args;

    /**
     * @var string
     *
     * @ORM\Column(name="error", type="text", length=0, nullable=false)
     */
    private $error;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirmid(): ?int
    {
        return $this->firmid;
    }

    public function setFirmid(int $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getLine(): ?string
    {
        return $this->line;
    }

    public function setLine(string $line): self
    {
        $this->line = $line;

        return $this;
    }

    public function getFunction(): ?string
    {
        return $this->function;
    }

    public function setFunction(string $function): self
    {
        $this->function = $function;

        return $this;
    }

    public function getArgs(): ?string
    {
        return $this->args;
    }

    public function setArgs(string $args): self
    {
        $this->args = $args;

        return $this;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function setError(string $error): self
    {
        $this->error = $error;

        return $this;
    }


}
