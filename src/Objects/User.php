<?php

namespace Telegram\Bot\Objects;

/**
 * Class User.
 *
 * This object represents a Telegram user or bot.
 *
 * @method int      getId()                         Unique identifier for this user or bot. Can have up to 52 significant bits.
 * @method bool     getIsBot()                      True, if this user is a bot.
 * @method string   getFirstName()                  User's or bot's first name.
 * @method string|null   getLastName()              (Optional). User's or bot's last name.
 * @method string|null   getUsername()              (Optional). User's or bot's username.
 * @method string|null   getLanguageCode()          (Optional). IETF language tag of the user's language.
 * @method bool|null     getIsPremium()             (Optional). True, if this user is a Telegram Premium user.
 * @method bool|null     getAddedToAttachmentMenu() (Optional). True, if this user added the bot to the attachment menu.
 * @method bool|null     getCanJoinGroups()         (Optional). True, if the bot can be invited to groups. Returned only in getMe.
 * @method bool|null     getCanReadAllGroupMessages() (Optional). True, if privacy mode is disabled for the bot. Returned only in getMe.
 * @method bool|null     getSupportsInlineQueries() (Optional). True, if the bot supports inline queries. Returned only in getMe.
 * @method bool|null     getCanConnectToBusiness()  (Optional). True, if the bot can be connected to a Telegram Business account. Returned only in getMe.
 * @method bool|null     getHasMainWebApp()         (Optional). True, if the bot has a main Web App. Returned only in getMe.
 */
class User extends BaseObject
{
    /**
     * Define relations for the User object.
     *
     * @return array
     */
    public function relations()
    {
        return [];
    }
}
