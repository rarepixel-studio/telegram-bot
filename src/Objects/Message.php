<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class Message. *
 *
 * @property-read string|null $forward_signature       Deprecated, use forward_origin
 * @property-read string|null $forward_sender_name     Deprecated, use forward_origin
 * @property-read int|null    $forward_date            Deprecated, use forward_origin
 * @property-read User|null   $forward_from            Deprecated, use forward_origin
 * @property-read Chat|null   $forward_from_chat       Deprecated, use forward_origin
 * @property-read int|null    $forward_from_message_id Deprecated, use forward_origin
 */
class Message extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'from' => User::class,
            'sender_chat' => Chat::class,
            'sender_business_bot' => User::class,
            'chat' => Chat::class,
            'direct_messages_topic' => DirectMessagesTopic::class,
            'via_bot' => User::class,
            'forward_origin' => MessageOrigin::class,
            'forward_from' => User::class,  // Deprecated, kept for backward compatibility
            'forward_from_chat' => Chat::class,  // Deprecated, kept for backward compatibility
            'reply_to_message' => self::class,
            'external_reply' => ExternalReplyInfo::class,
            'quote' => TextQuote::class,
            'reply_to_story' => Story::class,
            'guest_bot_caller_user' => User::class,
            'guest_bot_caller_chat' => Chat::class,
            'entities' => MessageEntity::class,
            'link_preview_options' => LinkPreviewOptions::class,
            'suggested_post_info' => SuggestedPostInfo::class,
            'rich_message' => RichMessage::class,
            'caption_entities' => MessageEntity::class,
            'animation' => Animation::class,
            'audio' => Audio::class,
            'document' => Document::class,
            'live_photo' => LivePhoto::class,
            'paid_media' => PaidMediaInfo::class,
            'photo' => PhotoSize::class,
            'sticker' => Sticker::class,
            'story' => Story::class,
            'video' => Video::class,
            'voice' => Voice::class,
            'video_note' => VideoNote::class,
            'checklist' => Checklist::class,
            'contact' => Contact::class,
            'dice' => Dice::class,
            'game' => Game::class,
            'location' => Location::class,
            'venue' => Venue::class,
            'poll' => Poll::class,
            'new_chat_members' => User::class,
            'new_chat_member' => User::class,  // Deprecated, kept for backward compatibility
            'left_chat_member' => User::class,
            'new_chat_photo' => PhotoSize::class,
            'message_auto_delete_timer_changed' => MessageAutoDeleteTimerChanged::class,
            'pinned_message' => MaybeInaccessibleMessage::class,
            'invoice' => Invoice::class,
            'successful_payment' => SuccessfulPayment::class,
            'refunded_payment' => RefundedPayment::class,
            'users_shared' => UsersShared::class,
            'chat_shared' => ChatShared::class,
            'gift' => GiftInfo::class,
            'unique_gift' => UniqueGiftInfo::class,
            'write_access_allowed' => WriteAccessAllowed::class,
            'checklist_tasks_done' => ChecklistTasksDone::class,
            'checklist_tasks_added' => ChecklistTasksAdded::class,
            'passport_data' => PassportData::class,
            'proximity_alert_triggered' => ProximityAlertTriggered::class,
            'boost_added' => ChatBoostAdded::class,
            'chat_background_set' => ChatBackground::class,
            'direct_message_price_changed' => DirectMessagePriceChanged::class,
            'forum_topic_created' => ForumTopicCreated::class,
            'forum_topic_edited' => ForumTopicEdited::class,
            'forum_topic_closed' => ForumTopicClosed::class,
            'forum_topic_reopened' => ForumTopicReopened::class,
            'general_forum_topic_hidden' => GeneralForumTopicHidden::class,
            'general_forum_topic_unhidden' => GeneralForumTopicUnhidden::class,
            'giveaway_created' => GiveawayCreated::class,
            'giveaway' => Giveaway::class,
            'giveaway_winners' => GiveawayWinners::class,
            'giveaway_completed' => GiveawayCompleted::class,
            'paid_message_price_changed' => PaidMessagePriceChanged::class,
            'suggested_post_approved' => SuggestedPostApproved::class,
            'suggested_post_approval_failed' => SuggestedPostApprovalFailed::class,
            'suggested_post_declined' => SuggestedPostDeclined::class,
            'suggested_post_paid' => SuggestedPostPaid::class,
            'suggested_post_refunded' => SuggestedPostRefunded::class,
            'video_chat_scheduled' => VideoChatScheduled::class,
            'video_chat_started' => VideoChatStarted::class,
            'video_chat_ended' => VideoChatEnded::class,
            'video_chat_participants_invited' => VideoChatParticipantsInvited::class,
            'web_app_data' => WebAppData::class,
            'reply_markup' => InlineKeyboardMarkup::class,
            'chat_owner_left' => ChatOwnerLeft::class,
            'chat_owner_changed' => ChatOwnerChanged::class,
            'managed_bot_created' => ManagedBotCreated::class,
            'community_chat_added' => CommunityChatAdded::class,
            'community_chat_removed' => CommunityChatRemoved::class,
            'community_chat_joined' => CommunityChatJoined::class,
            'receiver_user' => User::class,
        ];
    }

    /**
     * (Optional). For text messages, the actual UTF-8 text of the message.
     */
    public function getText(): ?string
    {
        return $this->items['text'] ?? null;
    }

    /**
     * (Optional). Date the message was last edited in Unix time.
     */
    public function getEditDate(): ?int
    {
        return $this->items['edit_date'] ?? null;
    }

    /**
     * (Optional). Caption for the document, photo or video contact.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * Determine if the message is of given type.
     */
    public function isType(string $type): bool
    {
        if ($this->has(strtolower($type))) {
            return true;
        }

        return $this->detectType() === $type;
    }

    /**
     * Get the text of a given message entity.
     */
    public function getEntityText(MessageEntity $entity): string
    {
        $text = $this->getText();

        if ($text === null) {
            return '';
        }

        return $this->substr($text, $entity->getOffset(), $entity->getLength());
    }

    /**
     * Get the text of a given caption entity.
     */
    public function getCaptionEntityText(MessageEntity $entity): string
    {
        $caption = $this->getCaption();

        if ($caption === null) {
            return '';
        }

        return $this->substr($caption, $entity->getOffset(), $entity->getLength());
    }

    /**
     * Substring based on UTF-16 code units.
     */
    protected function substr(string $text, int $start, int $length): string
    {
        $array = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
        $result = '';
        $curOffset = 0;
        $curLen = 0;
        foreach ($array as $char) {
            $utf16 = mb_convert_encoding($char, 'UTF-16');
            if ($curOffset >= $start && $curLen < $length) {
                $result .= $char;
                $curLen += strlen($utf16) > 2 ? 2 : 1;
            }
            $curOffset += strlen($utf16) > 2 ? 2 : 1;
            if ($curLen >= $length) {
                break;
            }
        }

        return $result;
    }

    /**
     * Determine if the text message has any HTML entity.
     */
    public function hasHtmlEntity(): bool
    {
        foreach ($this->getEntities() ?: [] as $entity) {
            if ($entity->isHtmlEntity()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if the caption has any HTML entity.
     */
    public function hasHtmlCaption(): bool
    {
        foreach ($this->getCaptionEntities() ?: [] as $entity) {
            if ($entity->isHtmlEntity()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return the HTML code of the text.
     */
    public function getHtml(): string
    {
        return $this->getTextOrCaptionHtml($this->getText(), $this->getEntities(), 'getEntityText');
    }

    /**
     * Return the HTML code of the caption.
     */
    public function getCaptionHtml(): string
    {
        return $this->getTextOrCaptionHtml($this->getCaption(), $this->getCaptionEntities(), 'getCaptionEntityText');
    }

    /**
     * @param  Collection<int, MessageEntity>|null  $entities
     */
    protected function getTextOrCaptionHtml(?string $text, ?Collection $entities, string $getEntityText): string
    {
        if ($text === null) {
            return '';
        }

        $html = '';
        $lastOffset = 0;
        foreach ($entities ?: [] as $entity) {
            $html .= e($this->substr($text, $lastOffset, $entity->getOffset() - $lastOffset));
            $lastOffset = $entity->getOffset() + $entity->getLength();
            if ($entity->getType() === 'bold') {
                $html .= '<b>'.e($this->$getEntityText($entity)).'</b>';
            } elseif ($entity->getType() === 'italic') {
                $html .= '<i>'.e($this->$getEntityText($entity)).'</i>';
            } elseif ($entity->getType() === 'code') {
                $html .= '<code>'.e($this->$getEntityText($entity)).'</code>';
            } elseif ($entity->getType() === 'pre') {
                $html .= '<pre>'.e($this->$getEntityText($entity)).'</pre>';
            } elseif ($entity->getType() === 'text_link') {
                $url = $entity->getUrl();
                $html .= "<a href=\"$url\">".e($this->$getEntityText($entity)).'</a>';
            } elseif ($entity->getType() === 'text_mention') {
                $url = 'tg://user?id='.$entity->getUser()->getId();
                $html .= "<a href=\"$url\">".e($this->$getEntityText($entity)).'</a>';
            } else {
                $html .= e($this->$getEntityText($entity));
            }
        }

        $html .= e($this->substr($text, $lastOffset, mb_strlen($text)));

        return $html;
    }

    /**
     * Return the file id of the message (if any)
     */
    public function getFileId(): ?string
    {
        if ($this->getAudio()) {
            return $this->getAudio()->getFileId();
        } elseif ($this->getDocument()) {
            return $this->getDocument()->getFileId();
        } elseif ($this->getNewChatPhoto()) {
            return $this->getNewChatPhoto()->last()->getFileId();
        } elseif ($this->getPhoto()) {
            return $this->getPhoto()->last()->getFileId();
        } elseif ($this->getSticker()) {
            return $this->getSticker()->getFileId();
        } elseif ($this->getVideo()) {
            return $this->getVideo()->getFileId();
        } elseif ($this->getVoice()) {
            return $this->getVoice()->getFileId();
        } elseif ($this->getVideoNote()) {
            return $this->getVideoNote()->getFileId();
        }

        return null;
    }

    /**
     * Detect type based on properties.
     */
    public function detectType(): ?string
    {
        $types = [
            'text',
            'audio',
            'document',
            // 'animation', disable animation type here for backward compatibility.
            'paid_media',
            'rich_message',
            'photo',
            'sticker',
            'story',
            'video',
            'voice',
            'video_note',
            'checklist',
            'contact',
            'dice',
            'game',
            'poll',
            'location',
            'venue',
            'new_chat_members',
            'new_chat_member',
            'left_chat_member',
            'new_chat_title',
            'new_chat_photo',
            'delete_chat_photo',
            'chat_owner_left',
            'chat_owner_changed',
            'group_chat_created',
            'supergroup_chat_created',
            'channel_chat_created',
            'message_auto_delete_timer_changed',
            'migrate_to_chat_id',
            'migrate_from_chat_id',
            'pinned_message',
            'invoice',
            'successful_payment',
            'refunded_payment',
            'users_shared',
            'chat_shared',
            'gift',
            'unique_gift',
            'write_access_allowed',
            'passport_data',
            'proximity_alert_triggered',
            'boost_added',
            'chat_background_set',
            'checklist_tasks_done',
            'checklist_tasks_added',
            'direct_message_price_changed',
            'forum_topic_created',
            'forum_topic_edited',
            'forum_topic_closed',
            'forum_topic_reopened',
            'general_forum_topic_hidden',
            'general_forum_topic_unhidden',
            'giveaway_created',
            'giveaway',
            'giveaway_winners',
            'giveaway_completed',
            'paid_message_price_changed',
            'suggested_post_approved',
            'suggested_post_approval_failed',
            'suggested_post_declined',
            'suggested_post_paid',
            'suggested_post_refunded',
            'video_chat_scheduled',
            'video_chat_started',
            'video_chat_ended',
            'video_chat_participants_invited',
            'web_app_data',
            'managed_bot_created',
            'community_chat_added',
            'community_chat_removed',
            'community_chat_joined',
        ];

        return $this->keys()
            ->intersect($types)
            ->pop();
    }

    /**
     * Unique message identifier.
     */
    public function getMessageId(): int
    {
        return $this->items['message_id'];
    }

    /**
     * (Optional). Unique identifier of a message thread to which the message belongs; for supergroups only.
     */
    public function getMessageThreadId(): ?int
    {
        return $this->items['message_thread_id'] ?? null;
    }

    /**
     * (Optional). Information about the direct messages chat topic that contains the message.
     */
    public function getDirectMessagesTopic(): ?DirectMessagesTopic
    {
        return $this->items['direct_messages_topic'] ?? null;
    }

    /**
     * (Optional). Sender, can be empty for messages sent to channels.
     */
    public function getFrom(): ?User
    {
        return $this->items['from'] ?? null;
    }

    /**
     * (Optional). Sender of the message when sent on behalf of a chat.
     */
    public function getSenderChat(): ?Chat
    {
        return $this->items['sender_chat'] ?? null;
    }

    /**
     * (Optional). Receiver of the ephemeral message.
     */
    public function getReceiverUser(): ?User
    {
        return $this->items['receiver_user'] ?? null;
    }

    /**
     * (Optional). Unique identifier of the ephemeral message.
     */
    public function getEphemeralMessageId(): ?string
    {
        return $this->items['ephemeral_message_id'] ?? null;
    }

    /**
     * (Optional). If the sender of the message boosted the chat, the number of boosts added by the user.
     */
    public function getSenderBoostCount(): ?int
    {
        return $this->items['sender_boost_count'] ?? null;
    }

    /**
     * (Optional). The bot that actually sent the message on behalf of the business account.
     */
    public function getSenderBusinessBot(): ?User
    {
        return $this->items['sender_business_bot'] ?? null;
    }

    /**
     * Date the message was sent in Unix time.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }

    /**
     * (Optional). The unique identifier for the guest query.
     */
    public function getGuestQueryId(): ?string
    {
        return $this->items['guest_query_id'] ?? null;
    }

    /**
     * (Optional). For a message sent by a guest bot, this is the user whose original message triggered the bot's response.
     */
    public function getGuestBotCallerUser(): ?User
    {
        return $this->items['guest_bot_caller_user'] ?? null;
    }

    /**
     * (Optional). For a message sent by a guest bot, this is the chat whose original message triggered the bot's response.
     */
    public function getGuestBotCallerChat(): ?Chat
    {
        return $this->items['guest_bot_caller_chat'] ?? null;
    }

    /**
     * (Optional). Unique identifier of the business connection from which the message was received.
     */
    public function getBusinessConnectionId(): ?string
    {
        return $this->items['business_connection_id'] ?? null;
    }

    /**
     * Conversation the message belongs to.
     */
    public function getChat(): Chat
    {
        return $this->items['chat'];
    }

    /**
     * (Optional). Information about the original message for forwarded messages (MessageOrigin).
     */
    public function getForwardOrigin(): ?MessageOrigin
    {
        return $this->items['forward_origin'] ?? null;
    }

    /**
     * (Optional). True, if the message is sent to a forum topic.
     */
    public function getIsTopicMessage(): ?bool
    {
        return $this->items['is_topic_message'] ?? null;
    }

    /**
     * (Optional). True, if the message is a channel post that was automatically forwarded to the connected discussion group.
     */
    public function getIsAutomaticForward(): ?bool
    {
        return $this->items['is_automatic_forward'] ?? null;
    }

    /**
     * (Optional). For replies in the same chat and message thread, the original message.
     */
    public function getReplyToMessage(): ?Message
    {
        return $this->items['reply_to_message'] ?? null;
    }

    /**
     * (Optional). Information about the message that is being replied to, which may come from another chat or forum topic (ExternalReplyInfo).
     */
    public function getExternalReply(): ?ExternalReplyInfo
    {
        return $this->items['external_reply'] ?? null;
    }

    /**
     * (Optional). For replies that quote part of the original message, the quoted part (TextQuote).
     */
    public function getQuote(): ?TextQuote
    {
        return $this->items['quote'] ?? null;
    }

    /**
     * (Optional). For replies to a story, the original story (Story).
     */
    public function getReplyToStory(): ?Story
    {
        return $this->items['reply_to_story'] ?? null;
    }

    /**
     * (Optional). Identifier of the specific checklist task that is being replied to.
     */
    public function getReplyToChecklistTaskId(): ?int
    {
        return $this->items['reply_to_checklist_task_id'] ?? null;
    }

    /**
     * (Optional). Bot through which the message was sent.
     */
    public function getViaBot(): ?User
    {
        return $this->items['via_bot'] ?? null;
    }

    /**
     * (Optional). True, if the message can't be forwarded.
     */
    public function getHasProtectedContent(): ?bool
    {
        return $this->items['has_protected_content'] ?? null;
    }

    /**
     * (Optional). True, if the message was sent by an implicit action.
     */
    public function getIsFromOffline(): ?bool
    {
        return $this->items['is_from_offline'] ?? null;
    }

    /**
     * (Optional). True, if the message is a paid post.
     */
    public function getIsPaidPost(): ?bool
    {
        return $this->items['is_paid_post'] ?? null;
    }

    /**
     * (Optional). The unique identifier of a media message group this message belongs to.
     */
    public function getMediaGroupId(): ?string
    {
        return $this->items['media_group_id'] ?? null;
    }

    /**
     * (Optional). Signature of the post author for messages in channels.
     */
    public function getAuthorSignature(): ?string
    {
        return $this->items['author_signature'] ?? null;
    }

    /**
     * (Optional). The number of Telegram Stars that were paid by the sender of the message to send it.
     */
    public function getPaidStarCount(): ?int
    {
        return $this->items['paid_star_count'] ?? null;
    }

    /**
     * (Optional). The tag of the sender in the chat.
     */
    public function getSenderTag(): ?string
    {
        return $this->items['sender_tag'] ?? null;
    }

    /**
     * @return Collection<int, MessageEntity>|null
     */
    public function getEntities(): ?Collection
    {
        return $this->items['entities'] ?? null;
    }

    /**
     * (Optional). Options used for link preview generation for the message.
     */
    public function getLinkPreviewOptions(): ?LinkPreviewOptions
    {
        return $this->items['link_preview_options'] ?? null;
    }

    /**
     * (Optional). Information about suggested post parameters (SuggestedPostInfo).
     */
    public function getSuggestedPostInfo(): ?SuggestedPostInfo
    {
        return $this->items['suggested_post_info'] ?? null;
    }

    /**
     * (Optional). Message is a rich formatted message.
     */
    public function getRichMessage(): ?RichMessage
    {
        return $this->items['rich_message'] ?? null;
    }

    /**
     * (Optional). Unique identifier of the message effect added to the message.
     */
    public function getEffectId(): ?string
    {
        return $this->items['effect_id'] ?? null;
    }

    /**
     * (Optional). Message is an animation, information about the animation.
     */
    public function getAnimation(): ?Animation
    {
        return $this->items['animation'] ?? null;
    }

    /**
     * (Optional). Message is an audio file, information about the file.
     */
    public function getAudio(): ?Audio
    {
        return $this->items['audio'] ?? null;
    }

    /**
     * (Optional). Message is a general file, information about the file.
     */
    public function getDocument(): ?Document
    {
        return $this->items['document'] ?? null;
    }

    /**
     * (Optional). Message is a live photo, information about the live photo.
     */
    public function getLivePhoto(): ?LivePhoto
    {
        return $this->items['live_photo'] ?? null;
    }

    /**
     * (Optional). Message contains paid media; information about the paid media (PaidMediaInfo).
     */
    public function getPaidMedia(): ?PaidMediaInfo
    {
        return $this->items['paid_media'] ?? null;
    }

    /**
     * @return Collection<int, PhotoSize>|null
     */
    public function getPhoto(): ?Collection
    {
        return $this->items['photo'] ?? null;
    }

    /**
     * (Optional). Message is a sticker, information about the sticker.
     */
    public function getSticker(): ?Sticker
    {
        return $this->items['sticker'] ?? null;
    }

    /**
     * (Optional). Message is a forwarded story (Story).
     */
    public function getStory(): ?Story
    {
        return $this->items['story'] ?? null;
    }

    /**
     * (Optional). Message is a video, information about the video.
     */
    public function getVideo(): ?Video
    {
        return $this->items['video'] ?? null;
    }

    /**
     * (Optional). Message is a video note, information about the video message.
     */
    public function getVideoNote(): ?VideoNote
    {
        return $this->items['video_note'] ?? null;
    }

    /**
     * (Optional). Message is a voice message, information about the file.
     */
    public function getVoice(): ?Voice
    {
        return $this->items['voice'] ?? null;
    }

    /**
     * @return Collection<int, MessageEntity>|null
     */
    public function getCaptionEntities(): ?Collection
    {
        return $this->items['caption_entities'] ?? null;
    }

    /**
     * (Optional). True, if the caption must be shown above the message media.
     */
    public function getShowCaptionAboveMedia(): ?bool
    {
        return $this->items['show_caption_above_media'] ?? null;
    }

    /**
     * (Optional). True, if the message media is covered by a spoiler animation.
     */
    public function getHasMediaSpoiler(): ?bool
    {
        return $this->items['has_media_spoiler'] ?? null;
    }

    /**
     * (Optional). Message is a checklist (Checklist).
     */
    public function getChecklist(): ?Checklist
    {
        return $this->items['checklist'] ?? null;
    }

    /**
     * (Optional). Message is a shared contact, information about the contact.
     */
    public function getContact(): ?Contact
    {
        return $this->items['contact'] ?? null;
    }

    /**
     * (Optional). Message is a dice with random value (Dice).
     */
    public function getDice(): ?Dice
    {
        return $this->items['dice'] ?? null;
    }

    /**
     * (Optional). Message is a game, information about the game.
     */
    public function getGame(): ?Game
    {
        return $this->items['game'] ?? null;
    }

    /**
     * (Optional). Message is a native poll, information about the poll.
     */
    public function getPoll(): ?Poll
    {
        return $this->items['poll'] ?? null;
    }

    /**
     * (Optional). Message is a venue, information about the venue.
     */
    public function getVenue(): ?Venue
    {
        return $this->items['venue'] ?? null;
    }

    /**
     * (Optional). Message is a shared location, information about the location.
     */
    public function getLocation(): ?Location
    {
        return $this->items['location'] ?? null;
    }

    /**
     * @return Collection<int, User>|null
     */
    public function getNewChatMembers(): ?Collection
    {
        return $this->items['new_chat_members'] ?? null;
    }

    /**
     * (Optional). A member was removed from the group.
     */
    public function getLeftChatMember(): ?User
    {
        return $this->items['left_chat_member'] ?? null;
    }

    /**
     * (Optional). Information about the created managed bot.
     */
    public function getManagedBotCreated(): ?ManagedBotCreated
    {
        return $this->items['managed_bot_created'] ?? null;
    }

    /**
     * (Optional). Service message: chat added to a community.
     */
    public function getCommunityChatAdded(): ?CommunityChatAdded
    {
        return $this->items['community_chat_added'] ?? null;
    }

    /**
     * (Optional). Service message: chat removed from a community.
     */
    public function getCommunityChatRemoved(): ?CommunityChatRemoved
    {
        return $this->items['community_chat_removed'] ?? null;
    }

    /**
     * (Optional). Service message: chat was joined by a user from a community.
     */
    public function getCommunityChatJoined(): ?CommunityChatJoined
    {
        return $this->items['community_chat_joined'] ?? null;
    }

    /**
     * (Optional). A chat title was changed to this value.
     */
    public function getNewChatTitle(): ?string
    {
        return $this->items['new_chat_title'] ?? null;
    }

    /**
     * @return Collection<int, PhotoSize>|null
     */
    public function getNewChatPhoto(): ?Collection
    {
        return $this->items['new_chat_photo'] ?? null;
    }

    /**
     * (Optional). Service message: the chat photo was deleted.
     */
    public function getDeleteChatPhoto(): ?bool
    {
        return $this->items['delete_chat_photo'] ?? null;
    }

    /**
     * (Optional). Service message: the owner of the chat has left.
     */
    public function getChatOwnerLeft(): ?ChatOwnerLeft
    {
        return $this->items['chat_owner_left'] ?? null;
    }

    /**
     * (Optional). Service message: the owner of the chat has changed.
     */
    public function getChatOwnerChanged(): ?ChatOwnerChanged
    {
        return $this->items['chat_owner_changed'] ?? null;
    }

    /**
     * (Optional). Service message: the group has been created.
     */
    public function getGroupChatCreated(): ?bool
    {
        return $this->items['group_chat_created'] ?? null;
    }

    /**
     * (Optional). Service message: the super group has been created.
     */
    public function getSupergroupChatCreated(): ?bool
    {
        return $this->items['supergroup_chat_created'] ?? null;
    }

    /**
     * (Optional). Service message: the channel has been created.
     */
    public function getChannelChatCreated(): ?bool
    {
        return $this->items['channel_chat_created'] ?? null;
    }

    /**
     * (Optional). Service message: auto-delete timer settings changed.
     */
    public function getMessageAutoDeleteTimerChanged(): ?MessageAutoDeleteTimerChanged
    {
        return $this->items['message_auto_delete_timer_changed'] ?? null;
    }

    /**
     * (Optional). The group has been migrated to a supergroup with the specified identifier.
     */
    public function getMigrateToChatId(): ?int
    {
        return $this->items['migrate_to_chat_id'] ?? null;
    }

    /**
     * (Optional). The supergroup has been migrated from a group with the specified identifier.
     */
    public function getMigrateFromChatId(): ?int
    {
        return $this->items['migrate_from_chat_id'] ?? null;
    }

    /**
     * (Optional). Specified message was pinned.
     */
    public function getPinnedMessage(): ?MaybeInaccessibleMessage
    {
        return $this->items['pinned_message'] ?? null;
    }

    /**
     * (Optional). Message is an invoice for a payment.
     */
    public function getInvoice(): ?Invoice
    {
        return $this->items['invoice'] ?? null;
    }

    /**
     * (Optional). Message is a service message about a successful payment.
     */
    public function getSuccessfulPayment(): ?SuccessfulPayment
    {
        return $this->items['successful_payment'] ?? null;
    }

    /**
     * (Optional). Message is a service message about a refunded payment (RefundedPayment).
     */
    public function getRefundedPayment(): ?RefundedPayment
    {
        return $this->items['refunded_payment'] ?? null;
    }

    /**
     * (Optional). Service message: users were shared with the bot (UsersShared).
     */
    public function getUsersShared(): ?UsersShared
    {
        return $this->items['users_shared'] ?? null;
    }

    /**
     * (Optional). Service message: a chat was shared with the bot (ChatShared).
     */
    public function getChatShared(): ?ChatShared
    {
        return $this->items['chat_shared'] ?? null;
    }

    /**
     * (Optional). Service message: a regular gift was sent or received (GiftInfo).
     */
    public function getGift(): ?GiftInfo
    {
        return $this->items['gift'] ?? null;
    }

    /**
     * (Optional). Service message: a unique gift was sent or received (UniqueGiftInfo).
     */
    public function getUniqueGift(): ?UniqueGiftInfo
    {
        return $this->items['unique_gift'] ?? null;
    }

    /**
     * (Optional). The domain name of the website on which the user has logged in.
     */
    public function getConnectedWebsite(): ?string
    {
        return $this->items['connected_website'] ?? null;
    }

    /**
     * (Optional). Service message: the user allowed the bot to write messages (WriteAccessAllowed).
     */
    public function getWriteAccessAllowed(): ?WriteAccessAllowed
    {
        return $this->items['write_access_allowed'] ?? null;
    }

    /**
     * (Optional). Telegram Passport data (PassportData).
     */
    public function getPassportData(): ?PassportData
    {
        return $this->items['passport_data'] ?? null;
    }

    /**
     * (Optional). Service message about proximity alert triggered (ProximityAlertTriggered).
     */
    public function getProximityAlertTriggered(): ?ProximityAlertTriggered
    {
        return $this->items['proximity_alert_triggered'] ?? null;
    }

    /**
     * (Optional). Service message: user boosted the chat (ChatBoostAdded).
     */
    public function getBoostAdded(): ?ChatBoostAdded
    {
        return $this->items['boost_added'] ?? null;
    }

    /**
     * (Optional). Service message: chat background set (ChatBackground).
     */
    public function getChatBackgroundSet(): ?ChatBackground
    {
        return $this->items['chat_background_set'] ?? null;
    }

    /**
     * (Optional). Service message: some tasks in a checklist were marked as done or not done (ChecklistTasksDone).
     */
    public function getChecklistTasksDone(): ?ChecklistTasksDone
    {
        return $this->items['checklist_tasks_done'] ?? null;
    }

    /**
     * (Optional). Service message: tasks were added to a checklist (ChecklistTasksAdded).
     */
    public function getChecklistTasksAdded(): ?ChecklistTasksAdded
    {
        return $this->items['checklist_tasks_added'] ?? null;
    }

    /**
     * (Optional). Service message: the price for paid messages in channel direct messages chat changed.
     */
    public function getDirectMessagePriceChanged(): ?DirectMessagePriceChanged
    {
        return $this->items['direct_message_price_changed'] ?? null;
    }

    /**
     * (Optional). Service message: forum topic created (ForumTopicCreated).
     */
    public function getForumTopicCreated(): ?ForumTopicCreated
    {
        return $this->items['forum_topic_created'] ?? null;
    }

    /**
     * (Optional). Service message: forum topic edited (ForumTopicEdited).
     */
    public function getForumTopicEdited(): ?ForumTopicEdited
    {
        return $this->items['forum_topic_edited'] ?? null;
    }

    /**
     * (Optional). Service message: forum topic closed (ForumTopicClosed).
     */
    public function getForumTopicClosed(): ?ForumTopicClosed
    {
        return $this->items['forum_topic_closed'] ?? null;
    }

    /**
     * (Optional). Service message: forum topic reopened (ForumTopicReopened).
     */
    public function getForumTopicReopened(): ?ForumTopicReopened
    {
        return $this->items['forum_topic_reopened'] ?? null;
    }

    /**
     * (Optional). Service message: the 'General' forum topic hidden (GeneralForumTopicHidden).
     */
    public function getGeneralForumTopicHidden(): ?GeneralForumTopicHidden
    {
        return $this->items['general_forum_topic_hidden'] ?? null;
    }

    /**
     * (Optional). Service message: the 'General' forum topic unhidden (GeneralForumTopicUnhidden).
     */
    public function getGeneralForumTopicUnhidden(): ?GeneralForumTopicUnhidden
    {
        return $this->items['general_forum_topic_unhidden'] ?? null;
    }

    /**
     * (Optional). Service message: a scheduled giveaway was created.
     */
    public function getGiveawayCreated(): ?GiveawayCreated
    {
        return $this->items['giveaway_created'] ?? null;
    }

    /**
     * (Optional). Message is a scheduled giveaway.
     */
    public function getGiveaway(): ?Giveaway
    {
        return $this->items['giveaway'] ?? null;
    }

    /**
     * (Optional). A giveaway with public winners was completed.
     */
    public function getGiveawayWinners(): ?GiveawayWinners
    {
        return $this->items['giveaway_winners'] ?? null;
    }

    /**
     * (Optional). Service message: a giveaway without public winners was completed.
     */
    public function getGiveawayCompleted(): ?GiveawayCompleted
    {
        return $this->items['giveaway_completed'] ?? null;
    }

    /**
     * (Optional). Service message: the price for paid messages has changed in the chat.
     */
    public function getPaidMessagePriceChanged(): ?PaidMessagePriceChanged
    {
        return $this->items['paid_message_price_changed'] ?? null;
    }

    /**
     * (Optional). Service message: a suggested post was approved.
     */
    public function getSuggestedPostApproved(): ?SuggestedPostApproved
    {
        return $this->items['suggested_post_approved'] ?? null;
    }

    /**
     * (Optional). Service message: approval of a suggested post failed.
     */
    public function getSuggestedPostApprovalFailed(): ?SuggestedPostApprovalFailed
    {
        return $this->items['suggested_post_approval_failed'] ?? null;
    }

    /**
     * (Optional). Service message: a suggested post was declined.
     */
    public function getSuggestedPostDeclined(): ?SuggestedPostDeclined
    {
        return $this->items['suggested_post_declined'] ?? null;
    }

    /**
     * (Optional). Service message: payment for a suggested post was received.
     */
    public function getSuggestedPostPaid(): ?SuggestedPostPaid
    {
        return $this->items['suggested_post_paid'] ?? null;
    }

    /**
     * (Optional). Service message: payment for a suggested post was refunded.
     */
    public function getSuggestedPostRefunded(): ?SuggestedPostRefunded
    {
        return $this->items['suggested_post_refunded'] ?? null;
    }

    /**
     * (Optional). Service message: video chat scheduled (VideoChatScheduled).
     */
    public function getVideoChatScheduled(): ?VideoChatScheduled
    {
        return $this->items['video_chat_scheduled'] ?? null;
    }

    /**
     * (Optional). Service message: video chat started (VideoChatStarted).
     */
    public function getVideoChatStarted(): ?VideoChatStarted
    {
        return $this->items['video_chat_started'] ?? null;
    }

    /**
     * (Optional). Service message: video chat ended (VideoChatEnded).
     */
    public function getVideoChatEnded(): ?VideoChatEnded
    {
        return $this->items['video_chat_ended'] ?? null;
    }

    /**
     * (Optional). Service message: new participants invited to a video chat (VideoChatParticipantsInvited).
     */
    public function getVideoChatParticipantsInvited(): ?VideoChatParticipantsInvited
    {
        return $this->items['video_chat_participants_invited'] ?? null;
    }

    /**
     * (Optional). Service message: data sent by a Web App (WebAppData).
     */
    public function getWebAppData(): ?WebAppData
    {
        return $this->items['web_app_data'] ?? null;
    }

    /**
     * (Optional). Inline keyboard attached to the message.
     */
    public function getReplyMarkup(): ?InlineKeyboardMarkup
    {
        return $this->items['reply_markup'] ?? null;
    }

    /**
     * (deprecated. Replaced with new_chat_members)(Optional). A new member was added to the group.
     */
    public function getNewChatMember(): ?User
    {
        return $this->items['new_chat_member'] ?? null;
    }
}
