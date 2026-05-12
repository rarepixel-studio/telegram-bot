<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getChatAdministrators method.
 *
 * Use this method to get a list of administrators in a chat.
 *
 * @link https://core.telegram.org/bots/api#getchatadministrators
 */
class GetChatAdministratorsRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup or channel
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    /**
     * Pass True to additionally receive all bots that are administrators of the chat. By default, bots other than the current bot are omitted.
     */
    public function returnBots(bool $return_bots): self
    {
        $this->params['return_bots'] = $return_bots;

        return $this;
    }

    public function getMethod(): string
    {
        return 'getChatAdministrators';
    }

    public function validate(): void
    {
        // No specific validation needed
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
        ] + $this->params;
    }
}
