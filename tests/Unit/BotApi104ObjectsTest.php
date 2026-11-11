<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\AreaPosition;
use Telegram\Bot\Objects\Chat;
use Telegram\Bot\Objects\ChatShareThemeEmoji;
use Telegram\Bot\Objects\ChatShareThemeUniqueGift;
use Telegram\Bot\Objects\EmojiTypeCustomEmoji;
use Telegram\Bot\Objects\EmojiTypeEmoji;
use Telegram\Bot\Objects\ForumTopic;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\MessageEntity;
use Telegram\Bot\Objects\PaidMessagesWaived;
use Telegram\Bot\Objects\RichText;
use Telegram\Bot\Objects\RichTextTonAddress;
use Telegram\Bot\Objects\TextQuote;
use Telegram\Bot\Objects\Update;
use Telegram\Bot\Objects\WidgetQueryTypeData;
use Telegram\Bot\Objects\WidgetQueryTypeSentTransaction;
use Telegram\Bot\Objects\WidgetQueryTypeSignData;

class BotApi104ObjectsTest extends TestCase
{
    public function test_it_hydrates_widget_queries_and_their_wallet_variants(): void
    {
        $update = new Update([
            'update_id' => 1,
            'widget_query' => [
                'id' => 'query-id',
                'from' => ['id' => 123],
                'chat' => ['id' => 234, 'type' => 'private'],
                'message_id' => 10,
                'chat_instance' => 'instance',
                'type' => ['type' => 'data', 'wallet_card' => ['address' => 'wallet-address', 'amount' => '9999999999999999999', 'stickers' => []]],
                'data' => 'clicked',
            ],
        ]);

        $this->assertSame('widget_query', $update->detectType());
        $this->assertSame(234, $update->getChat()->getId());
        $this->assertSame(123, $update->getFrom()->getId());
        $type = $update->getWidgetQuery()->getType();
        $this->assertInstanceOf(WidgetQueryTypeData::class, $type);
        $this->assertSame('9999999999999999999', $type->getWalletCard()->getAmount());
        $this->assertSame([], $type->getWalletCard()->getStickers()->all());

        $sharedUpdate = new Update([
            'update_id' => 2,
            'shared_widget_query' => [
                'id' => 'shared-query',
                'from' => ['id' => 456],
                'type' => ['type' => 'sign_data', 'wallet' => ['address' => 'wallet-address', 'amount' => '10'], 'sign_data' => '{"signature":"test"}'],
                'widget_id' => 'widget-id',
                'data' => 'signed',
            ],
        ]);

        $this->assertSame('shared_widget_query', $sharedUpdate->detectType());
        $this->assertNull($sharedUpdate->getChat());
        $this->assertSame(456, $sharedUpdate->getFrom()->getId());
        $shared = $sharedUpdate->getSharedWidgetQuery();
        $this->assertSame('widget-id', $shared->getWidgetId());
        $this->assertInstanceOf(WidgetQueryTypeSignData::class, $shared->getType());
        $this->assertSame('wallet-address', $shared->getType()->getWallet()->getAddress());
        $transaction = $shared->getType()::fromArray($shared->getType()->toArray());
        $this->assertInstanceOf(WidgetQueryTypeSignData::class, $transaction);

        $transaction = new Update(['widget_query' => ['type' => [
            'type' => 'sent_transaction', 'wallet' => ['address' => 'wallet-address'], 'msg_hash' => 'hash',
        ]]]);
        $this->assertInstanceOf(WidgetQueryTypeSentTransaction::class, $transaction->getWidgetQuery()->getType());
        $this->assertSame('hash', $transaction->getWidgetQuery()->getType()->getMsgHash());
    }

