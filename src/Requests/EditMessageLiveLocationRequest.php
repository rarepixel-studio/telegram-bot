<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the editMessageLiveLocation method.
 *
 * Use this method to edit live location messages.
 *
 * @link https://core.telegram.org/bots/api#editmessagelivelocation
 */
class EditMessageLiveLocationRequest extends TelegramApiRequest
{
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

    public function messageId(int $message_id): self
    {
        $this->params['message_id'] = $message_id;

        return $this;
    }

    public function inlineMessageId(string $inline_message_id): self
    {
        $this->params['inline_message_id'] = $inline_message_id;

        return $this;
    }

    public function latitude(float $latitude): self
    {
        $this->params['latitude'] = $latitude;

        return $this;
    }

    public function longitude(float $longitude): self
    {
        $this->params['longitude'] = $longitude;

        return $this;
    }

    public function livePeriod(int $live_period): self
    {
        $this->params['live_period'] = $live_period;

        return $this;
    }

    public function horizontalAccuracy(float $horizontal_accuracy): self
    {
        $this->params['horizontal_accuracy'] = $horizontal_accuracy;

        return $this;
    }

    public function heading(int $heading): self
    {
        $this->params['heading'] = $heading;

        return $this;
    }

    public function proximityAlertRadius(int $proximity_alert_radius): self
    {
        $this->params['proximity_alert_radius'] = $proximity_alert_radius;

        return $this;
    }

    public function replyMarkup(array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'editMessageLiveLocation';
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
