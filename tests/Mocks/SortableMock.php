<?php

namespace App\Tests\Mocks;

use App\Entity\Interface\Sortable;
use App\Trait\SortableTrait;

class SortableMock implements Sortable
{
    use SortableTrait;

    public function getSortableGroup(): ?object
    {
        return $this;
    }

    public function getSortableGroupName(): ?string
    {
        return 'group';
    }
}
