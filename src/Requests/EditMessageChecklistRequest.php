<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\InputChecklist;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;

/**
 * Request object for the editMessageChecklist method.
 *
 * Use this method to edit a checklist on behalf of a connected business account.
 * On success, the edited Message is returned.
 *
 * @link https://core.telegram.org/bots/api#editmessagechecklist
 */
class EditMessageChecklistRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'checklist',
        'reply_markup',
    ];

    /** @var string Unique identifier of the business connection */
    protected string $businessConnectionId;

    /** @var int Unique identifier for the target chat */
    protected int $chatId;

    /** @var int Unique identifier for the target message */
    protected int $messageId;

    /** @var InputChecklist|array A JSON-serialized object for the new checklist */
    protected InputChecklist|array $checklist;

    /** @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array|null Additional interface options */
    protected InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array|null $replyMarkup = null;

    /**
     * EditMessageChecklistRequest constructor.
     */
    public function __construct(string $businessConnectionId, int $chatId, int $messageId, InputChecklist|array $checklist)
    {
        $this->businessConnectionId = $businessConnectionId;
        $this->chatId = $chatId;
        $this->messageId = $messageId;
        $this->checklist = $checklist;
    }

    /**
     * Set reply markup.
     *
     * @return $this
     */
    public function setReplyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $replyMarkup): self
    {
        $this->replyMarkup = $replyMarkup;

        return $this;
    }

    /**
     * Get the method name.
     */
    public function getMethod(): string
    {
        return 'editMessageChecklist';
    }

    /**
     * Validate the request.
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        $this->validateChecklistProperty();
        $this->validateReplyMarkupProperty($this->replyMarkup);
    }

    /**
     * Validate checklist property.
     *
     * @throws TelegramValidationException
     */
    private function validateChecklistProperty(): void
    {
        if ($this->checklist instanceof InputChecklist) {
            // Assume InputChecklist has a validate method, if not, strict type check handles it
            if (method_exists($this->checklist, 'validate')) {
                $this->checklist->validate();
            }

            return;
        }

        if (is_array($this->checklist)) {
            $object = new InputChecklist($this->checklist);
            // $object->validate(); // If InputChecklist has validate
            $this->checklist = $object;
        }
    }

    /**
     * Get the request parameters.
     */
    protected function buildParams(): array
    {
        return [
            'business_connection_id' => $this->businessConnectionId,
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
            'checklist' => $this->checklist,
            'reply_markup' => $this->replyMarkup,
        ];
    }
}
