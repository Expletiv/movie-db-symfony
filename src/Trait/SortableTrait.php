<?php

namespace App\Trait;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use ReflectionClass;

trait SortableTrait
{
    #[Gedmo\SortablePosition]
    #[ORM\Column]
    private int $position = 0;

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function positionUp(): static
    {
        if (0 === $this->position) {
            return $this;
        }
        --$this->position;

        return $this;
    }

    public function positionDown(): static
    {
        ++$this->position;

        return $this;
    }

    public function getSortableGroup(): ?object
    {
        $reflectionClass = new ReflectionClass($this);

        foreach ($reflectionClass->getProperties() as $property) {
            if ($property->getAttributes(Gedmo\SortableGroup::class)) {
                return $property->getValue($this);
            }
        }

        return null;
    }

    public function getSortableGroupName(): ?string
    {
        $reflectionClass = new ReflectionClass($this);

        foreach ($reflectionClass->getProperties() as $property) {
            if ($property->getAttributes(Gedmo\SortableGroup::class)) {
                return $property->getName();
            }
        }

        return null;
    }
}
