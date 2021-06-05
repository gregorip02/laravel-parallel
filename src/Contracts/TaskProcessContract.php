<?php

namespace Stubleapp\Parallel\Contracts;

interface TaskProcessContract
{
    public function getPid(): int | null;
}
