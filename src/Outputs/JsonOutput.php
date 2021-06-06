<?php

namespace Stubleapp\Parallel\Outputs;

use Stubleapp\Parallel\Contracts\TaskOutputContract;
use Stubleapp\Parallel\Task;

class JsonOutput implements TaskOutputContract
{
    /**
     * Format the output data as string.
     */
    public function format(Task $task, string | array $message): string
    {
        return json_encode($this->native(...func_get_args()));
    }

    /**
     * Get the output in "native" format.
     */
    protected function native(Task $task, string | array $data): array
    {
        return [
            'name' => $task->name(),
            'pid' => $task->process()->getPid(),
            'message' => json_encode($data)
        ];
    }
}
