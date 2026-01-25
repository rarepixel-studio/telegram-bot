<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputSticker;

/**
 * Request object for the addStickerToSet method.
 *
 * Use this method to add a new sticker to a set created by the bot.
 *
 * @link https://core.telegram.org/bots/api#addstickertoset
 */
class AddStickerToSetRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'sticker',
    ];

    /**
     * @param  int  $user_id  User identifier of sticker set owner
     * @param  string  $name  Sticker set name
     * @param  InputSticker  $sticker  Sticker object
     */
    public function __construct(
        protected int $user_id,
        protected string $name,
        protected InputSticker $sticker,
    ) {}

    public function getMethod(): string
    {
        return 'addStickerToSet';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'sticker' => $this->sticker,
        ];
    }
}
