<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setStickerKeywords method.
 *
 * Use this method to change search keywords assigned to a regular or custom emoji sticker.
 *
 * @link https://core.telegram.org/bots/api#setstickerkeywords
 */
class SetStickerKeywordsRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'keywords',
    ];

    /**
     * @param  string  $sticker  File identifier of the sticker
     */
    public function __construct(
        protected string $sticker,
    ) {}

    protected array $params = [];

    public function keywords(array $keywords): self
    {
        $this->params['keywords'] = $keywords;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setStickerKeywords';
    }

    public function validate(): void
    {
        if (empty($this->sticker)) {
            throw new TelegramValidationException('sticker cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'sticker' => $this->sticker,
        ] + $this->params;
    }
}
