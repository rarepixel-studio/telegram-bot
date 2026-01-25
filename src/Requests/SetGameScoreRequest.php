<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setGameScore method.
 *
 * Use this method to set the score of the specified user in a game.
 *
 * @link https://core.telegram.org/bots/api#setgamescore
 */
class SetGameScoreRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  User identifier
     * @param  int  $score  New score, must be non-negative
     */
    public function __construct(
        protected int $user_id,
        protected int $score,
    ) {}

    protected array $params = [];

    public function force(bool $force): self
    {
        $this->params['force'] = $force;

        return $this;
    }

    public function disableEditMessage(bool $disable_edit_message): self
    {
        $this->params['disable_edit_message'] = $disable_edit_message;

        return $this;
    }

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
        return 'setGameScore';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
        if ($this->score < 0) {
            throw new TelegramValidationException('score must be non-negative');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'score' => $this->score,
        ] + $this->params;
    }
}
