<?php

namespace Telegram\Bot\Tests;

use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\User;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function test_text_mention()
    {
        $message = new Message([
            "message_id" => 15729,
            "from" => [
                "id" => 114181057,
                "is_bot" => false,
                "first_name" => "Hamid",
                "language_code" => "en-US"
            ],
            "chat" => [
                "id" => -220954101,
                "title" => "Test",
                "type" => "group",
                "all_members_are_administrators" => true
            ],
            "date" => 1503743338,
            "text" => "My friend",
            "entities" => [
                [
                    "offset" => 0,
                    "length" => 9,
                    "type" => "text_mention",
                    "user" => [
                        "id" => 430123123,
                        "is_bot" => false,
                        "first_name" => "John"
                    ]
                ]
            ]
        ]);
        $this->assertEquals('<a href="tg://user?id=430123123">My friend</a>', $message->getHtml());
        $this->assertEquals('text_mention', $message->getEntities()[0]->getType());
        $this->assertInstanceOf(User::class, $message->getEntities()[0]->getUser());
    }

    public function test_html_in_text()
    {
        $message = new Message([
            "message_id" => 15729,
            "from" => [
                "id" => 114181057,
                "is_bot" => false,
                "first_name" => "Hamid",
                "language_code" => "en-US"
            ],
            "chat" => [
                "id" => -220954101,
                "title" => "Test",
                "type" => "group",
                "all_members_are_administrators" => true
            ],
            "date" => 1503743338,
            "text" => "Search me!",
            "entities" => [
                [
                    "offset" => 0,
                    "length" => 6,
                    "type" => "text_link",
                    'url' => 'https://google.com',
                ],
                [
                    'offset' => 7,
                    'length' => 2,
                    'type' => 'italic',
                ],
            ]
        ]);
        $this->assertTrue($message->hasHtmlEntity());
        $this->assertEquals('<a href="https://google.com">Search</a> <i>me</i>!', $message->getHtml());
    }

    public function test_html_in_caption()
    {
        $message = new Message([
            "message_id" => 15729,
            "from" => [
                "id" => 114181057,
                "is_bot" => false,
                "first_name" => "Hamid",
                "language_code" => "en-US"
            ],
            "chat" => [
                "id" => -220954101,
                "title" => "Test",
                "type" => "group",
                "all_members_are_administrators" => true
            ],
            "date" => 1503743338,
            "video" => [],
            'caption' => 'Search me!',
            "caption_entities" => [
                [
                    "offset" => 0,
                    "length" => 6,
                    "type" => "text_link",
                    'url' => 'https://google.com',
                ],
                [
                    'offset' => 7,
                    'length' => 2,
                    'type' => 'italic',
                ],
            ]
        ]);
        $this->assertTrue($message->hasHtmlCaption());
        $this->assertEquals('<a href="https://google.com">Search</a> <i>me</i>!', $message->getCaptionHtml());
    }
}
