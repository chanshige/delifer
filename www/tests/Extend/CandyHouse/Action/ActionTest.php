<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Action;

use Fer\Deli\Extend\CandyHouse\Contracts\ActionInterface;
use Fer\Deli\Extend\CandyHouse\Contracts\CommandActionInterface;
use PHPUnit\Framework\TestCase;

class ActionTest extends TestCase
{
    public function testHistory(): void
    {
        $action = new History('488ABAAB-164F-7A86-595F-DDD778CB86C3');
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame(ActionInterface::GET, $action->method());
        $this->assertSame('/sesame2/488ABAAB-164F-7A86-595F-DDD778CB86C3/history', (string) $action);
        $this->assertSame(['page' => 0, 'lg' => 50], $action->payload());
    }

    public function testHistoryWithCondition(): void
    {
        $action = new History('488ABAAB-164F-7A86-595F-DDD778CB86C3');
        $action->page(5)->lg(10);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame(ActionInterface::GET, $action->method());
        $this->assertSame('/sesame2/488ABAAB-164F-7A86-595F-DDD778CB86C3/history', (string) $action);
        $this->assertSame(['page' => 5, 'lg' => 10], $action->payload());
    }

    public function testStatus(): void
    {
        $action = new Status('488ABAAB-164F-7A86-595F-DDD778CB86C3');
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame(ActionInterface::GET, $action->method());
        $this->assertSame('/sesame2/488ABAAB-164F-7A86-595F-DDD778CB86C3', (string) $action);
        $this->assertSame([], $action->payload());
    }

    public function testLockCommand(): void
    {
        $action = new Command(Command::LOCK, '488ABAAB-164F-7A86-595F-DDD778CB86C3', 'a13d4b890111676ba8fb36ece7e94f7d');
        $action->history('test_lock');
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertInstanceOf(CommandActionInterface::class, $action);
        $this->assertSame('/sesame2/488ABAAB-164F-7A86-595F-DDD778CB86C3/cmd', (string) $action);
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame(82, $payload['cmd']);
    }

    public function testUnlockCommand(): void
    {
        $action = new Command(Command::UNLOCK, '488ABAAB-164F-7A86-595F-DDD778CB86C3', 'a13d4b890111676ba8fb36ece7e94f7d');
        $action->history('test_unlock');
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertInstanceOf(CommandActionInterface::class, $action);
        $this->assertSame('/sesame2/488ABAAB-164F-7A86-595F-DDD778CB86C3/cmd', (string) $action);
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame(83, $payload['cmd']);
    }

    public function testToggleCommand(): void
    {
        $action = new Command(Command::TOGGLE, '488ABAAB-164F-7A86-595F-DDD778CB86C3', 'a13d4b890111676ba8fb36ece7e94f7d');
        $action->history('test_toggle');
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertInstanceOf(CommandActionInterface::class, $action);
        $this->assertSame('/sesame2/488ABAAB-164F-7A86-595F-DDD778CB86C3/cmd', (string) $action);
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame(88, $payload['cmd']);
    }
}
