<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Stubleapp\Parallel\Commands\RunParallelCommand;

final class RunParallelCommandTest extends TestCase
{
    /** @test */
    public function can_get_the_tags_in_array_form(): void
    {
        $command = $this->createPartialMock(RunParallelCommand::class, [
            'option'
        ]);

        $command->method('option')->with('tags')->willReturn('one,two');
        $this->assertSame(['one', 'two'], $command->getTagsFromAguments());

        $command = $this->createPartialMock(RunParallelCommand::class, [
            'option'
        ]);

        $command->method('option')->with('tags')->willReturn('1');
        $this->assertSame(['1'], $command->getTagsFromAguments());
    }

    /** @test */
    public function can_get_the_tags_in_empty_array_form(): void
    {
        $command = $this->createPartialMock(RunParallelCommand::class, [
            'option'
        ]);

        $command->method('option')->with('tags')->willReturn(null);
        $this->assertSame([], $command->getTagsFromAguments());

        $command = $this->createPartialMock(RunParallelCommand::class, [
            'option'
        ]);

        $command->method('option')->with('tags')->willReturn('');
        $this->assertSame([], $command->getTagsFromAguments());
    }
}
