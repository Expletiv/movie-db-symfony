<?php

namespace App\Entity\Interface;

interface Sortable
{
    public function getPosition(): int;

    public function setPosition(int $position): static;

    public function positionUp(): static;

    public function positionDown(): static;

    public function getSortableGroup(): ?object;

    public function getSortableGroupName(): ?string;
}
