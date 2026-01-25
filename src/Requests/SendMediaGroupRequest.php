<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputMedia;
use Telegram\Bot\Objects\InputMediaAudio;
use Telegram\Bot\Objects\InputMediaDocument;
use Telegram\Bot\Objects\InputMediaPhoto;
use Telegram\Bot\Objects\InputMediaVideo;
use Telegram\Bot\Objects\ReplyParameters;

/**
 * Request object for the sendMediaGroup method.
 *
 * Use this method to send a group of photos, videos, documents or audios as an album.
 * Documents and audio files can be only grouped in an album with messages of the same type.
 * On success, an array of Message objects that were sent is returned.
 *
 * @link https://core.telegram.org/bots/api#sendmediagroup
 */
class SendMediaGroupRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  array<InputMediaPhoto|InputMediaVideo|InputMediaAudio|InputMediaDocument|array>  $media  A JSON-serialized array describing messages to be sent, must include 2-10 items
     */
    public function __construct(
        protected int|string $chat_id,
        protected array $media,
    ) {}

    /**
     * Unique identifier of the business connection on behalf of which the message will be sent.
     */
    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    /**
     * Unique identifier for the target message thread (topic) of the forum; for forum supergroups only.
     */
    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    /**
     * Identifier of the direct messages topic to which the messages will be sent; required if the messages are sent to a direct messages chat.
     */
    public function directMessagesTopicId(int $direct_messages_topic_id): self
    {
        $this->params['direct_messages_topic_id'] = $direct_messages_topic_id;

        return $this;
    }

    /**
     * Sends messages silently. Users will receive a notification with no sound.
     */
    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    /**
     * Protects the contents of the sent messages from forwarding and saving.
     */
    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    /**
     * Pass True to allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message.
     */
    public function allowPaidBroadcast(bool $allow_paid_broadcast): self
    {
        $this->params['allow_paid_broadcast'] = $allow_paid_broadcast;

        return $this;
    }

    /**
     * Unique identifier of the message effect to be added to the message; for private chats only.
     */
    public function messageEffectId(string $message_effect_id): self
    {
        $this->params['message_effect_id'] = $message_effect_id;

        return $this;
    }

    /**
     * Description of the message to reply to.
     */
    public function replyParameters(ReplyParameters|array $reply_parameters): self
    {
        $this->params['reply_parameters'] = $reply_parameters;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendMediaGroup';
    }

    public function validate(): void
    {
        $mediaCount = count($this->media);

        if ($mediaCount < 2) {
            throw new TelegramValidationException('Media array must include at least 2 items');
        }

        if ($mediaCount > 10) {
            throw new TelegramValidationException('Media array must not exceed 10 items');
        }

        // Validate each media item
        foreach ($this->media as $index => $media) {
            if (! ($media instanceof InputMediaPhoto)
                && ! ($media instanceof InputMediaVideo)
                && ! ($media instanceof InputMediaAudio)
                && ! ($media instanceof InputMediaDocument)
                && ! is_array($media)
            ) {
                throw new TelegramValidationException("Media item at index {$index} must be an InputMediaPhoto, InputMediaVideo, InputMediaAudio, InputMediaDocument, or array");
            }

            // Normalize arrays to InputMedia objects
            if (is_array($media)) {
                $type = $media['type'] ?? null;
                $this->media[$index] = match ($type) {
                    'photo' => InputMediaPhoto::fromArray($media),
                    'video' => InputMediaVideo::fromArray($media),
                    'audio' => InputMediaAudio::fromArray($media),
                    'document' => InputMediaDocument::fromArray($media),
                    default => throw new TelegramValidationException("Invalid media type '{$type}' at index {$index}. Must be one of: photo, video, audio, document"),
                };
            }
        }

        $this->validateReplyParameters($this->params);
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'media' => $this->media,
        ] + $this->params;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $params = $this->buildParams();

        // Don't normalize media array - extractInputMedia needs InputMedia objects
        foreach ($params as $key => $value) {
            if ($key === 'media') {
                $params[$key] = $value;

                continue;
            }

            $params[$key] = $this->normalizeValue($value);
        }

        return $this->filterNullValues($params);
    }
}
