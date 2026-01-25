<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setStickerEmojiList method.
 *
 * Use this method to change the list of emoji assigned to a regular or custom emoji sticker.
 *
 * @link https://core.telegram.org/bots/api#setstickeremojilist
 */
class SetStickerEmojiListRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'emoji_list',
    ];

    /**
     * @param  string  $sticker  File identifier of the sticker
     * @param  array  $emoji_list  A list of 1-20 emoji associated with the sticker
     */
    public function __construct(
        protected string $sticker,
        protected array $emoji_list,
    ) {}

    public function getMethod(): string
    {
        return 'setStickerEmojiList';
    }

    public function validate(): void
    {
        if (empty($this->sticker)) {
            throw new TelegramValidationException('sticker cannot be empty');
        }
        if (empty($this->emoji_list)) {
            throw new TelegramValidationException('emoji_list cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'sticker' => $this->sticker,
            'emoji_list' => $this->emoji_list,
        ];
    }
}
