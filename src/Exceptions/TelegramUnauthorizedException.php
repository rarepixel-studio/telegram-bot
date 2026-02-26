<?php

namespace Telegram\Bot\Exceptions;

/**
 * Thrown when the Telegram API returns an "Unauthorized" response.
 *
 * This typically indicates an invalid bot token (correct format but wrong credentials).
 */
class TelegramUnauthorizedException extends TelegramResponseException
{
}
