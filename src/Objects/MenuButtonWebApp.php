<?php

namespace Telegram\Bot\Objects;

/**
 * Class MenuButtonWebApp.
 *
 * Represents a menu button, which launches a Web App.
 */
class MenuButtonWebApp extends MenuButton
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'web_app' => WebAppInfo::class,
        ];
    }

    /**
     * Text on the button.
     */
    public function getText(): string
    {
        return $this->items['text'];
    }

    /**
     * Description of the Web App to be launched.
     */
    public function getWebApp(): WebAppInfo
    {
        return $this->items['web_app'];
    }
}
