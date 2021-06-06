<?php

namespace Stubleapp\Parallel;

use Exception;
use Illuminate\Support\Arr;
use React\ChildProcess\Process;
use Stubleapp\Parallel\Concerns\NullTaskProcess;
use Stubleapp\Parallel\Contracts\TaskOutputContract;
use Stubleapp\Parallel\Contracts\TaskProcessContract;
use Stubleapp\Parallel\Outputs\JsonOutput;
use Stubleapp\Parallel\Outputs\StandardOutput;

class Task
{
    private TaskProcessContract | Process | null $process = null;

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
        private string | TaskOutputContract $format = self::DEFAULT_OUTPUT_FORMAT
    ) {
    }

    /**
     * Static class instance from array.
     */
    public static function fromArray(array $arr): self
    {
        return new Task(...Arr::only($arr, ['command', 'name', 'tags', 'format']));
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
    public function logger(): TaskOutputContract
    {
        $format = $this->format;

        if ($format instanceof TaskOutputContract) {
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

        if (! $this->format instanceof TaskOutputContract) {
            throw new Exception(sprintf('The class [%s] does not implements TaskOutputContract', $format));
        }

        return $this->format;
    }

    /**
     * Set the task process.
     */
    public function setProcess(Process $process): void
    {
        $this->process = $process;
    }

    /**
     * Get the task process.
     */
    public function process(): Process | TaskProcessContract
    {
        return $this->process ?: new NullTaskProcess();
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
        $message = $this->formatOutput($message);

        // TODO: Implement colors ;)
        print($message);
        print(PHP_EOL);
    }

    /**
     * Format the given message with the task logger.
     */
    public function formatOutput(string | array $message): string
    {
        return $this->logger()->format($this, $message);
    }
}
