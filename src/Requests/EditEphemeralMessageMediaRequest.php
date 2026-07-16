<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Objects\InputMedia;

/**
 * Request object for the editEphemeralMessageMedia method.
 *
 * @link https://core.telegram.org/bots/api#editephemeralmessagemedia
 */
class EditEphemeralMessageMediaRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'media',
        'reply_markup',
    ];

    protected array $params = [];

    public function __construct(InputMedia $media)
    {
        $this->params['media'] = $media;
    }

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

    public function ephemeralMessageId(string $ephemeral_message_id): self
    {
        $this->params['ephemeral_message_id'] = $ephemeral_message_id;

        return $this;
    }

    public function media(InputMedia $media): self
    {
        $this->params['media'] = $media;

        return $this;
    }

    public function replyMarkup(array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'editEphemeralMessageMedia';
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
