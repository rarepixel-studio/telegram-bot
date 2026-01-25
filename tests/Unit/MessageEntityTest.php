<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\MessageEntity;

class MessageEntityTest extends TestCase
{
    public function test_it_requires_url_for_text_link_entities(): void
    {
        $entity = MessageEntity::make([
            'type' => 'text_link',
            'offset' => 0,
            'length' => 1,
        ]);

        $this->expectException(TelegramValidationException::class);

        $entity->validate();
    }

    public function test_it_accepts_text_link_entities_with_url(): void
    {
        $entity = MessageEntity::make([
            'type' => 'text_link',
            'offset' => 0,
            'length' => 1,
        ])
            ->withUrl('https://example.com');

        $entity->validate();

        $this->assertSame('https://example.com', $entity->getUrl());
    }
}
