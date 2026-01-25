<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\Chat;
use Telegram\Bot\Objects\DirectMessagePriceChanged;
use Telegram\Bot\Objects\DirectMessagesTopic;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\MaybeInaccessibleMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Poll;
use Telegram\Bot\Objects\PollOption;
use Telegram\Bot\Objects\StarAmount;
use Telegram\Bot\Objects\SuggestedPostPaid;
use Telegram\Bot\Objects\User;

class MessageTest extends TestCase
{
    public function test_text_mention()
    {
        $message = new Message([
            'message_id' => 15729,
            'from' => [
                'id' => 114181057,
                'is_bot' => false,
                'first_name' => 'Hamid',
                'language_code' => 'en-US',
            ],
            'chat' => [
                'id' => -220954101,
                'title' => 'Test',
                'type' => 'group',
                'all_members_are_administrators' => true,
            ],
            'date' => 1503743338,
            'text' => 'My friend',
            'entities' => [
                [
                    'offset' => 0,
                    'length' => 9,
                    'type' => 'text_mention',
                    'user' => [
                        'id' => 430123123,
                        'is_bot' => false,
                        'first_name' => 'John',
                    ],
                ],
            ],
        ]);
        $this->assertEquals('<a href="tg://user?id=430123123">My friend</a>', $message->getHtml());
        $this->assertEquals('text_mention', $message->getEntities()[0]->getType());
        $this->assertInstanceOf(User::class, $message->getEntities()[0]->getUser());
    }

    public function test_html_in_text()
    {
        $message = new Message([
            'message_id' => 15729,
            'from' => [
                'id' => 114181057,
                'is_bot' => false,
                'first_name' => 'Hamid',
                'language_code' => 'en-US',
            ],
            'chat' => [
                'id' => -220954101,
                'title' => 'Test',
                'type' => 'group',
                'all_members_are_administrators' => true,
            ],
            'date' => 1503743338,
            'text' => 'Search me!',
            'entities' => [
                [
                    'offset' => 0,
                    'length' => 6,
                    'type' => 'text_link',
                    'url' => 'https://google.com',
                ],
                [
                    'offset' => 7,
                    'length' => 2,
                    'type' => 'italic',
                ],
            ],
        ]);
        $this->assertTrue($message->hasHtmlEntity());
        $this->assertEquals('<a href="https://google.com">Search</a> <i>me</i>!', $message->getHtml());
    }

    public function test_html_in_caption()
    {
        $message = new Message([
            'message_id' => 15729,
            'from' => [
                'id' => 114181057,
                'is_bot' => false,
                'first_name' => 'Hamid',
                'language_code' => 'en-US',
            ],
            'chat' => [
                'id' => -220954101,
                'title' => 'Test',
                'type' => 'group',
                'all_members_are_administrators' => true,
            ],
            'date' => 1503743338,
            'video' => [],
            'caption' => 'Search me!',
            'caption_entities' => [
                [
                    'offset' => 0,
                    'length' => 6,
                    'type' => 'text_link',
                    'url' => 'https://google.com',
                ],
                [
                    'offset' => 7,
                    'length' => 2,
                    'type' => 'italic',
                ],
            ],
        ]);
        $this->assertTrue($message->hasHtmlCaption());
        $this->assertEquals('<a href="https://google.com">Search</a> <i>me</i>!', $message->getCaptionHtml());
    }

    public function test_poll()
    {
        $message = new Message([
            'poll' => [
                'id' => 'poll-id',
                'question' => 'Do you agree?',
                'options' => [
                    [
                        'text' => 'Yes',
                        'voter_count' => 100,
                    ],
                    [
                        'text' => 'No',
                        'voter_count' => 1,
                    ],
                ],
                'is_closed' => true,
            ],
        ]);
        $this->assertInstanceOf(Poll::class, $message->getPoll());
        $this->assertInstanceOf(PollOption::class, $message->getPoll()->getOptions()[0]);
        $this->assertEquals('Yes', $message->getPoll()->getOptions()[0]->getText());
        $this->assertEquals(100, $message->getPoll()->getOptions()[0]->getVoterCount());
    }

