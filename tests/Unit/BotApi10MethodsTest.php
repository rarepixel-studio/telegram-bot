<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\BotAccessSettings;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\SentGuestMessage;
use Telegram\Bot\Requests\AnswerGuestQueryRequest;
use Telegram\Bot\Requests\DeleteAllMessageReactionsRequest;
use Telegram\Bot\Requests\DeleteMessageReactionRequest;
use Telegram\Bot\Requests\GetManagedBotAccessSettingsRequest;
use Telegram\Bot\Requests\GetUserPersonalChatMessagesRequest;
use Telegram\Bot\Requests\SetManagedBotAccessSettingsRequest;
use Telegram\Bot\Tests\Mocks\Mocker;

class BotApi10MethodsTest extends TestCase
{
    public function test_it_answers_guest_query_with_request_object(): void
    {
        $api = Mocker::createApiResponse(['inline_message_id' => 'inline-message-id']);
        $request = new AnswerGuestQueryRequest('guest-query-id', [
            'type' => 'article',
            'id' => 'result-id',
            'title' => 'Title',
            'input_message_content' => ['message_text' => 'Hello'],
        ]);

        $response = $api->answerGuestQuery($request);

        $this->assertInstanceOf(SentGuestMessage::class, $response);
        $this->assertSame('inline-message-id', $response->getInlineMessageId());
    }

    public function test_it_gets_user_personal_chat_messages_with_request_object(): void
    {
        $api = Mocker::createApiResponse([
            ['message_id' => 1, 'date' => 1234567890, 'chat' => ['id' => 123, 'type' => 'private'], 'text' => 'Hello'],
        ]);
        $request = new GetUserPersonalChatMessagesRequest(123, 1);

        $response = $api->getUserPersonalChatMessages($request);

        $this->assertCount(1, $response);
        $this->assertInstanceOf(Message::class, $response->first());
    }

    public function test_it_deletes_message_reactions_with_request_objects(): void
    {
        $api = Mocker::createApiResponse(true);
        $this->assertTrue($api->deleteMessageReaction(new DeleteMessageReactionRequest(123, 456)));

        $api = Mocker::createApiResponse(true);
        $this->assertTrue($api->deleteAllMessageReactions(new DeleteAllMessageReactionsRequest(123)));
    }

    public function test_it_gets_and_sets_managed_bot_access_settings_with_request_objects(): void
    {
        $api = Mocker::createApiResponse(['is_access_restricted' => true]);
        $settings = $api->getManagedBotAccessSettings(new GetManagedBotAccessSettingsRequest(123));

        $this->assertInstanceOf(BotAccessSettings::class, $settings);
        $this->assertTrue($settings->getIsAccessRestricted());

        $api = Mocker::createApiResponse(true);
        $this->assertTrue(
            $api->setManagedBotAccessSettings((new SetManagedBotAccessSettingsRequest(123, true))->addedUserIds([456]))
        );
    }
}
