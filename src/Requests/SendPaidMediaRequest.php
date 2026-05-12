<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\InputPaidMedia;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;
use Telegram\Bot\Objects\SuggestedPostParameters;

/**
 * Method to send paid media.
 *
 * @link https://core.telegram.org/bots/api#sendpaidmedia
 */
class SendPaidMediaRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'caption_entities',
        'suggested_post_parameters',
        'reply_markup',
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  int  $star_count  The number of Telegram Stars required to access the media
     * @param  array<int, InputPaidMedia|array>  $media  Media to send
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $star_count,
        protected array $media,
    ) {}

    /**
     * Unique identifier of the business connection on behalf of which the message will be sent.
     *
     * @return $this
     */
    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    /**
     * Unique identifier for the target message thread (topic) of the forum; for forum supergroups only.
     *
     * @return $this
     */
    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    /**
     * Identifier of the direct messages topic to which the message will be sent.
     *
     * @return $this
     */
    public function directMessagesTopicId(int $direct_messages_topic_id): self
    {
        $this->params['direct_messages_topic_id'] = $direct_messages_topic_id;

        return $this;
    }

    /**
     * Bot-defined paid media payload, 0-128 bytes.
     *
     * @return $this
     */
    public function payload(string $payload): self
    {
        $this->params['payload'] = $payload;

        return $this;
    }

    /**
     * Media caption, 0-1024 characters after entities parsing.
     *
     * @return $this
     */
    public function caption(string $caption): self
    {
        $this->params['caption'] = $caption;

        return $this;
    }

    /**
     * Mode for parsing entities in the media caption.
     *
     * @return $this
     *
     * @throws TelegramValidationException
     */
    public function parseMode(ParseMode|string $parse_mode): self
    {
        if (is_string($parse_mode)) {
            try {
                $parse_mode = ParseMode::from($parse_mode);
            } catch (\ValueError $exception) {
                throw new TelegramValidationException('Invalid parse_mode provided', previous: $exception);
            }
        }

        $this->params['parse_mode'] = $parse_mode;

        return $this;
    }

    /**
     * A JSON-serialized list of special entities that appear in the caption.
     *
     * @return $this
     */
    public function captionEntities(array $caption_entities): self
    {
        $this->params['caption_entities'] = $caption_entities;

        return $this;
    }

    /**
     * Pass True if the caption must be shown above the message media.
     *
     * @return $this
     */
    public function showCaptionAboveMedia(bool $show_caption_above_media): self
    {
        $this->params['show_caption_above_media'] = $show_caption_above_media;

        return $this;
    }

    /**
     * Sends the message silently. Users will receive a notification with no sound.
     *
     * @return $this
     */
    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    /**
     * Protects the contents of the sent message from forwarding and saving.
     *
     * @return $this
     */
    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    /**
     * Allow paid broadcast for higher throughput.
     *
     * @return $this
     */
    public function allowPaidBroadcast(bool $allow_paid_broadcast): self
    {
        $this->params['allow_paid_broadcast'] = $allow_paid_broadcast;

        return $this;
    }

    /**
     * Suggested post parameters for direct messages chats.
     *
     * @param  SuggestedPostParameters|array  $suggested_post_parameters  Suggested post parameters
     * @return $this
     */
    public function suggestedPostParameters(SuggestedPostParameters|array $suggested_post_parameters): self
    {
        $this->params['suggested_post_parameters'] = $suggested_post_parameters;

        return $this;
    }

    /**
     * Description of the message to reply to.
     *
     * @return $this
     */
    public function replyParameters(ReplyParameters|array $reply_parameters): self
    {
        $this->params['reply_parameters'] = $reply_parameters;

        return $this;
    }

    /**
     * Additional interface options.
     *
     * @return $this
     */
    public function replyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'sendPaidMedia';
    }

    /**
     * {@inheritDoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        if ($this->star_count < 1 || $this->star_count > 10000) {
            throw new TelegramValidationException('star_count must be between 1 and 10000');
        }

        $mediaCount = count($this->media);
        if ($mediaCount < 1 || $mediaCount > 10) {
            throw new TelegramValidationException('media must contain between 1 and 10 items');
        }

        foreach ($this->media as $media) {
            if ($media instanceof InputPaidMedia) {
                $this->validateInputPaidMediaObject($media);

                continue;
            }

            if (is_array($media)) {
                $this->validateInputPaidMediaArray($media);

                continue;
            }

            throw new TelegramValidationException('media items must be InputPaidMedia objects or arrays');
        }

        if (isset($this->params['parse_mode'], $this->params['caption_entities'])) {
            throw new TelegramValidationException('parse_mode cannot be used with caption_entities');
        }

        if (isset($this->params['payload']) && strlen($this->params['payload']) > 128) {
            throw new TelegramValidationException('payload must not exceed 128 bytes');
        }

        $this->validateSuggestedPostParameters($this->params);
        $this->validateReplyParameters($this->params);
        $this->validateReplyMarkup($this->params);
    }

    /**
     * {@inheritDoc}
     */
    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'star_count' => $this->star_count,
            'media' => $this->media,
        ] + $this->params;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $params = $this->buildParams();

        foreach ($params as $key => $value) {
            if ($key === 'media') {
                $params[$key] = $value;

                continue;
            }

            $params[$key] = $this->normalizeValue($value);
        }

        $params = $this->filterNullValues($params);

        return $this->encodeJsonFields($params);
    }

    /**
     * Resolve the response into a Message object.
     */
    public function resolveResponse(mixed $response): Message
    {
        return new Message($response);
    }

    /**
     * Validate an InputPaidMedia object.
     *
     * @throws TelegramValidationException
     */
    private function validateInputPaidMediaObject(InputPaidMedia $media): void
    {
        $type = $media->get('type');
        if (! in_array($type, ['photo', 'video', 'live_photo'], true)) {
            throw new TelegramValidationException('media.type must be photo, video, or live_photo');
        }

        if (! $media->has('media')) {
            throw new TelegramValidationException('media.media is required');
        }

        $value = $media->get('media');
        if ($value === null || $value === '') {
            throw new TelegramValidationException('media.media must not be empty');
        }

        if ($type === 'live_photo' && (! $media->has('photo') || $media->get('photo') === null || $media->get('photo') === '')) {
            throw new TelegramValidationException('media.photo is required for live_photo media');
        }
    }

    /**
     * Validate a media array payload.
     *
     * @param  array<string, mixed>  $media
     *
     * @throws TelegramValidationException
     */
    private function validateInputPaidMediaArray(array $media): void
    {
        if (! array_key_exists('type', $media)) {
            throw new TelegramValidationException('media.type is required');
        }

        $type = $media['type'];
        if (! in_array($type, ['photo', 'video', 'live_photo'], true)) {
            throw new TelegramValidationException('media.type must be photo, video, or live_photo');
        }

        if (! array_key_exists('media', $media)) {
            throw new TelegramValidationException('media.media is required');
        }

        $value = $media['media'];
        if ($value === null || $value === '') {
            throw new TelegramValidationException('media.media must not be empty');
        }

        if ($type === 'live_photo' && (! array_key_exists('photo', $media) || $media['photo'] === null || $media['photo'] === '')) {
            throw new TelegramValidationException('media.photo is required for live_photo media');
        }
    }
}
