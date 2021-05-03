<?php

namespace Stubleapp\Parallel;

use Illuminate\Console\Command;
use React\ChildProcess\Process;
use React\EventLoop\Factory;

final class RunParallelCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    public $signature = 'parallel:run';

    /**
     * The console command description.
     */
    public $description = 'Start running your tasks';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $loop = Factory::create();

        $tasks = array_map(function (array $task): Task {
            return new Task(
                tag: $task['tag'] ?? null,
                name: $task['name'] ?? null,
                command: $task['command'],
            );
        }, config('parallel.tasks'));

        foreach ($tasks as $task) {
            $process = new Process($task->command());
            $process->start($loop);

            // Message at the beginning of the process.
            $message = $task->format('Running', $process);
            $this->info($message);

            // Process I/O handlers.
            $process->stdout->on('data', $task->onData($process));
            $process->stderr->on('error', $task->onError($process));
            $process->on('exit', $task->onExit($process));
        }

        $loop->run();
    }
}
