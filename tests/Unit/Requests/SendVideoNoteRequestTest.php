<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\SendVideoNoteRequest;

class SendVideoNoteRequestTest extends TestCase
{
    public function test_it_builds_params_when_optional_fields_are_set(): void
    {
        $request = (new SendVideoNoteRequest(123, 'video_note_file_id'))
            ->duration(60)
            ->length(360)
            ->thumbnail('thumb_file_id')
            ->disableNotification(true)
            ->protectContent(true)
            ->allowPaidBroadcast(true)
            ->messageEffectId('effect-id')
            ->directMessagesTopicId(777)
            ->messageThreadId(999);

        $params = $request->toArray();

        $this->assertSame(123, $params['chat_id']);
        $this->assertSame('video_note_file_id', $params['video_note']);
        $this->assertSame(60, $params['duration']);
        $this->assertSame(360, $params['length']);
        $this->assertSame('thumb_file_id', $params['thumbnail']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertTrue($params['allow_paid_broadcast']);
        $this->assertSame('effect-id', $params['message_effect_id']);
        $this->assertSame(777, $params['direct_messages_topic_id']);
        $this->assertSame(999, $params['message_thread_id']);
    }

    public function test_it_normalizes_suggested_post_parameters_array_when_valid(): void
    {
        $sendDate = time() + 600;

        $request = new SendVideoNoteRequest(123, 'video_note_file_id');
        $request->suggestedPostParameters(['send_date' => $sendDate]);
        $request->validate();

        $params = $request->toArray();

        $this->assertIsString($params['suggested_post_parameters']);
        $this->assertSame(json_encode(['send_date' => $sendDate]), $params['suggested_post_parameters']);
    }
}
