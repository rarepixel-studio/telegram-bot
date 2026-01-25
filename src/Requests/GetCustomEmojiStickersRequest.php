<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the getCustomEmojiStickers method.
 *
 * Use this method to get information about custom emoji stickers by their identifiers.
 *
 * @link https://core.telegram.org/bots/api#getcustomemojistickers
 */
class GetCustomEmojiStickersRequest extends TelegramApiRequest
{
    /**
     * @param  array  $custom_emoji_ids  List of custom emoji identifiers
     */
    public function __construct(
        protected array $custom_emoji_ids,
    ) {}

    public function getMethod(): string
    {
        return 'getCustomEmojiStickers';
    }

    public function validate(): void
    {
        if (empty($this->custom_emoji_ids)) {
            throw new TelegramValidationException('custom_emoji_ids cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'custom_emoji_ids' => $this->custom_emoji_ids,
        ];
    }
}
