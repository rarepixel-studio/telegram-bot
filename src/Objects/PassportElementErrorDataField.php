<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportElementErrorDataField.
 *
 * Represents an issue in one of the data fields that was provided by the user.
 * The error is considered resolved when the field's value changes.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrordatafield
 */
class PassportElementErrorDataField extends PassportElementError
{
    /**
     * Name of the data field which has the error.
     */
    public function getFieldName(): string
    {
        return $this->items['field_name'];
    }

    /**
     * Base64-encoded data hash.
     */
    public function getDataHash(): string
    {
        return $this->items['data_hash'];
    }
}
