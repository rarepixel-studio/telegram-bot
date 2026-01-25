<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the stopPoll method.
 *
 * Use this method to stop a poll which was sent by the bot.
 *
 * @link https://core.telegram.org/bots/api#stoppoll
 */
class StopPollRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'reply_markup',
    ];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $message_id  Identifier of the original message with the poll
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $message_id,
    ) {}

    protected array $params = [];

    public function replyMarkup(array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    public function getMethod(): string
    {
        return 'stopPoll';
    }

    public function validate(): void
    {
        // Basic validation
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_id' => $this->message_id,
        ] + $this->params;
    }
}
