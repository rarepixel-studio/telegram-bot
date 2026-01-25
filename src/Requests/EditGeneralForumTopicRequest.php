<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the editGeneralForumTopic method.
 *
 * Use this method to edit the name of the 'General' topic in a forum supergroup chat.
 *
 * @link https://core.telegram.org/bots/api#editgeneralforumtopic
 */
class EditGeneralForumTopicRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     * @param  string  $name  New topic name, 1-128 characters
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $name,
    ) {}

    public function getMethod(): string
    {
        return 'editGeneralForumTopic';
    }

    public function validate(): void
    {
        $nameLength = mb_strlen($this->name);

        if ($nameLength < 1 || $nameLength > 128) {
            throw new TelegramValidationException('name must be between 1 and 128 characters');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'name' => $this->name,
        ];
    }
}
