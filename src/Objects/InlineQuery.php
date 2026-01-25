<?php

namespace Telegram\Bot\Objects;

/**
 * Class InlineQuery. *
 *
 * @link https://core.telegram.org/bots/api#inlinequery
 */
class InlineQuery extends BaseObject
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
     * Unique identifier for this query.
     */
    public function getId(): int
    {
        return $this->items['id'];
    }

    /**
     * Sender.
     */
    public function getFrom(): User
    {
        return $this->items['from'];
    }

    /**
     * (Optional). Sender location, only for bots that request user location.
     */
    public function getLocation(): ?Location
    {
        return $this->items['location'] ?? null;
    }

    /**
     * Text of the query.
     */
    public function getQuery(): string
    {
        return $this->items['query'];
    }

    /**
     * Offset of the results to be returned.
     */
    public function getOffset(): string
    {
        return $this->items['offset'];
    }
}
