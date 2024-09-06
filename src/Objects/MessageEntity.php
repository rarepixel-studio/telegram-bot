<?php

namespace Telegram\Bot\Objects;

/**
 * Class MessageEntity.
 *
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * @method string         getType()           Type of the entity. Can be “mention” (@username), “hashtag” (#hashtag),
 *                                            “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org),
 *                                            “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123),
 *                                            “bold” (bold text), “italic” (italic text), “underline” (underlined text),
 *                                            “strikethrough” (strikethrough text), “spoiler” (spoiler message),
 *                                            “blockquote” (block quotation), “expandable_blockquote” (collapsed-by-default block quotation),
 *                                            “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs),
 *                                            “text_mention” (for users without usernames), “custom_emoji” (for inline custom emoji stickers).
 * @method int            getOffset()         Offset in UTF-16 code units to the start of the entity.
 * @method int            getLength()         Length of the entity in UTF-16 code units.
 * @method string|null    getUrl()            (Optional). For “text_link” only, URL that will be opened after user taps on the text.
 * @method User|null      getUser()           (Optional). For “text_mention” only, the mentioned user.
 * @method string|null    getLanguage()       (Optional). For “pre” only, the programming language of the entity text.
 * @method string|null    getCustomEmojiId()  (Optional). For “custom_emoji” only, unique identifier of the custom emoji.
 */
class MessageEntity extends BaseObject
{
    /**
     * Define the relations between objects.
     *
     * @return array
     */
    public function relations()
    {
        return [
            'user' => User::class,
        ];
    }

    /**
     * Check if the entity type is an HTML formatting entity.
     *
     * @return bool
     */
    public function isHtmlEntity(): bool
    {
        return in_array($this->getType(), [
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'spoiler',
            'blockquote',
            'expandable_blockquote',
            'code',
            'pre',
            'text_link'
        ]);
    }
}
