<?php

namespace Telegram\Bot\Objects;

/**
 * Class Update. *
 *
 * @link https://core.telegram.org/bots/api#update
 */
class Update extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'message' => Message::class,
            'edited_message' => Message::class,
            'channel_post' => Message::class,
            'edited_channel_post' => Message::class,
            'business_connection' => BusinessConnection::class,
            'business_message' => Message::class,
            'edited_business_message' => Message::class,
            'deleted_business_messages' => BusinessMessagesDeleted::class,
            'message_reaction' => MessageReactionUpdated::class,
            'message_reaction_count' => MessageReactionCountUpdated::class,
            'inline_query' => InlineQuery::class,
            'chosen_inline_result' => ChosenInlineResult::class,
            'callback_query' => CallbackQuery::class,
            'shipping_query' => ShippingQuery::class,
            'pre_checkout_query' => PreCheckOutQuery::class,
            'purchased_paid_media' => PaidMediaPurchased::class,
            'poll' => Poll::class,
            'poll_answer' => PollAnswer::class,
            'my_chat_member' => ChatMemberUpdated::class,
            'chat_member' => ChatMemberUpdated::class,
            'chat_join_request' => ChatJoinRequest::class,
            'chat_boost' => ChatBoostUpdated::class,
            'removed_chat_boost' => ChatBoostRemoved::class,
        ];
    }

    /**
     * Determine if the update is of given type
     *
     */
    public function isType(string $type): bool
    {
        if ($this->has(strtolower($type))) {
            return true;
        }

        return $this->detectType() === $type;
    }

    /**
     * Detect type based on properties.
     */
    public function detectType(): ?string
    {
        $types = [
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post',
            'business_connection',
            'business_message',
            'edited_business_message',
            'deleted_business_messages',
            'message_reaction',
            'message_reaction_count',
            'inline_query',
            'chosen_inline_result',
            'callback_query',
            'shipping_query',
            'pre_checkout_query',
            'purchased_paid_media',
            'poll',
            'poll_answer',
            'my_chat_member',
            'chat_member',
            'chat_join_request',
            'chat_boost',
            'removed_chat_boost',
        ];

        return $this->keys()
            ->intersect($types)
            ->pop();
    }

    /**
     * Return the related message.
     *
     * @deprecated
     */
    public function getPrivateMessage(): ?Message
    {
        return $this->getRelatedMessage();
    }

    /**
     * Return the related message.
     */
    public function getRelatedMessage(): ?Message
    {
        if ($this->has('message')) {
            return $this->getMessage();
        } elseif ($this->has('edited_message')) {
            return $this->getEditedMessage();
        } elseif ($this->has('callback_query')) {
            return $this->getCallbackQuery()->getMessage();
        } elseif ($this->has('channel_post')) {
            return $this->getChannelPost();
        } elseif ($this->has('edited_channel_post')) {
            return $this->getEditedChannelPost();
        }

        return null;
    }

    /**
     * Return the related chat if any.
     */
    public function getChat(): ?Chat
    {
        if ($message = $this->getRelatedMessage()) {
            return $message->getChat();
        }

        return null;
    }

    /**
     * Return the related user that created the update.
     */
    public function getFrom(): ?User
    {
        if ($this->has('message')) {
            return $this->getMessage()->getFrom();
        } elseif ($this->has('edited_message')) {
            return $this->getEditedMessage()->getFrom();
        } elseif ($this->has('inline_query')) {
            return $this->getInlineQuery()->getFrom();
        } elseif ($this->has('chosen_inline_result')) {
            return $this->getChosenInlineResult()->getFrom();
        } elseif ($this->has('callback_query')) {
            return $this->getCallbackQuery()->getFrom();
        } elseif ($this->has('channel_post')) {
            return $this->getChannelPost()->getFrom();
        } elseif ($this->has('edited_channel_post')) {
            return $this->getEditedChannelPost()->getFrom();
        } elseif ($this->has('shipping_query')) {
            return $this->getShippingQuery()->getFrom();
        }

        return null;
    }

    /**
     * The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially.
     */
    public function getUpdateId(): int
    {
        return $this->items['update_id'];
    }

    /**
     * (Optional). New incoming message of any kind - text, photo, sticker, etc.
     */
    public function getMessage(): ?Message
    {
        return $this->items['message'] ?? null;
    }

    /**
     * (Optional). New version of a message that is known to the bot and was edited.
     */
    public function getEditedMessage(): ?Message
    {
        return $this->items['edited_message'] ?? null;
    }

    /**
     * (Optional). New incoming channel post of any kind — text, photo, sticker, etc.
     */
    public function getChannelPost(): ?Message
    {
        return $this->items['channel_post'] ?? null;
    }

    /**
     * (Optional). New version of a channel post that is known to the bot and was edited.
     */
    public function getEditedChannelPost(): ?Message
    {
        return $this->items['edited_channel_post'] ?? null;
    }

    /**
     * (Optional). The bot was connected to or disconnected from a business account (BusinessConnection).
     */
    public function getBusinessConnection(): ?BusinessConnection
    {
        return $this->items['business_connection'] ?? null;
    }

    /**
     * (Optional). New message from a connected business account.
     */
    public function getBusinessMessage(): ?Message
    {
        return $this->items['business_message'] ?? null;
    }

    /**
     * (Optional). New version of a message from a connected business account.
     */
    public function getEditedBusinessMessage(): ?Message
    {
        return $this->items['edited_business_message'] ?? null;
    }

    /**
     * (Optional). Messages were deleted from a connected business account (BusinessMessagesDeleted).
     */
    public function getDeletedBusinessMessages(): ?BusinessMessagesDeleted
    {
        return $this->items['deleted_business_messages'] ?? null;
    }

    /**
     * (Optional). A reaction to a message was changed by a user (MessageReactionUpdated).
     */
    public function getMessageReaction(): ?MessageReactionUpdated
    {
        return $this->items['message_reaction'] ?? null;
    }

    /**
     * (Optional). Reactions to a message with anonymous reactions were changed (MessageReactionCountUpdated).
     */
    public function getMessageReactionCount(): ?MessageReactionCountUpdated
    {
        return $this->items['message_reaction_count'] ?? null;
    }

    /**
     * (Optional). New incoming inline query.
     */
    public function getInlineQuery(): ?InlineQuery
    {
        return $this->items['inline_query'] ?? null;
    }

    /**
     * (Optional). A result of an inline query that was chosen by the user and sent to their chat partner.
     */
    public function getChosenInlineResult(): ?ChosenInlineResult
    {
        return $this->items['chosen_inline_result'] ?? null;
    }

    /**
     * (Optional). Incoming callback query.
     */
    public function getCallbackQuery(): ?CallbackQuery
    {
        return $this->items['callback_query'] ?? null;
    }

    /**
     * (Optional). New incoming shipping query. Only for invoices with flexible price.
     */
    public function getShippingQuery(): ?ShippingQuery
    {
        return $this->items['shipping_query'] ?? null;
    }

    /**
     * (Optional). New incoming pre-checkout query. Contains full information about checkout.
     */
    public function getPreCheckOutQuery(): ?PreCheckOutQuery
    {
        return $this->items['pre_check_out_query'] ?? null;
    }

    /**
     * (Optional). A user purchased paid media (PaidMediaPurchased).
     */
    public function getPurchasedPaidMedia(): ?PaidMediaPurchased
    {
        return $this->items['purchased_paid_media'] ?? null;
    }

    /**
     * (Optional). New poll state. Bots receive only updates about polls, which are sent or stopped by the bot.
     */
    public function getPoll(): ?Poll
    {
        return $this->items['poll'] ?? null;
    }

    /**
     * (Optional). A user changed their answer in a non-anonymous poll (PollAnswer).
     */
    public function getPollAnswer(): ?PollAnswer
    {
        return $this->items['poll_answer'] ?? null;
    }

    /**
     * (Optional). The bot's chat member status was updated in a chat (ChatMemberUpdated).
     */
    public function getMyChatMember(): ?ChatMemberUpdated
    {
        return $this->items['my_chat_member'] ?? null;
    }

    /**
     * (Optional). A chat member's status was updated in a chat (ChatMemberUpdated).
     */
    public function getChatMember(): ?ChatMemberUpdated
    {
        return $this->items['chat_member'] ?? null;
    }

    /**
     * (Optional). A request to join the chat has been sent (ChatJoinRequest).
     */
    public function getChatJoinRequest(): ?ChatJoinRequest
    {
        return $this->items['chat_join_request'] ?? null;
    }

    /**
     * (Optional). A chat boost was added or changed (ChatBoostUpdated).
     */
    public function getChatBoost(): ?ChatBoostUpdated
    {
        return $this->items['chat_boost'] ?? null;
    }

    /**
     * (Optional). A boost was removed from a chat (ChatBoostRemoved).
     */
    public function getRemovedChatBoost(): ?ChatBoostRemoved
    {
        return $this->items['removed_chat_boost'] ?? null;
    }
}