    public function test_it_detects_widget_and_wallet_service_messages(): void
    {
        $widget = ['id' => 'widget-id', 'html' => '<p>Hello</p>', 'public_data' => 'shared'];
        $message = new Message(['widget' => $widget, 'external_reply' => ['widget' => $widget]]);

        $this->assertSame('widget', $message->detectType());
        $this->assertSame('widget-id', $message->getWidget()->getId());
        $this->assertSame('shared', $message->getExternalReply()->getWidget()->getPublicData());

        $transfer = new Message(['ton_wallet_transfer' => ['transaction_id' => '', 'peer_address' => 'wallet-address', 'amount' => '-12345678901234567890']]);
        $this->assertSame('ton_wallet_transfer', $transfer->detectType());
        $this->assertSame('-12345678901234567890', $transfer->getTonWalletTransfer()->getAmount());

        $waiver = new Message(['paid_messages_waived' => []]);
        $this->assertSame('paid_messages_waived', $waiver->detectType());
        $this->assertInstanceOf(PaidMessagesWaived::class, $waiver->getPaidMessagesWaived());
    }

    public function test_it_hydrates_chat_share_themes_and_wallet_card_stickers(): void
    {
        $chat = new Chat([
            'share_theme' => ['type' => 'emoji', 'emojis' => [
                ['type' => 'emoji', 'emoji' => '🎉'],
                ['type' => 'custom_emoji', 'custom_emoji_id' => 'custom-id'],
            ]],
            'ton_wallet_card' => ['stickers' => [[
                'position' => ['x_percentage' => 25.5],
                'nft' => ['name' => 'NFT', 'index' => '12345678901234567890', 'attributes' => [['trait_type' => 'color', 'value' => 'blue']]],
            ]]],
        ]);

        $theme = $chat->getShareTheme();
        $this->assertInstanceOf(ChatShareThemeEmoji::class, $theme);
        $this->assertInstanceOf(EmojiTypeEmoji::class, $theme->getEmojis()[0]);
        $this->assertInstanceOf(EmojiTypeCustomEmoji::class, $theme->getEmojis()[1]);
        $this->assertSame('custom-id', $theme->getEmojis()[1]->getCustomEmojiId());

        $sticker = $chat->getTonWalletCard()->getStickers()[0];
        $this->assertInstanceOf(AreaPosition::class, $sticker->getPosition());
        $this->assertSame(25.5, $sticker->getPosition()->getXPercentage());
        $this->assertSame('12345678901234567890', $sticker->getNft()->getIndex());
        $this->assertSame('blue', $sticker->getNft()->getAttributes()[0]->getValue());

        $giftTheme = (new Chat(['share_theme' => ['type' => 'unique_gift', 'gift' => ['name' => 'Gift-1']]]))->getShareTheme();
        $this->assertInstanceOf(ChatShareThemeUniqueGift::class, $giftTheme);
        $this->assertSame('Gift-1', $giftTheme->getGift()->getName());
    }

    public function test_it_hydrates_rich_quotes_and_ton_addresses(): void
    {
        $quote = new TextQuote(['text' => '', 'position' => 0, 'rich_texts' => [
            'plain',
            ['type' => 'bold', 'text' => ['nested ', ['type' => 'italic', 'text' => 'text']]],
        ]]);

        $this->assertSame('plain', $quote->getRichTexts()[0]);
        $this->assertInstanceOf(RichText::class, $quote->getRichTexts()[1]);
        $this->assertSame('nested ', $quote->getRichTexts()[1]->getText()[0]);
        $this->assertSame('text', $quote->getRichTexts()[1]->getText()[1]->getText());

        $address = RichText::fromArray(['type' => 'ton_address', 'text' => 'wallet', 'address' => 'wallet-address']);
        $this->assertInstanceOf(RichTextTonAddress::class, $address);
        $this->assertSame('wallet-address', $address->getAddress());

        foreach (['ton_address', 'bank_card_number'] as $type) {
            $entity = new MessageEntity(['type' => $type, 'offset' => 0, 'length' => 1]);
            $entity->validate();
            $this->assertSame($type, $entity->getType());
        }
    }

    public function test_it_builds_links_to_private_bot_topics(): void
    {
        $topic = new ForumTopic(['message_thread_id' => 123]);

        $this->assertSame('https://t.me/example_bot/123', $topic->getPrivateTopicLink('@example_bot'));
    }
}
