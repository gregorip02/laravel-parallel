<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Stubleapp\Parallel\Task;

final class TaskTest extends TestCase
{
    /** @test */
    public function the_task_should_run_when_empty_tags_are_pased(): void
    {
        $task = $this->createPartialMock(Task::class, ['tags']);
        $this->assertTrue($task->shouldRun());
    }

    /** @test */
    public function the_task_should_run_when_one_tag_exists(): void
    {
        $task = $this->createPartialMock(Task::class, ['tags']);
        $task->method('tags')->willReturn(['laravel', 'symfony']);
        $this->assertTrue($task->shouldRun(['laravel']));
    }

    /** @test */
    public function the_task_should_not_run_when_no_one_tag_exists(): void
    {
        $task = $this->createPartialMock(Task::class, ['tags']);
        $task->method('tags')->willReturn(['laravel', 'symfony']);
        $this->assertFalse($task->shouldRun(['express']));
    }

    /** @test */
    public function the_task_can_be_instanced_using_a_array(): void
    {
        $task = Task::fromArray(['command' => $command = 'hello world', 'another' => true]);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertSame($command, $task->command());
        $this->assertSame($command, $task->name());
        $this->assertSame([], $task->tags());
        $this->assertTrue($task->shouldRun());
        $this->assertFalse($task->shouldRun(['laravel']));
    }
}
