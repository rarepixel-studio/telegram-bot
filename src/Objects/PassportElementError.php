<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportElementError.
 *
 * This object represents an error in the Telegram Passport element which was submitted that should be resolved by the user.
 *
 * @link https://core.telegram.org/bots/api#passportelementerror
 */
abstract class PassportElementError extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Error source.
     */
    public function getSource(): string
    {
        return $this->items['source'];
    }

    /**
     * The section of the user's Telegram Passport which has the error.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * Error message.
     */
    public function getMessage(): string
    {
        return $this->items['message'];
    }
}
