<?php

namespace App\Entity;

use App\Repository\JobPositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobPositionRepository::class)
 */
class JobPosition
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
     * @ORM\Column(type="integer")
     */
    private $pricePerHour;

    /**
     * @ORM\OneToMany(targetEntity=Worker::class, mappedBy="jobPosition")
     */
    private $workers;

    public function __construct()
    {
        $this->workers = new ArrayCollection();
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

    public function getPricePerHour(): ?int
    {
        return $this->pricePerHour;
    }

    public function setPricePerHour(int $pricePerHour): self
    {
        $this->pricePerHour = $pricePerHour;

        return $this;
    }

    /**
     * @return Collection|Worker[]
     */
    public function getWorkers(): Collection
    {
        return $this->workers;
    }

    public function addWorker(Worker $worker): self
    {
        if (!$this->workers->contains($worker)) {
            $this->workers[] = $worker;
            $worker->setJobPosition($this);
        }

        return $this;
    }

    public function removeWorker(Worker $worker): self
    {
        if ($this->workers->removeElement($worker)) {
            // set the owning side to null (unless already changed)
            if ($worker->getJobPosition() === $this) {
                $worker->setJobPosition(null);
            }
        }

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'pricePerHour' => $this->getPricePerHour()
        ];
    }
}
