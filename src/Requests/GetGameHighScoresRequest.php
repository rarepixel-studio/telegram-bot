<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the getGameHighScores method.
 *
 * Use this method to get data for high score tables.
 *
 * @link https://core.telegram.org/bots/api#getgamehighscores
 */
class GetGameHighScoresRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  Target user identifier
     */
    public function __construct(
        protected int $user_id,
    ) {}

    protected array $params = [];

    public function chatId(int $chat_id): self
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

    public function getMethod(): string
    {
        return 'getGameHighScores';
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
        ] + $this->params;
    }
}
