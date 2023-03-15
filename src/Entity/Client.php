<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Check::class, mappedBy="client")
     */
    private $checks;

    public function __construct()
    {
        $this->checks = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Check>
     */
    public function getChecks(): Collection
    {
        return $this->checks;
    }

    public function addCheck(Check $check): self
    {
        if (!$this->checks->contains($check)) {
            $this->checks[] = $check;
            $check->setClient($this);
        }

        return $this;
    }

    public function removeCheck(Check $check): self
    {
        if ($this->checks->removeElement($check)) {
            // set the owning side to null (unless already changed)
            if ($check->getClient() === $this) {
                $check->setClient(null);
            }
        }

        return $this;
    }
}
