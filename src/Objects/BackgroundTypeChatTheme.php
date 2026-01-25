<?php

namespace Telegram\Bot\Objects;

/**
 * Class BackgroundTypeChatTheme.
 *
 * The background is taken directly from a built-in chat theme.
 *
 * @link https://core.telegram.org/bots/api#backgroundtypechattheme
 */
class BackgroundTypeChatTheme extends BackgroundType
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Name of the chat theme, which is usually an emoji.
     */
    public function getThemeName(): string
    {
        return $this->items['theme_name'];
    }
}
