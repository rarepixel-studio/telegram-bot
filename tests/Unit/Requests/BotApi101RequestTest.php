<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputMediaLink;
use Telegram\Bot\Objects\InputRichMessage;
use Telegram\Bot\Requests\AnswerChatJoinRequestQueryRequest;
use Telegram\Bot\Requests\EditMessageTextRequest;
use Telegram\Bot\Requests\SendChatJoinRequestWebAppRequest;
use Telegram\Bot\Requests\SendRichMessageDraftRequest;
use Telegram\Bot\Requests\SendRichMessageRequest;

class BotApi101RequestTest extends TestCase
{
    public function test_send_rich_message_serializes_rich_message(): void
    {
        $request = (new SendRichMessageRequest(123, ['html' => '<b>Hello</b>']))
            ->messageEffectId('effect-id');

        $params = $request->toArray();

        $this->assertSame('sendRichMessage', $request->getMethod());
        $this->assertSame(123, $params['chat_id']);
        $this->assertSame(json_encode(['html' => '<b>Hello</b>']), $params['rich_message']);
        $this->assertSame('effect-id', $params['message_effect_id']);
    }

    public function test_rich_message_requires_exactly_one_format(): void
    {
        $request = new SendRichMessageRequest(123, ['html' => '<b>Hello</b>', 'markdown' => '**Hello**']);

        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Exactly one of html or markdown must be provided');

        $request->validate();
    }

    public function test_send_rich_message_draft_rejects_zero_draft_id(): void
    {
        $request = new SendRichMessageDraftRequest(123, 0, new InputRichMessage(['markdown' => '**Thinking**']));

        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('draft_id must be non-zero');

        $request->validate();
    }

    public function test_edit_message_text_accepts_rich_message(): void
    {
        $request = (new EditMessageTextRequest(['markdown' => '**Updated**']))
            ->chatId(123)
            ->messageId(456);

        $params = $request->toArray();

        $this->assertSame('editMessageText', $request->getMethod());
        $this->assertSame(json_encode(['markdown' => '**Updated**']), $params['rich_message']);
        $this->assertArrayNotHasKey('text', $params);
    }

    public function test_answer_chat_join_request_query_validates_result(): void
    {
        $request = new AnswerChatJoinRequestQueryRequest('query-id', 'maybe');

        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('result must be approve, decline, or queue');

        $request->validate();
    }

    public function test_join_request_query_requests_build_payloads(): void
    {
        $answer = new AnswerChatJoinRequestQueryRequest('query-id', 'approve');
        $webApp = new SendChatJoinRequestWebAppRequest('query-id', 'https://example.com/app');

        $this->assertSame([
            'chat_join_request_query_id' => 'query-id',
            'result' => 'approve',
        ], $answer->toArray());
        $this->assertSame([
            'chat_join_request_query_id' => 'query-id',
            'web_app_url' => 'https://example.com/app',
        ], $webApp->toArray());
    }

    public function test_input_media_link_exposes_link_payload(): void
    {
        $media = new InputMediaLink(['type' => 'link', 'url' => 'https://example.com']);

        $this->assertSame('link', $media->getType());
        $this->assertSame('https://example.com', $media->getUrl());
    }
}
