<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\BotCommand;
use Telegram\Bot\Requests\GetMyCommandsRequest;
use Telegram\Bot\Tests\Mocks\Mocker;

class BotCommandMethodsTest extends TestCase
{
    /** @test */
    public function it_returns_bot_command_objects_when_get_my_commands_is_called()
    {
        $api = Mocker::createApiResponse([
            [
                'command' => 'start',
                'description' => 'Start',
            ],
            [
                'command' => 'help',
                'description' => 'Help',
            ],
        ]);

        $commands = $api->getMyCommands();

        $this->assertCount(2, $commands);
        $this->assertInstanceOf(BotCommand::class, $commands[0]);
        $this->assertEquals('start', $commands[0]->getCommand());
        $this->assertEquals('Start', $commands[0]->getDescription());
    }

    /** @test */
    public function it_returns_bot_command_objects_when_get_my_commands_is_called_with_request_object()
    {
        $api = Mocker::createApiResponse([
            [
                'command' => 'settings',
                'description' => 'Settings',
            ],
        ]);

        $request = new GetMyCommandsRequest;

        $commands = $api->getMyCommands($request);

        $this->assertCount(1, $commands);
        $this->assertInstanceOf(BotCommand::class, $commands[0]);
        $this->assertEquals('settings', $commands[0]->getCommand());
        $this->assertEquals('Settings', $commands[0]->getDescription());
    }
}
