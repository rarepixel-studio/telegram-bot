<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Copy messages of any kind.
 *
 * @link https://core.telegram.org/bots/api#copymessages
 */
class CopyMessagesRequest extends TelegramApiRequest
{
    /**
     * @var string|int Unique identifier for the target chat or username of the target channel (in the format @channelusername).
     */
    protected string|int $chatId;

    /**
     * @var string|int Unique identifier for the chat where the original messages were sent (or channel username in the format @channelusername).
     */
    protected string|int $fromChatId;

    /**
     * @var int[] Identifiers of 1-100 messages in the chat from_chat_id to copy. The identifiers must be specified in a strictly increasing order.
     */
    protected array $messageIds;

    /**
     * @var int|null Unique identifier for the target message thread (topic) of the forum; for forum supergroups only.
     */
    protected ?int $messageThreadId = null;

    /**
     * @var bool|null Sends the messages silently. Users will receive a notification with no sound.
     */
    protected ?bool $disableNotification = null;

    /**
     * @var bool|null Protects the contents of the sent messages from forwarding and saving.
     */
    protected ?bool $protectContent = null;

    /**
     * @var bool|null Pass True to copy the messages without their captions.
     */
    protected ?bool $removeCaption = null;

    /**
     * @param  string|int  $chatId  Unique identifier for the target chat or username of the target channel.
     * @param  string|int  $fromChatId  Unique identifier for the chat where the original messages were sent.
     * @param  int[]  $messageIds  Identifiers of 1-100 messages in the chat from_chat_id to copy.
     */
    public function __construct(string|int $chatId, string|int $fromChatId, array $messageIds)
    {
        $this->chatId = $chatId;
        $this->fromChatId = $fromChatId;
        $this->messageIds = $messageIds;
    }

    /**
     * Unique identifier for the target message thread (topic) of the forum; for forum supergroups only.
     */
    public function messageThreadId(int $messageThreadId): self
    {
        $this->messageThreadId = $messageThreadId;

        return $this;
    }

    /**
     * Sends the messages silently. Users will receive a notification with no sound.
     */
    public function disableNotification(bool $disableNotification): self
    {
        $this->disableNotification = $disableNotification;

        return $this;
    }

    /**
     * Protects the contents of the sent messages from forwarding and saving.
     */
    public function protectContent(bool $protectContent): self
    {
        $this->protectContent = $protectContent;

        return $this;
    }

    /**
     * Pass True to copy the messages without their captions.
     */
    public function removeCaption(bool $removeCaption): self
    {
        $this->removeCaption = $removeCaption;

        return $this;
    }

    /**
     * Gateway Method used for validation.
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        if ($this->chatId === '' || $this->chatId === 0) {
            throw new TelegramValidationException('Chat ID cannot be empty');
        }

        if ($this->fromChatId === '' || $this->fromChatId === 0) {
            throw new TelegramValidationException('From Chat ID cannot be empty');
        }

        if (empty($this->messageIds)) {
            throw new TelegramValidationException('Message IDs cannot be empty');
        }

        if (count($this->messageIds) > 100) {
            throw new TelegramValidationException('Message IDs cannot exceed 100 identifiers');
        }
    }

    /**
     * @return string Method name.
     */
    public function getMethod(): string
    {
        return 'copyMessages';
    }

    /**
     * @return array Params for the request.
     */
    protected function buildParams(): array
    {
        return [
            'chat_id' => $this->chatId,
            'from_chat_id' => $this->fromChatId,
            'message_ids' => $this->messageIds,
            'message_thread_id' => $this->messageThreadId,
            'disable_notification' => $this->disableNotification,
            'protect_content' => $this->protectContent,
            'remove_caption' => $this->removeCaption,
        ];
    }
}
