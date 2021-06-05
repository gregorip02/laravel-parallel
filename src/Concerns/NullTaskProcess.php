<?php

namespace Stubleapp\Parallel\Concerns;

use Stubleapp\Parallel\Contracts\TaskProcessContract;

class NullTaskProcess implements TaskProcessContract
{
    public function getPid(): ?int
    {
        return null;
    }
}
