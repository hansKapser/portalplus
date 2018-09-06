<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17User
 *
 * @ORM\Table(name="p17_user", uniqueConstraints={@ORM\UniqueConstraint(name="user", columns={"user"})}, indexes={@ORM\Index(name="profileID", columns={"profileID"}), @ORM\Index(name="p17_user_ibfk_1", columns={"classID"}), @ORM\Index(name="teamID", columns={"teamID"}), @ORM\Index(name="firmID", columns={"firmID"})})
 * @ORM\Entity
 */
class P17User
{
    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=25, nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var \P17UserClasses
     *
     * @ORM\ManyToOne(targetEntity="P17UserClasses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="classID", referencedColumnName="id")
     * })
     */
    private $classid;

    /**
     * @var \P17UserTeam
     *
     * @ORM\ManyToOne(targetEntity="P17UserTeam")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="teamID", referencedColumnName="id")
     * })
     */
    private $teamid;

    /**
     * @var \P17Firms
     *
     * @ORM\ManyToOne(targetEntity="P17Firms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="firmID", referencedColumnName="firmID")
     * })
     */
    private $firmid;

    /**
     * @var \P17UserProfiles
     *
     * @ORM\ManyToOne(targetEntity="P17UserProfiles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profileID", referencedColumnName="id")
     * })
     */
    private $profileid;

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getClassid(): ?P17UserClasses
    {
        return $this->classid;
    }

    public function setClassid(?P17UserClasses $classid): self
    {
        $this->classid = $classid;

        return $this;
    }

    public function getTeamid(): ?P17UserTeam
    {
        return $this->teamid;
    }

    public function setTeamid(?P17UserTeam $teamid): self
    {
        $this->teamid = $teamid;

        return $this;
    }

    public function getFirmid(): ?P17Firms
    {
        return $this->firmid;
    }

    public function setFirmid(?P17Firms $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }

    public function getProfileid(): ?P17UserProfiles
    {
        return $this->profileid;
    }

    public function setProfileid(?P17UserProfiles $profileid): self
    {
        $this->profileid = $profileid;

        return $this;
    }


}
