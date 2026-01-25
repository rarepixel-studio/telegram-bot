<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\FileUpload\InputFile;

/**
 * Request object for the sendSticker method.
 *
 * Use this method to send static .WEBP, animated .TGS, or video .WEBM stickers.
 *
 * @link https://core.telegram.org/bots/api#sendsticker
 */
class SendStickerRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'reply_markup',
    ];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  InputFile|string  $sticker  Sticker to send
     */
    public function __construct(
        protected int|string $chat_id,
        protected InputFile|string $sticker,
    ) {}

    protected array $params = [];

    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    public function emoji(string $emoji): self
    {
        $this->params['emoji'] = $emoji;

        return $this;
    }

    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    public function allowPaidBroadcast(bool $allow_paid_broadcast): self
    {
        $this->params['allow_paid_broadcast'] = $allow_paid_broadcast;

        return $this;
    }

    public function messageEffectId(string $message_effect_id): self
    {
        $this->params['message_effect_id'] = $message_effect_id;

        return $this;
    }

    public function replyParameters(array $reply_parameters): self
    {
        $this->params['reply_parameters'] = $reply_parameters;

        return $this;
    }

    public function replyMarkup(array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendSticker';
    }

    public function validate(): void
    {
        // Validation needed
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'sticker' => $this->sticker,
        ] + $this->params;
    }
}
