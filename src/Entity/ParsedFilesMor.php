<?php

namespace App\Entity;

use App\Repository\ParsedFilesMorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParsedFilesMorRepository::class)
 */
class ParsedFilesMor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $recordTypeCode;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mbi;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $initial;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dob_string;

    /**
     * @ORM\Column(type="smallint")
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description_string;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecordTypeCode(): ?string
    {
        return $this->recordTypeCode;
    }

    public function setRecordTypeCode(string $recordTypeCode): self
    {
        $this->recordTypeCode = $recordTypeCode;

        return $this;
    }

    public function getMbi(): ?string
    {
        return $this->mbi;
    }

    public function setMbi(string $mbi): self
    {
        $this->mbi = $mbi;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getInitial(): ?string
    {
        return $this->initial;
    }

    public function setInitial(string $initial): self
    {
        $this->initial = $initial;

        return $this;
    }

    public function getDobString(): ?string
    {
        return $this->dob_string;
    }

    public function setDobString(string $dob_string): self
    {
        $this->dob_string = $dob_string;

        return $this;
    }

    public function getSex(): ?int
    {
        return $this->sex;
    }

    public function setSex(int $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getDescriptionString(): ?string
    {
        return $this->description_string;
    }

    public function setDescriptionString(string $description_string): self
    {
        $this->description_string = $description_string;

        return $this;
    }
}
