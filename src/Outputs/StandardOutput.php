<?php

namespace Stubleapp\Parallel\Outputs;

use Stubleapp\Parallel\Contracts\TaskLoggerContract;
use Stubleapp\Parallel\Task;

class StandardOutput implements TaskLoggerContract
{
    /**
     * Format the output data as string.
     */
    public function format(Task $task, string|array $data): string
    {
        return $this->native(...func_get_args());
    }

    /**
     * Get the output in "native" format.
     */
    protected function native(Task $task, string|array $data): string
    {
        return sprintf('name: %s, pid: %s, message: %s', ...[
            $task->name(),
            $task->process()->getPid(),
            json_encode($data)
        ]);
    }
}
