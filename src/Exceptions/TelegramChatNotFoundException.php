<?php

namespace Telegram\Bot\Exceptions;

/**
 * Thrown when the Telegram API returns a "Bad Request: chat not found" response.
 *
 * This typically indicates the provided chat ID does not exist or the bot has no access to it.
 */
class TelegramChatNotFoundException extends TelegramResponseException
{
}
