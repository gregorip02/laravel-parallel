<?php

namespace Stubleapp\Parallel;

class Task implements TaskHandlerContract
{
    use TaskHandler;

    private ?string $uuid = null;

    public function __construct(
        private string $command,
        private ?string $name = null,
        private ?string $tag = null
    ) {}

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
    public function tag(): ?string
    {
        return $this->tag;
    }

    /**
     * Get the command uuid.
     */
    public function uuid(): string
    {
        // TODO: Use uuid.
        return is_null($this->uuid)
            ? $this->uuid = time()
            : $this->uuid;
    }
}
