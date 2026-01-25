<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultArticle;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultAudio;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultCachedAudio;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultCachedDocument;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultCachedGif;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultCachedMpeg4Gif;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultCachedPhoto;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultCachedSticker;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultCachedVideo;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultCachedVoice;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultContact;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultDocument;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultGif;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultLocation;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultMpeg4Gif;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultPhoto;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultVenue;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultVideo;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultVoice;
use Telegram\Bot\Objects\InputContent\InputInvoiceMessageContent;
use Telegram\Bot\Objects\InputContent\InputTextMessageContent;
use Telegram\Bot\Objects\LabeledPrice;
use Telegram\Bot\Objects\LinkPreviewOptions;
use Telegram\Bot\Objects\MessageEntity;

class InlineQueryObjectsTest extends TestCase
{
    /**
     * @dataProvider inlineQueryResultTypes
     */
    public function test_it_sets_inline_query_result_type(string $class, string $expectedType): void
    {
        $result = new $class;

        $this->assertSame($expectedType, $result->getType());
    }

    public function test_it_maps_inline_query_reply_markup(): void
    {
        $result = new InlineQueryResultArticle([
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => 'Click', 'callback_data' => 'data'],
                    ],
                ],
            ],
        ]);

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $result->getReplyMarkup());
    }

    public function test_it_maps_inline_query_caption_entities(): void
    {
        $result = new InlineQueryResultAudio([
            'audio_url' => 'https://example.com/audio.mp3',
            'title' => 'Audio',
            'caption_entities' => [
                ['type' => 'bold', 'offset' => 0, 'length' => 4],
            ],
        ]);

        $entities = $result->getCaptionEntities();

        $this->assertIsArray($entities);
        $this->assertInstanceOf(MessageEntity::class, $entities[0]);
    }

    public function test_it_maps_input_text_message_content_relations(): void
    {
        $content = new InputTextMessageContent([
            'message_text' => 'Hello',
            'entities' => [
                ['type' => 'bold', 'offset' => 0, 'length' => 5],
            ],
            'link_preview_options' => ['is_disabled' => true],
        ]);

        $this->assertSame('Hello', $content->getMessageText());
        $this->assertIsArray($content->getEntities());
        $this->assertInstanceOf(MessageEntity::class, $content->getEntities()[0]);
        $this->assertInstanceOf(LinkPreviewOptions::class, $content->getLinkPreviewOptions());
    }

    public function test_it_maps_input_invoice_message_content_prices(): void
    {
        $content = new InputInvoiceMessageContent([
            'title' => 'Product',
            'description' => 'Product description',
            'payload' => 'payload',
            'provider_token' => 'token',
            'currency' => 'USD',
            'prices' => [
                ['label' => 'Base', 'amount' => 100],
            ],
        ]);

        $prices = $content->getPrices();

        $this->assertSame('Product', $content->getTitle());
        $this->assertSame('USD', $content->getCurrency());
        $this->assertInstanceOf(LabeledPrice::class, $prices[0]);
    }

    public function inlineQueryResultTypes(): array
    {
        return [
            [InlineQueryResultArticle::class, 'article'],
            [InlineQueryResultAudio::class, 'audio'],
            [InlineQueryResultCachedAudio::class, 'audio'],
            [InlineQueryResultCachedDocument::class, 'document'],
            [InlineQueryResultCachedGif::class, 'gif'],
            [InlineQueryResultCachedMpeg4Gif::class, 'mpeg4_gif'],
            [InlineQueryResultCachedPhoto::class, 'photo'],
            [InlineQueryResultCachedSticker::class, 'sticker'],
            [InlineQueryResultCachedVideo::class, 'video'],
            [InlineQueryResultCachedVoice::class, 'voice'],
            [InlineQueryResultContact::class, 'contact'],
            [InlineQueryResultDocument::class, 'document'],
            [InlineQueryResultGif::class, 'gif'],
            [InlineQueryResultLocation::class, 'location'],
            [InlineQueryResultMpeg4Gif::class, 'mpeg4_gif'],
            [InlineQueryResultPhoto::class, 'photo'],
            [InlineQueryResultVenue::class, 'venue'],
            [InlineQueryResultVideo::class, 'video'],
            [InlineQueryResultVoice::class, 'voice'],
        ];
    }
}
