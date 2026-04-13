<?php

namespace Telegram\Bot\Requests;

/**
 * Class ReplaceManagedBotTokenRequest.
 */
class ReplaceManagedBotTokenRequest extends TelegramApiRequest
{
    /**
     * @param  int  $botId  Identifier of the managed bot.
     */
    public function __construct(
        public int $botId,
    ) {
        $this->params = [
            'bot_id' => $botId,
        ];
    }
}
