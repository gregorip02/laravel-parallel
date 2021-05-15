<?php

namespace Stubleapp\Parallel\Contracts;

use Stubleapp\Parallel\Task;

interface TaskLoggerContract
{
    public function format(Task $task, string|array $message): string;
}
