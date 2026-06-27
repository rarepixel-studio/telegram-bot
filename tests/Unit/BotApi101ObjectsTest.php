<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\Chat;
use Telegram\Bot\Objects\ChatJoinRequest;
use Telegram\Bot\Objects\Link;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\PollMedia;
use Telegram\Bot\Objects\RichBlockTableCell;
use Telegram\Bot\Objects\RichMessage;
use Telegram\Bot\Objects\User;

class BotApi101ObjectsTest extends TestCase
{
    public function test_message_hydrates_rich_message(): void
    {
        $message = new Message([
            'message_id' => 1,
            'date' => 1234567890,
            'chat' => ['id' => 123, 'type' => 'private'],
            'rich_message' => [
                'blocks' => [
                    ['type' => 'paragraph', 'text' => 'Hello'],
                    [
                        'type' => 'table',
                        'cells' => [
                            [
                                ['text' => 'Cell', 'align' => 'left', 'valign' => 'top'],
                            ],
                        ],
                    ],
                ],
                'is_rtl' => true,
            ],
        ]);

        $this->assertInstanceOf(RichMessage::class, $message->getRichMessage());
        $this->assertTrue($message->getRichMessage()->getIsRtl());
        $this->assertSame('paragraph', $message->getRichMessage()->getBlocks()->first()->getType());
        $table = $message->getRichMessage()->getBlocks()->get(1);
        $this->assertInstanceOf(RichBlockTableCell::class, $table->getCells()->first()->first());
    }

    public function test_join_request_query_fields_are_exposed(): void
    {
        $user = new User([
            'id' => 123,
            'is_bot' => true,
            'first_name' => 'Bot',
            'supports_join_request_queries' => true,
        ]);
        $request = new ChatJoinRequest([
            'chat' => ['id' => -100, 'type' => 'supergroup'],
            'from' => ['id' => 456, 'is_bot' => false, 'first_name' => 'User'],
            'user_chat_id' => 456,
            'date' => 1234567890,
            'query_id' => 'query-id',
        ]);
        $chat = new Chat([
            'id' => -100,
            'type' => 'supergroup',
            'guard_bot' => ['id' => 123, 'is_bot' => true, 'first_name' => 'Bot'],
        ]);

        $this->assertTrue($user->getSupportsJoinRequestQueries());
        $this->assertSame('query-id', $request->getQueryId());
        $this->assertInstanceOf(User::class, $chat->getGuardBot());
    }

    public function test_poll_media_hydrates_link(): void
    {
        $media = new PollMedia(['link' => ['url' => 'https://example.com']]);

        $this->assertInstanceOf(Link::class, $media->getLink());
        $this->assertSame('https://example.com', $media->getLink()->getUrl());
    }
}
