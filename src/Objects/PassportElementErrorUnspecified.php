<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportElementErrorUnspecified.
 *
 * Represents an issue in an unspecified place.
 * The error is considered resolved when new data is added.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrorunspecified
 */
class PassportElementErrorUnspecified extends PassportElementError
{
    /**
     * Base64-encoded element hash.
     */
    public function getElementHash(): string
    {
        return $this->items['element_hash'];
    }
}
