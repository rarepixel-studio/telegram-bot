<?php

namespace Telegram\Bot\Objects\InputContent;

use Telegram\Bot\Objects\InlineQuery\InlineBaseObject;
use Telegram\Bot\Objects\InputRichMessage;

/**
 * Class InputRichMessageContent.
 *
 * Represents the content of a rich message to be sent as the result of an inline query.
 *
 * @link https://core.telegram.org/bots/api#inputrichmessagecontent
 */
class InputRichMessageContent extends InlineBaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'rich_message' => InputRichMessage::class,
        ];
    }

    /**
     * The message to be sent.
     */
    public function getRichMessage(): InputRichMessage
    {
        return $this->items['rich_message'];
    }
}
