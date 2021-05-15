<?php

namespace Stubleapp\Parallel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use React\ChildProcess\Process;
use React\EventLoop\Factory;
use Stubleapp\Parallel\Task;

class RunParallelCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    public $signature = 'parallel:run {--tags=} {--format=standard}';

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

        foreach ($this->configuredTasks() as $task) {
            $task = Task::fromArray($task);

            $task->setDefaultFormat($this->option('format'));

            if ($task->shouldRun($this->getTagsFromAguments())) {
                $process = new Process($task->command());
                $process->start($loop);

                $task->setProcess($process);

                // Process I/O handlers.
                $task->write('Running...');
                $process->stdout->on('data', fn ($message) => $task->write($message));
                $process->stdout->on('error', fn ($message) => $task->write($message));
            }
        }

        $loop->run();
    }

    /**
     * Get flat array of tasks defined in the configuration file.
     */
    public function configuredTasks(): array
    {
        return Config::get('parallel.tasks', []);
    }

    /**
     * Converts the option tags into array.
     */
    public function getTagsFromAguments(): array
    {
        $tags = (string) $this->option('tags');

        return array_filter(explode(',', $tags));
    }
}
