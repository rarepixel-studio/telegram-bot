<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\InputChecklist;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;
use Telegram\Bot\Objects\SuggestedPostParameters;

/**
 * Request object for the sendChecklist method.
 *
 * Use this method to send a checklist. On success, the sent Message is returned.
 *
 * @link https://core.telegram.org/bots/api#sendchecklist
 */
class SendChecklistRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'checklist',
        'suggested_post_parameters',
        'reply_parameters',
        'reply_markup',
    ];

    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  InputChecklist|array  $checklist  A JSON-serialized object describing the checklist to be sent
     */
    public function __construct(
        protected int|string $chat_id,
        protected InputChecklist|array $checklist,
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
     * Identifier of the direct messages topic to which the message will be sent.
     */
    public function directMessagesTopicId(int $direct_messages_topic_id): self
    {
        $this->params['direct_messages_topic_id'] = $direct_messages_topic_id;

        return $this;
    }

    /**
     * Sends the message silently.
     */
    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    /**
     * Protects the contents of the sent message from forwarding and saving.
     */
    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    /**
     * Pass True to allow up to 1000 messages per second, ignoring broadcasting limits.
     */
    public function allowPaidBroadcast(bool $allow_paid_broadcast): self
    {
        $this->params['allow_paid_broadcast'] = $allow_paid_broadcast;

        return $this;
    }

    /**
     * Unique identifier of the message effect to be added to the message.
     */
    public function messageEffectId(string $message_effect_id): self
    {
        $this->params['message_effect_id'] = $message_effect_id;

        return $this;
    }

    /**
     * A JSON-serialized object containing the parameters of the suggested post to send.
     */
    public function suggestedPostParameters(SuggestedPostParameters|array $suggested_post_parameters): self
    {
        $this->params['suggested_post_parameters'] = $suggested_post_parameters;

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

    /**
     * Additional interface options.
     */
    public function replyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendChecklist';
    }

    public function validate(): void
    {
        // Normalize checklist from array to InputChecklist object
        if (is_array($this->checklist)) {
            $this->checklist = InputChecklist::fromArray($this->checklist);
        }

        // Validate checklist object
        if ($this->checklist instanceof InputChecklist) {
            $this->checklist->validate();
        }

        // Validate suggested post parameters if provided
        $this->validateSuggestedPostParameters($this->params);

        $this->validateReplyParameters($this->params);
        $this->validateReplyMarkup($this->params);
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'checklist' => $this->checklist,
        ] + $this->params;
    }
}
