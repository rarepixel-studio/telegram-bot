<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Requests\AnswerChatJoinRequestQueryRequest;
use Telegram\Bot\Requests\EditMessageTextRequest;
use Telegram\Bot\Requests\SendChatJoinRequestWebAppRequest;
use Telegram\Bot\Requests\SendRichMessageDraftRequest;
use Telegram\Bot\Requests\SendRichMessageRequest;
use Telegram\Bot\Tests\Mocks\Mocker;

class BotApi101MethodsTest extends TestCase
{
    public function test_it_sends_rich_message_with_request_object(): void
    {
        $api = Mocker::createApiResponse([
            'message_id' => 1,
            'date' => 1234567890,
            'chat' => ['id' => 123, 'type' => 'private'],
            'rich_message' => ['blocks' => [['type' => 'paragraph', 'text' => 'Hello']]],
        ]);

        $response = $api->sendRichMessage(new SendRichMessageRequest(123, ['html' => '<p>Hello</p>']));

        $this->assertInstanceOf(Message::class, $response);
        $this->assertSame('paragraph', $response->getRichMessage()->getBlocks()->first()->getType());
    }

    public function test_it_streams_rich_message_draft_with_request_object(): void
    {
        $api = Mocker::createApiResponse(true);

        $this->assertTrue($api->sendRichMessageDraft(
            new SendRichMessageDraftRequest(123, 1, ['markdown' => '**Thinking**'])
        ));
    }

    public function test_it_processes_chat_join_request_query_with_request_objects(): void
    {
        $api = Mocker::createApiResponse(true);
        $this->assertTrue($api->answerChatJoinRequestQuery(
            new AnswerChatJoinRequestQueryRequest('query-id', 'approve')
        ));

        $api = Mocker::createApiResponse(true);
        $this->assertTrue($api->sendChatJoinRequestWebApp(
            new SendChatJoinRequestWebAppRequest('query-id', 'https://example.com/app')
        ));
    }

    public function test_edit_message_text_can_return_boolean_for_inline_messages(): void
    {
        $api = Mocker::createApiResponse(true);

        $this->assertTrue($api->editMessageText(
            (new EditMessageTextRequest(['markdown' => '**Updated**']))->inlineMessageId('inline-id')
        ));
    }
}
