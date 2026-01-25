<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;
use Telegram\Bot\Objects\SuggestedPostParameters;

/**
 * Method to send video note messages.
 *
 * @link https://core.telegram.org/bots/api#sendvideonote
 */
class SendVideoNoteRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'suggested_post_parameters',
        'reply_markup',
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  InputFile|string  $video_note  Video note to send
     */
    public function __construct(
        protected int|string $chat_id,
        protected InputFile|string $video_note,
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
     * Duration of sent video in seconds.
     *
     * @return $this
     */
    public function duration(int $duration): self
    {
        $this->params['duration'] = $duration;

        return $this;
    }

    /**
     * Video width and height, i.e. diameter of the video message.
     *
     * @return $this
     */
    public function length(int $length): self
    {
        $this->params['length'] = $length;

        return $this;
    }

    /**
     * Thumbnail of the file sent.
     *
     * @return $this
     */
    public function thumbnail(InputFile|string $thumbnail): self
    {
        $this->params['thumbnail'] = $thumbnail;

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
     * Unique identifier of the message effect to be added to the message.
     *
     * @return $this
     */
    public function messageEffectId(string $message_effect_id): self
    {
        $this->params['message_effect_id'] = $message_effect_id;

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
        return 'sendVideoNote';
    }

    /**
     * {@inheritDoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
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
            'video_note' => $this->video_note,
        ] + $this->params;
    }

    /**
     * Resolve the response into a Message object.
     */
    public function resolveResponse(mixed $response): Message
    {
        return new Message($response);
    }
}
