<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the sendInvoice method.
 *
 * Use this method to send invoices.
 *
 * @link https://core.telegram.org/bots/api#sendinvoice
 */
class SendInvoiceRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string  $title  Product name, 1-32 characters
     * @param  string  $description  Product description, 1-255 characters
     * @param  string  $payload  Bot-defined invoice payload, 1-128 bytes
     * @param  string  $currency  Three-letter ISO 4217 currency code
     * @param  array  $prices  Price breakdown, a JSON-serialized list of components
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $title,
        protected string $description,
        protected string $payload,
        protected string $currency,
        protected array $prices,
    ) {}

    protected array $params = [];

    public function providerToken(string $provider_token): self
    {
        $this->params['provider_token'] = $provider_token;

        return $this;
    }

    public function maxTipAmount(int $max_tip_amount): self
    {
        $this->params['max_tip_amount'] = $max_tip_amount;

        return $this;
    }

    public function suggestedTipAmounts(array $suggested_tip_amounts): self
    {
        $this->params['suggested_tip_amounts'] = $suggested_tip_amounts;

        return $this;
    }

    public function startParameter(string $start_parameter): self
    {
        $this->params['start_parameter'] = $start_parameter;

        return $this;
    }

    public function providerData(string $provider_data): self
    {
        $this->params['provider_data'] = $provider_data;

        return $this;
    }

    public function photoUrl(string $photo_url): self
    {
        $this->params['photo_url'] = $photo_url;

        return $this;
    }

    public function photoSize(int $photo_size): self
    {
        $this->params['photo_size'] = $photo_size;

        return $this;
    }

    public function photoWidth(int $photo_width): self
    {
        $this->params['photo_width'] = $photo_width;

        return $this;
    }

    public function photoHeight(int $photo_height): self
    {
        $this->params['photo_height'] = $photo_height;

        return $this;
    }

    public function needName(bool $need_name): self
    {
        $this->params['need_name'] = $need_name;

        return $this;
    }

    public function needPhoneNumber(bool $need_phone_number): self
    {
        $this->params['need_phone_number'] = $need_phone_number;

        return $this;
    }

    public function needEmail(bool $need_email): self
    {
        $this->params['need_email'] = $need_email;

        return $this;
    }

    public function needShippingAddress(bool $need_shipping_address): self
    {
        $this->params['need_shipping_address'] = $need_shipping_address;

        return $this;
    }

    public function sendPhoneNumberToProvider(bool $send_phone_number_to_provider): self
    {
        $this->params['send_phone_number_to_provider'] = $send_phone_number_to_provider;

        return $this;
    }

    public function sendEmailToProvider(bool $send_email_to_provider): self
    {
        $this->params['send_email_to_provider'] = $send_email_to_provider;

        return $this;
    }

    public function isFlexible(bool $is_flexible): self
    {
        $this->params['is_flexible'] = $is_flexible;

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
        return 'sendInvoice';
    }

    public function validate(): void
    {
        if (empty($this->title)) {
            throw new TelegramValidationException('title cannot be empty');
        }
        if (empty($this->currency)) {
            throw new TelegramValidationException('currency cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'title' => $this->title,
            'description' => $this->description,
            'payload' => $this->payload,
            'currency' => $this->currency,
            'prices' => json_encode($this->prices),
        ] + $this->params;
    }
}
