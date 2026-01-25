<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Requests\SendMessageRequest;
use Telegram\Bot\Requests\SetChatTitleRequest;
use Telegram\Bot\Tests\Mocks\Mocker;

class ApiMethodWrappersTest extends TestCase
{
    /** @test */
    public function it_returns_same_message_for_send_message_when_using_array_or_request(): void
    {
        $payload = [
            'message_id' => 100,
            'text' => 'Hello',
            'chat' => [
                'id' => 123,
                'type' => 'private',
            ],
        ];

        $apiArray = Mocker::createApiResponse($payload);
        $apiRequest = Mocker::createApiResponse($payload);

        $responseArray = $apiArray->sendMessage(['chat_id' => 123, 'text' => 'Hello']);
        $responseRequest = $apiRequest->sendMessage(new SendMessageRequest(123, 'Hello'));

        $this->assertInstanceOf(Message::class, $responseArray);
        $this->assertInstanceOf(Message::class, $responseRequest);
        $this->assertEquals($responseArray->getMessageId(), $responseRequest->getMessageId());
        $this->assertEquals($responseArray->getText(), $responseRequest->getText());
    }

    /** @test */
    public function it_returns_same_result_for_set_chat_title_when_using_array_or_request(): void
    {
        $apiArray = Mocker::createApiResponse(true);
        $apiRequest = Mocker::createApiResponse(true);

        $responseArray = $apiArray->setChatTitle(['chat_id' => 123, 'title' => 'Title']);
        $responseRequest = $apiRequest->setChatTitle(new SetChatTitleRequest(123, 'Title'));

        $this->assertTrue($responseArray);
        $this->assertTrue($responseRequest);
    }
}
