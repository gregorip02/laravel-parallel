<?php

namespace Stubleapp\Parallel;

use Closure;
use React\ChildProcess\Process;

interface TaskHandlerContract
{
    public function onData(Process $process): Closure;
    public function onExit(Process $process): Closure;
    public function onError(Process $process): Closure;
}
