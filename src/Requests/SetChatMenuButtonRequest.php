<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the setChatMenuButton method.
 */
class SetChatMenuButtonRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'menu_button',
    ];

    protected array $params = [];

    public function __construct() {}

    public function chatId(int|string $chat_id): self
    {
        $this->params['chat_id'] = $chat_id;

        return $this;
    }

    public function menuButton(array $menu_button): self
    {
        $this->params['menu_button'] = $menu_button;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setChatMenuButton';
    }

    public function validate(): void {}

    public function buildParams(): array
    {
        return $this->params;
    }
}
