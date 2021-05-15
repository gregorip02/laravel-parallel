<?php

namespace Stubleapp\Parallel;

use Exception;
use Illuminate\Support\Arr;
use React\ChildProcess\Process;
use Stubleapp\Parallel\Contracts\TaskLoggerContract;
use Stubleapp\Parallel\Outputs\JsonOutput;
use Stubleapp\Parallel\Outputs\StandardOutput;

class Task
{
    private Process $process;

    /**
     * Default output format.
     */
    private const DEFAULT_OUTPUT_FORMAT = 'standard';

    /**
     * Class instance.
     */
    public function __construct(
        private string $command,
        private string $name = '',
        private array $tags = [],
        private string | TaskLoggerContract $format = self::DEFAULT_OUTPUT_FORMAT
    ) {
    }

    /**
     * Static class instance from array.
     */
    public static function fromArray(array $arr): self
    {
        return new Task(...Arr::only($arr, ['command', 'name', 'tags']));
    }

    /**
     * Determine if the task should run.
     */
    public function shouldRun(array $tags = []): bool
    {
        return empty($tags) || count(array_intersect($this->tags(), $tags)) > 0;
    }

    /**
     * Get the command name.
     */
    public function name(): string
    {
        return $this->name ?: $this->command;
    }

    /**
     * Get the command body.
     */
    public function command(): string
    {
        return $this->command;
    }

    /**
     * Get the command tag.
     */
    public function tags(): array
    {
        return $this->tags;
    }

    /**
     * Get or create a logger instance.
     */
    public function logger(): TaskLoggerContract
    {
        $format = $this->format;

        if ($format instanceof TaskLoggerContract) {
            return $format;
        }

        $format = $format ?: 'default';

        if (! class_exists($format)) {
            $format = match ($format) {
                'json' => JsonOutput::class,
                'standard' => StandardOutput::class,
                default => StandardOutput::class,
            };
        }

        $this->format = new $format();

        if (! $this->format instanceof TaskLoggerContract) {
            throw new Exception(sprintf('The class [%s] does not implements TaskLoggerContract', $format));
        }

        return $this->format;
    }

    /**
     * Set the task process.
     */
    public function setProcess(Process $process)
    {
        $this->process = $process;
    }

    /**
     * Get the task process.
     */
    public function process(): Process
    {
        return $this->process;
    }

    /**
     * Change and instance a different format.
     */
    public function setDefaultFormat(string $format): void
    {
        if ($format !== self::DEFAULT_OUTPUT_FORMAT) {
            $this->format = $format;
            $this->logger();
        }
    }

    /**
     * Handle task logs.
     */
    public function write(string | array $message): void
    {
        $message = $this->logger()->format($this, $message);

        // TODO: Implement colors ;)
        print($message);
        print(PHP_EOL);
    }
}
