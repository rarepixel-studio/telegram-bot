<?php

namespace Telegram\Bot\Exceptions;

/**
 * Thrown when the Telegram API returns an error indicating the user/participant ID is invalid.
 *
 * This can occur in any request that requires a valid user ID, such as getChatMember,
 * banChatMember, promoteChatMember, etc.
 */
class TelegramInvalidUserIdException extends TelegramResponseException
{
}
