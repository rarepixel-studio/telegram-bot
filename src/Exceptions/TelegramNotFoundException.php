<?php

namespace Telegram\Bot\Exceptions;

/**
 * Thrown when the Telegram API returns a "Not Found" response.
 *
 * This typically indicates an invalid bot token format (e.g. missing numeric prefix).
 */
class TelegramNotFoundException extends TelegramResponseException
{
}
