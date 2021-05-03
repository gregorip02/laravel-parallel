<?php

namespace Stubleapp\Parallel;

use Closure;
use Exception;
use React\ChildProcess\Process;

trait TaskHandler
{
    public function format(string $message, Process $process): string
    {
        $name = $this->name();

        $pid = $process->getPid();

        return "name: {$name}, pid: {$pid}, message: {$message}";
    }

    public function onData(Process $process): Closure
    {
        return function (mixed $data) use ($process): void {
            $message = $this->format($data, $process);

            print($message);
        };
    }

    public function onError(Process $process): Closure
    {
        return function (Exception $exception) use ($process): void {
            $message = $this->format($exception->getMessage(), $process);

            print($message);

            $process->close();
        };
    }

    public function onExit(Process $process): Closure
    {
        return function (int $code, ?string $signal = null) use ($process): void {
            $message = is_null($signal) ?: $this->format("Singal received {$signal}", $process);

            $message .= $this->format("Terminated with exit code {$code}" . PHP_EOL, $process);

            print($message);
        };
    }
}
