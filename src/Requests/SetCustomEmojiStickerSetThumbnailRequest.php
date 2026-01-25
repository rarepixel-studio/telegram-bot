<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setCustomEmojiStickerSetThumbnail method.
 *
 * Use this method to set the thumbnail of a custom emoji sticker set.
 *
 * @link https://core.telegram.org/bots/api#setcustomemojistickersetthumbnail
 */
class SetCustomEmojiStickerSetThumbnailRequest extends TelegramApiRequest
{
    /**
     * @param  string  $name  Sticker set name
     */
    public function __construct(
        protected string $name,
    ) {}

    protected array $params = [];

    public function customEmojiId(string $custom_emoji_id): self
    {
        $this->params['custom_emoji_id'] = $custom_emoji_id;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setCustomEmojiStickerSetThumbnail';
    }

    public function validate(): void
    {
        if (empty($this->name)) {
            throw new TelegramValidationException('name cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'name' => $this->name,
        ] + $this->params;
    }
}
