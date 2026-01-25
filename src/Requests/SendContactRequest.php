<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;
use Telegram\Bot\Objects\SuggestedPostParameters;

/**
 * Request object for the sendContact method.
 *
 * Use this method to send phone contacts. On success, the sent Message is returned.
 *
 * @link https://core.telegram.org/bots/api#sendcontact
 */
class SendContactRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string  $phone_number  Contact's phone number
     * @param  string  $first_name  Contact's first name
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $phone_number,
        protected string $first_name,
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
     * Contact's last name.
     */
    public function lastName(string $last_name): self
    {
        $this->params['last_name'] = $last_name;

        return $this;
    }

    /**
     * Additional data about the contact in the form of a vCard, 0-2048 bytes.
     */
    public function vcard(string $vcard): self
    {
        $this->params['vcard'] = $vcard;

        return $this;
    }

    /**
     * Sends the message silently. Users will receive a notification with no sound.
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
        return 'sendContact';
    }

    public function validate(): void
    {
        if (mb_strlen($this->first_name) === 0) {
            throw new TelegramValidationException('First name cannot be empty');
        }

        if (mb_strlen($this->phone_number) === 0) {
            throw new TelegramValidationException('Phone number cannot be empty');
        }

        if (isset($this->params['vcard']) && mb_strlen($this->params['vcard']) > 2048) {
            throw new TelegramValidationException('vCard must not exceed 2048 bytes');
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
            'phone_number' => $this->phone_number,
            'first_name' => $this->first_name,
        ] + $this->params;
    }
}
