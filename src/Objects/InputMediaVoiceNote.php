<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaVoiceNote.
 *
 * Represents a voice note to be sent.
 *
 * @link https://core.telegram.org/bots/api#inputmediavoicenote
 */
class InputMediaVoiceNote extends InputMedia
{
    /**
     * Type of the result, must be voice_note.
     */
    public function getType(): string
    {
        return 'voice_note';
    }

    /**
     * File to send.
     */
    public function getMedia(): string
    {
        return $this->items['media'];
    }
}
