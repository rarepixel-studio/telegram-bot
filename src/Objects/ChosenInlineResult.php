<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChosenInlineResult. *
 *
 * @link https://core.telegram.org/bots/api#choseninlineresult
 */
class ChosenInlineResult extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'from' => User::class,
            'location' => Location::class,
        ];
    }

    /**
     * The unique identifier for the result that was chosen.
     */
    public function getResultId(): string
    {
        return $this->items['result_id'];
    }

    /**
     * The user that chose the result.
     */
    public function getFrom(): User
    {
        return $this->items['from'];
    }

    /**
     * (Optional). Sender location, only for bots that require user location.
     */
    public function getLocation(): ?Location
    {
        return $this->items['location'] ?? null;
    }

    /**
     * Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
     */
    public function getInlineMessageId(): string
    {
        return $this->items['inline_message_id'];
    }

    /**
     * The query that was used to obtain the result.
     */
    public function getQuery(): string
    {
        return $this->items['query'];
    }
}
