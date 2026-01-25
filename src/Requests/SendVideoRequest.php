<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;

/**
 * Method to send video files.
 *
 * @link https://core.telegram.org/bots/api#sendvideo
 */
class SendVideoRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'caption_entities',
        'reply_markup',
    ];

    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  InputFile|string  $video  Video to send. Pass a file_id as String to send a video that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using multipart/form-data.
     */
    public function __construct(
        protected int|string $chat_id,
        protected InputFile|string $video,
    ) {}

    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection on behalf of which the message will be sent
     */
    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    /**
     * @param  int  $message_thread_id  Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
     */
    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    /**
     * @param  int  $duration  Duration of sent video in seconds
     */
    public function duration(int $duration): self
    {
        $this->params['duration'] = $duration;

        return $this;
    }

    /**
     * @param  int  $width  Video width
     */
    public function width(int $width): self
    {
        $this->params['width'] = $width;

        return $this;
    }

    /**
     * @param  int  $height  Video height
     */
    public function height(int $height): self
    {
        $this->params['height'] = $height;

        return $this;
    }

    /**
     * @param  InputFile|string  $thumbnail  Thumbnail of the file sent
     */
    public function thumbnail(InputFile|string $thumbnail): self
    {
        $this->params['thumbnail'] = $thumbnail;

        return $this;
    }

    /**
     * @param  InputFile|string  $cover  Cover for the video in the message
     */
    public function cover(InputFile|string $cover): self
    {
        $this->params['cover'] = $cover;

        return $this;
    }

    /**
     * @param  int  $start_timestamp  Start timestamp for the video in the message
     */
    public function startTimestamp(int $start_timestamp): self
    {
        $this->params['start_timestamp'] = $start_timestamp;

        return $this;
    }

    /**
     * @param  string  $caption  Video caption (may also be used when resending videos by file_id), 0-1024 characters after entities parsing
     */
    public function caption(string $caption): self
    {
        $this->params['caption'] = $caption;

        return $this;
    }

    /**
     * @param  ParseMode|string  $parse_mode  Mode for parsing entities in the video caption.
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
     * @param  array  $caption_entities  A JSON-serialized list of special entities that appear in the caption
     */
    public function captionEntities(array $caption_entities): self
    {
        $this->params['caption_entities'] = $caption_entities;

        return $this;
    }

    /**
     * @param  bool  $show_caption_above_media  Pass True, if the caption must be shown above the message media
     */
    public function showCaptionAboveMedia(bool $show_caption_above_media): self
    {
        $this->params['show_caption_above_media'] = $show_caption_above_media;

        return $this;
    }

    /**
     * @param  bool  $has_spoiler  Pass True if the video needs to be covered with a spoiler animation
     */
    public function hasSpoiler(bool $has_spoiler): self
    {
        $this->params['has_spoiler'] = $has_spoiler;

        return $this;
    }

    /**
     * @param  bool  $supports_streaming  Pass True if the uploaded video is suitable for streaming
     */
    public function supportsStreaming(bool $supports_streaming): self
    {
        $this->params['supports_streaming'] = $supports_streaming;

        return $this;
    }

    /**
     * @param  bool  $disable_notification  Sends the message silently. Users will receive a notification with no sound.
     */
    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    /**
     * @param  bool  $protect_content  Protects the contents of the sent message from forwarding and saving
     */
    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    /**
     * @param  ReplyParameters|array  $reply_parameters  Description of the message to reply to
     */
    public function replyParameters(ReplyParameters|array $reply_parameters): self
    {
        $this->params['reply_parameters'] = $reply_parameters;

        return $this;
    }

    /**
     * @param  InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array  $reply_markup  Additional interface options
     */
    public function replyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendVideo';
    }

    public function validate(): void
    {
        if (isset($this->params['parse_mode'], $this->params['caption_entities'])) {
            throw new TelegramValidationException('parse_mode cannot be used with caption_entities');
        }

        $this->validateReplyParameters($this->params);
        $this->validateReplyMarkup($this->params);
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'video' => $this->video,
        ] + $this->params;
    }

    public function resolveResponse(mixed $response): Message
    {
        return new Message($response);
    }
}
