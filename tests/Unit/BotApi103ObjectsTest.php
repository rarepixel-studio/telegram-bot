<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\ChatAdministratorRights;
use Telegram\Bot\Objects\ChatMember;
use Telegram\Bot\Objects\CommunityChatJoined;
use Telegram\Bot\Objects\DisabledButton;
use Telegram\Bot\Objects\InlineKeyboardButton;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\MessageGenerationStopped;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\RichBlockButtons;
use Telegram\Bot\Objects\RichBlockDocument;
use Telegram\Bot\Objects\RichBlockExpandableBlockQuotation;
use Telegram\Bot\Objects\RichMessage;
use Telegram\Bot\Objects\RichMessageButton;
use Telegram\Bot\Objects\RichTextButton;
use Telegram\Bot\Objects\UniqueGiftInfo;
use Telegram\Bot\Objects\Update;

class BotApi103ObjectsTest extends TestCase
{
    public function test_message_hydrates_community_chat_joined(): void
    {
        $message = new Message([
            'message_id' => 1,
            'date' => 1234567890,
            'chat' => ['id' => -100, 'type' => 'supergroup'],
            'community_chat_joined' => [
                'community' => [
                    'id' => 42,
                    'name' => 'Community',
                ],
            ],
        ]);

        $joined = $message->getCommunityChatJoined();

        $this->assertInstanceOf(CommunityChatJoined::class, $joined);
        $this->assertSame(42, $joined->getCommunity()->getId());
        $this->assertSame('community_chat_joined', $message->detectType());
    }

    public function test_update_hydrates_stopped_message_generation(): void
    {
        $update = new Update([
            'update_id' => 10,
            'stopped_message_generation' => [
                'chat' => ['id' => 123, 'type' => 'private'],
                'message_thread_id' => 5,
                'draft_id' => 99,
            ],
        ]);

        $stopped = $update->getStoppedMessageGeneration();

        $this->assertInstanceOf(MessageGenerationStopped::class, $stopped);
        $this->assertSame(123, $stopped->getChat()->getId());
        $this->assertSame(5, $stopped->getMessageThreadId());
        $this->assertSame(99, $stopped->getDraftId());
        $this->assertSame('stopped_message_generation', $update->detectType());
    }

    public function test_rich_message_hydrates_new_blocks_and_text_button(): void
    {
        $message = new Message([
            'message_id' => 1,
            'date' => 1234567890,
            'chat' => ['id' => 123, 'type' => 'private'],
            'rich_message' => [
                'blocks' => [
                    [
                        'type' => 'expandable_blockquote',
                        'text' => 'Quoted',
                    ],
                    [
                        'type' => 'buttons',
                        'buttons' => [
                            [
                                'text' => 'Open',
                                'url' => 'https://example.com',
                            ],
                        ],
                        'align' => 'center',
                    ],
                    [
                        'type' => 'document',
                        'document' => [
                            'file_id' => 'file-id',
                            'file_unique_id' => 'unique-id',
                        ],
                    ],
                    [
                        'type' => 'table',
                        'cells' => [],
                        'is_compact' => true,
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => [
                            'type' => 'button',
                            'button' => [
                                'text' => 'Tap',
                                'callback_data' => 'tap',
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $blocks = $message->getRichMessage()->getBlocks();

        $this->assertInstanceOf(RichMessage::class, $message->getRichMessage());
        $this->assertInstanceOf(RichBlockExpandableBlockQuotation::class, new RichBlockExpandableBlockQuotation($blocks->get(0)->toArray()));
        $this->assertSame('expandable_blockquote', $blocks->get(0)->getType());
        $this->assertInstanceOf(RichBlockButtons::class, new RichBlockButtons($blocks->get(1)->toArray()));
        $this->assertInstanceOf(RichMessageButton::class, $blocks->get(1)->getButtons()->first());
        $this->assertSame('center', $blocks->get(1)->getAlign());
        $this->assertInstanceOf(RichBlockDocument::class, new RichBlockDocument($blocks->get(2)->toArray()));
        $this->assertSame('file-id', $blocks->get(2)->getDocument()->getFileId());
        $this->assertTrue($blocks->get(3)->getIsCompact());

        $buttonText = $blocks->get(4)->getText();
        $this->assertInstanceOf(RichTextButton::class, new RichTextButton($buttonText->toArray()));
        $this->assertSame('tap', $buttonText->getButton()->getCallbackData());
    }

    public function test_unique_gift_info_exposes_origin_and_private_text(): void
    {
        $info = new UniqueGiftInfo([
            'gift' => [
                'base_name' => 'Gift',
                'name' => 'Gift-1',
                'number' => 1,
                'model' => ['name' => 'model', 'sticker' => ['file_id' => 'a', 'file_unique_id' => 'b', 'type' => 'regular', 'width' => 1, 'height' => 1, 'is_animated' => false, 'is_video' => false], 'rarity_per_mille' => 1],
                'symbol' => ['name' => 'symbol', 'sticker' => ['file_id' => 'c', 'file_unique_id' => 'd', 'type' => 'regular', 'width' => 1, 'height' => 1, 'is_animated' => false, 'is_video' => false], 'rarity_per_mille' => 1],
                'backdrop' => [
                    'name' => 'backdrop',
                    'colors' => ['center_color' => 1, 'edge_color' => 2, 'symbol_color' => 3, 'text_color' => 4],
                    'rarity_per_mille' => 1,
                ],
            ],
            'origin' => 'upgrade',
            'text' => 'Happy birthday',
            'entities' => [
                ['type' => 'bold', 'offset' => 0, 'length' => 5],
            ],
            'is_private' => true,
        ]);

        $this->assertSame('upgrade', $info->getOrigin());
        $this->assertSame('Happy birthday', $info->getText());
        $this->assertSame('bold', $info->getEntities()->first()->getType());
        $this->assertTrue($info->getIsPrivate());
    }

    public function test_administrator_rights_expose_welcome_message_permission(): void
    {
        $rights = new ChatAdministratorRights([
            'is_anonymous' => false,
            'can_manage_chat' => true,
            'can_delete_messages' => true,
            'can_manage_video_chats' => true,
            'can_restrict_members' => true,
            'can_promote_members' => true,
            'can_change_info' => true,
            'can_invite_users' => true,
            'can_post_stories' => true,
            'can_edit_stories' => true,
            'can_delete_stories' => true,
            'can_send_welcome_messages' => true,
        ]);
        $member = new ChatMember([
            'status' => 'administrator',
            'user' => ['id' => 1, 'is_bot' => false, 'first_name' => 'Admin'],
            'can_send_welcome_messages' => true,
        ]);

        $this->assertTrue($rights->getCanSendWelcomeMessages());
        $this->assertTrue($member->getCanSendWelcomeMessages());
    }

    public function test_inline_keyboard_button_accepts_disabled_field(): void
    {
        $button = InlineKeyboardButton::make('Soon')->withDisabled(DisabledButton::make());
        $button->validate();

        $this->assertInstanceOf(DisabledButton::class, $button->getDisabled());
    }

    public function test_markup_exposes_force_reply(): void
    {
        $inline = InlineKeyboardMarkup::make([[InlineKeyboardButton::make('Visit')->withUrl('https://example.com')]])
            ->withForceReply(true);
        $reply = ReplyKeyboardMarkup::make([[['text' => 'Hi']]])->withForceReply(true);

        $this->assertTrue($inline->getForceReply());
        $this->assertTrue($reply->getForceReply());
    }
}
