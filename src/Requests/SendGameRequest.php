<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the sendGame method.
 *
 * Use this method to send a game.
 *
 * @link https://core.telegram.org/bots/api#sendgame
 */
class SendGameRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'reply_markup',
    ];

    /**
     * @param  int  $chat_id  Unique identifier for the target chat
     * @param  string  $game_short_name  Short name of the game, serves as the unique identifier for the game
     */
    public function __construct(
        protected int $chat_id,
        protected string $game_short_name,
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
        return 'sendGame';
    }

    public function validate(): void
    {
        if (empty($this->game_short_name)) {
            throw new TelegramValidationException('game_short_name cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'game_short_name' => $this->game_short_name,
        ] + $this->params;
    }
}
