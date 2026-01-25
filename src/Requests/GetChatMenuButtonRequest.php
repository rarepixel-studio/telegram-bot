<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getChatMenuButton method.
 */
class GetChatMenuButtonRequest extends TelegramApiRequest
{
    protected array $params = [];

    public function __construct() {}

    public function chatId(int|string $chat_id): self
    {
        $this->params['chat_id'] = $chat_id;

        return $this;
    }

    public function getMethod(): string
    {
        return 'getChatMenuButton';
    }

    public function validate(): void {}

    public function buildParams(): array
    {
        return $this->params;
    }
}
