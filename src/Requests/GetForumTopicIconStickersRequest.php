<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getForumTopicIconStickers method.
 *
 * Use this method to get custom emoji stickers for forum topic icons.
 *
 * @link https://core.telegram.org/bots/api#getforumtopiconstickers
 */
class GetForumTopicIconStickersRequest extends TelegramApiRequest
{
    public function __construct()
    {
        // No parameters required
    }

    public function getMethod(): string
    {
        return 'getForumTopicIconStickers';
    }

    public function validate(): void
    {
        // No specific validation needed
    }

    public function buildParams(): array
    {
        return [];
    }
}
