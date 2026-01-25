<?php

namespace Telegram\Bot\Objects;

/**
 * Class WebAppData.
 *
 * Describes data sent from a Web App to the bot.
 */
class WebAppData extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The data.
     */
    public function getData(): string
    {
        return $this->items['data'];
    }

    /**
     * Text of the web_app keyboard button from which the Web App was opened.
     */
    public function getButtonText(): string
    {
        return $this->items['button_text'];
    }
}
