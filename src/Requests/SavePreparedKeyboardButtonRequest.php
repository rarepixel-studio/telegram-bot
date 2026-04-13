<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Objects\KeyboardButton;

/**
 * Class SavePreparedKeyboardButtonRequest.
 */
class SavePreparedKeyboardButtonRequest extends TelegramApiRequest
{
    /**
     * @param  int  $userId  Unique identifier of the target user.
     * @param  KeyboardButton|array<string, mixed>  $button  A JSON-serialized object describing the button to be saved.
     */
    public function __construct(
        public int $userId,
        public KeyboardButton|array $button,
    ) {
        $this->params = [
            'user_id' => $userId,
            'button' => is_array($button) ? $button : $button->toArray(),
        ];
    }
}
