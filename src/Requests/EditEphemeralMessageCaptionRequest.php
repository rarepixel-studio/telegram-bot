<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the editEphemeralMessageCaption method.
 *
 * @link https://core.telegram.org/bots/api#editephemeralmessagecaption
 */
class EditEphemeralMessageCaptionRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'caption_entities',
        'reply_markup',
    ];

    protected array $params = [];

    public function __construct() {}

    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    public function chatId(int|string $chat_id): self
    {
        $this->params['chat_id'] = $chat_id;

        return $this;
    }

    public function receiverUserId(int $receiver_user_id): self
    {
        $this->params['receiver_user_id'] = $receiver_user_id;

        return $this;
    }

    public function ephemeralMessageId(string $ephemeral_message_id): self
    {
        $this->params['ephemeral_message_id'] = $ephemeral_message_id;

        return $this;
    }

    public function caption(string $caption): self
    {
        $this->params['caption'] = $caption;

        return $this;
    }

    public function parseMode(string $parse_mode): self
    {
        $this->params['parse_mode'] = $parse_mode;

        return $this;
    }

    public function captionEntities(array $caption_entities): self
    {
        $this->params['caption_entities'] = $caption_entities;

        return $this;
    }

    /**
     * Pass True if the caption must be shown above the message media.
     */
    public function showCaptionAboveMedia(bool $show_caption_above_media): self
    {
        $this->params['show_caption_above_media'] = $show_caption_above_media;

        return $this;
    }

    public function replyMarkup(array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'editEphemeralMessageCaption';
    }

    public function validate(): void
    {
        // Validation needed
    }

    public function buildParams(): array
    {
        return $this->params;
    }
}
