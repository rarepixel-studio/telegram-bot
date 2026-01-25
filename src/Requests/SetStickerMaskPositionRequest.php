<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\MaskPosition;

/**
 * Request object for the setStickerMaskPosition method.
 *
 * Use this method to change the mask position of a mask sticker.
 *
 * @link https://core.telegram.org/bots/api#setstickermaskposition
 */
class SetStickerMaskPositionRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'mask_position',
    ];

    /**
     * @param  string  $sticker  File identifier of the sticker
     */
    public function __construct(
        protected string $sticker,
    ) {}

    protected array $params = [];

    public function maskPosition(MaskPosition $mask_position): self
    {
        $this->params['mask_position'] = $mask_position;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setStickerMaskPosition';
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