    public function test_it_hydrates_message_relations_when_present(): void
    {
        $message = new Message([
            'message_id' => 10,
            'chat' => [
                'id' => 1,
                'type' => 'private',
            ],
            'date' => 1710000000,
            'direct_messages_topic' => [
                'topic_id' => 123,
                'user' => [
                    'id' => 2,
                    'is_bot' => false,
                    'first_name' => 'Alex',
                ],
            ],
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Tap',
                            'callback_data' => 'tap',
                        ],
                    ],
                ],
            ],
            'suggested_post_info' => [
                'state' => 'pending',
                'price' => [
                    'currency' => 'XTR',
                    'amount' => 5,
                ],
            ],
        ]);

        $this->assertInstanceOf(DirectMessagesTopic::class, $message->getDirectMessagesTopic());
        $this->assertSame(123, $message->getDirectMessagesTopic()->getTopicId());
        $this->assertInstanceOf(User::class, $message->getDirectMessagesTopic()->getUser());
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $message->getReplyMarkup());
        $this->assertSame('pending', $message->getSuggestedPostInfo()->getState());
    }

    public function test_it_maps_pinned_message_as_maybe_inaccessible_message(): void
    {
        $message = new Message([
            'message_id' => 1,
            'chat' => [
                'id' => 10,
                'type' => 'private',
            ],
            'date' => 1710000001,
            'pinned_message' => [
                'chat' => [
                    'id' => 20,
                    'type' => 'private',
                ],
                'message_id' => 55,
                'date' => 0,
            ],
        ]);

        $pinnedMessage = $message->getPinnedMessage();

        $this->assertInstanceOf(MaybeInaccessibleMessage::class, $pinnedMessage);
        $this->assertSame(0, $pinnedMessage->getDate());
        $this->assertInstanceOf(Chat::class, $pinnedMessage->getChat());
    }

    public function test_it_hydrates_price_change_and_suggested_post_payment(): void
    {
        $message = new Message([
            'direct_message_price_changed' => [
                'are_direct_messages_enabled' => true,
                'direct_message_star_count' => 25,
            ],
            'suggested_post_paid' => [
                'suggested_post_message' => [
                    'message_id' => 99,
                    'chat' => [
                        'id' => 30,
                        'type' => 'private',
                    ],
                    'date' => 1710000002,
                    'text' => 'Hello',
                ],
                'currency' => 'XTR',
                'star_amount' => [
                    'amount' => 10,
                    'nanostar_amount' => 0,
                ],
            ],
        ]);

        $priceChanged = $message->getDirectMessagePriceChanged();
        $this->assertInstanceOf(DirectMessagePriceChanged::class, $priceChanged);
        $this->assertTrue($priceChanged->getAreDirectMessagesEnabled());
        $this->assertSame(25, $priceChanged->getDirectMessageStarCount());

        $suggestedPostPaid = $message->getSuggestedPostPaid();
        $this->assertInstanceOf(SuggestedPostPaid::class, $suggestedPostPaid);
        $this->assertSame('XTR', $suggestedPostPaid->getCurrency());
        $this->assertInstanceOf(StarAmount::class, $suggestedPostPaid->getStarAmount());
        $this->assertInstanceOf(Message::class, $suggestedPostPaid->getSuggestedPostMessage());
    }

    public function test_it_detects_message_types_for_new_fields(): void
    {
        $giveawayMessage = new Message([
            'giveaway' => [
                'chats' => [
                    [
                        'id' => 1,
                        'type' => 'private',
                    ],
                ],
                'winners_selection_date' => 1710000003,
                'winner_count' => 1,
            ],
        ]);

        $this->assertSame('giveaway', $giveawayMessage->detectType());

        $newMembersMessage = new Message([
            'new_chat_members' => [
                [
                    'id' => 2,
                    'is_bot' => false,
                    'first_name' => 'Alex',
                ],
            ],
        ]);

        $this->assertSame('new_chat_members', $newMembersMessage->detectType());
    }
}
