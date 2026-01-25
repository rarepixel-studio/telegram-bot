<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendChecklistRequest;

class SendChecklistRequestTest extends TestCase
{
    public function test_it_validates_checklist_with_empty_title()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Checklist title must be between 1 and 255 characters');

        $checklist = [
            'title' => '',
            'tasks' => [
                ['id' => 1, 'text' => 'Task 1'],
            ],
        ];

        $request = new SendChecklistRequest(12345, $checklist);
        $request->validate();
    }

    public function test_it_validates_checklist_with_title_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Checklist title must be between 1 and 255 characters');

        $checklist = [
            'title' => str_repeat('a', 256),
            'tasks' => [
                ['id' => 1, 'text' => 'Task 1'],
            ],
        ];

        $request = new SendChecklistRequest(12345, $checklist);
        $request->validate();
    }

    public function test_it_validates_checklist_with_no_tasks()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Checklist must have between 1 and 30 tasks');

        $checklist = [
            'title' => 'My Checklist',
            'tasks' => [],
        ];

        $request = new SendChecklistRequest(12345, $checklist);
        $request->validate();
    }

    public function test_it_validates_checklist_with_too_many_tasks()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Checklist must have between 1 and 30 tasks');

        $tasks = [];
        for ($i = 1; $i <= 31; $i++) {
            $tasks[] = ['id' => $i, 'text' => "Task $i"];
        }

        $checklist = [
            'title' => 'My Checklist',
            'tasks' => $tasks,
        ];

        $request = new SendChecklistRequest(12345, $checklist);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $checklist = [
            'title' => 'My Checklist',
            'tasks' => [
                ['id' => 1, 'text' => 'Task 1'],
                ['id' => 2, 'text' => 'Task 2'],
            ],
            'others_can_add_tasks' => true,
        ];

        $request = new SendChecklistRequest(12345, $checklist);
        $request->disableNotification(true);

        $array = $request->toArray();

        $this->assertEquals(12345, $array['chat_id']);
        $this->assertIsString($array['checklist']);
        $this->assertSame(json_encode($checklist), $array['checklist']);
        $this->assertTrue($array['disable_notification']);
    }

    public function test_it_sets_optional_parameters()
    {
        $checklist = [
            'title' => 'My Checklist',
            'tasks' => [
                ['id' => 1, 'text' => 'Task 1'],
            ],
        ];

        $request = new SendChecklistRequest(12345, $checklist);
        $request->messageThreadId(10)->protectContent(true);

        $array = $request->toArray();

        $this->assertEquals(10, $array['message_thread_id']);
        $this->assertTrue($array['protect_content']);
    }

    public function test_it_returns_correct_method_name()
    {
        $checklist = [
            'title' => 'My Checklist',
            'tasks' => [
                ['id' => 1, 'text' => 'Task 1'],
            ],
        ];

        $request = new SendChecklistRequest(12345, $checklist);
        $this->assertEquals('sendChecklist', $request->getMethod());
    }
}
