<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Builder\Command;
use App\Builder\Escaped;

class CommandTest extends TestCase
{
    public function testSingleCommandToString()
    {
        $comm = new Command('foo');

        $this->assertEquals((string) $comm, 'foo');
    }

    public function testCommandWithArgsToString()
    {
        $comm = new Command('foo');

        $comm->addArgument('--bar');

        $this->assertEquals((string) $comm, 'foo --bar');
    }

    public function testCommandWithArgsOnConstructorToString()
    {
        $comm = new Command('foo', '--bar');

        $this->assertEquals((string) $comm, 'foo --bar');
    }

    public function testCommandWithArgsEscapedToString()
    {
        $comm = new Command('foo');
        $comm->addArgument(Escaped::make('/path/to/something'));

        $this->assertEquals((string) $comm, 'foo \'/path/to/something\'');

        $comm = new Command('foo');
        $comm->addArgument(Escaped::make('/path/t o/something'));

        $this->assertEquals((string) $comm, 'foo \'/path/t o/something\'');
    }

    public function testCommandWithArgsWithValuesToString()
    {
        $comm = new Command('foo');

        $comm->addArgument('--bar=\'zum\'');

        $this->assertEquals((string) $comm, 'foo --bar=\'zum\'');
    }

    public function testCommandWithArgsWithValuesParsedToString()
    {
        $comm = new Command('foo');
        $comm->addArgument('--bar', 'zum');

        $this->assertEquals((string) $comm, 'foo --bar=\'zum\'');
    }

    public function testCommandWithArgsWithValuesEscapedToString()
    {
        $comm = new Command('foo');
        $comm->addArgument('--bar', 'zum zap');

        $this->assertEquals((string) $comm, 'foo --bar=\'zum zap\'');

        $comm = new Command('foo');
        $comm->addArgument('--bar', 'zum "zap"');

        $this->assertEquals((string) $comm, 'foo --bar=\'zum "zap"\'');
    }

    public function testCommandWithCommandAsArgsToString()
    {
        $comm = new Command('foo');
        $comm->addArgument('--bar');

        $this->assertEquals((string) $comm, 'foo --bar');

        $comm2 = new Command('zum');
        $comm2->addArgument('--bar');
        $comm2->addArgument($comm);

        $this->assertEquals((string) $comm2, 'zum --bar foo --bar');
    }

    public function testCwd()
    {
        $comm = new Command('foo');

        $this->assertEquals($comm->getCwd(), '');

        $comm->setCwd(getcwd());

        $this->assertEquals($comm->getCwd(), getcwd());

        $this->expectException(\InvalidArgumentException::class);
        $comm->setCwd('/non-existing-dir');
    }
}
