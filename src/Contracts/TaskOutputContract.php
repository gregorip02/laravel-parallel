<?php

namespace Stubleapp\Parallel\Contracts;

use Stubleapp\Parallel\Task;

interface TaskOutputContract
{
    public function format(Task $task, string | array $message): string;
}
