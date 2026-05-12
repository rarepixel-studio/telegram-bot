<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class ExternalReplyInfo.
 *
 * This object contains information about a message that is being replied to, which may come from another chat or forum topic.
 */
class ExternalReplyInfo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'origin' => MessageOrigin::class,
            'chat' => Chat::class,
            'link_preview_options' => LinkPreviewOptions::class,
            'animation' => Animation::class,
            'audio' => Audio::class,
            'document' => Document::class,
            'live_photo' => LivePhoto::class,
            'paid_media' => PaidMediaInfo::class,
            'photo' => PhotoSize::class,
            'sticker' => Sticker::class,
            'story' => Story::class,
            'video' => Video::class,
            'video_note' => VideoNote::class,
            'voice' => Voice::class,
            'checklist' => Checklist::class,
            'contact' => Contact::class,
            'dice' => Dice::class,
            'game' => Game::class,
            'giveaway' => Giveaway::class,
            'giveaway_winners' => GiveawayWinners::class,
            'invoice' => Invoice::class,
            'location' => Location::class,
            'poll' => Poll::class,
            'venue' => Venue::class,
        ];
    }

    /**
     * Origin of the message replied to by the given message.
     */
    public function getOrigin(): MessageOrigin
    {
        return $this->items['origin'];
    }

    /**
     * (Optional). Chat the original message belongs to.
     */
    public function getChat(): ?Chat
    {
        return $this->items['chat'] ?? null;
    }

    /**
     * (Optional). Unique message identifier inside the original chat.
     */
    public function getMessageId(): ?int
    {
        return $this->items['message_id'] ?? null;
    }

    /**
     * (Optional). Options used for link preview generation.
     */
    public function getLinkPreviewOptions(): ?LinkPreviewOptions
    {
        return $this->items['link_preview_options'] ?? null;
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
     * (Optional). Message contains paid media; information about the paid media.
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
     * (Optional). Message is a forwarded story.
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
     * (Optional). True, if the message media is covered by a spoiler animation.
     */
    public function getHasMediaSpoiler(): ?bool
    {
        return $this->items['has_media_spoiler'] ?? null;
    }

    /**
     * (Optional). Message is a checklist.
     */
    public function getChecklist(): ?Checklist
    {
        return $this->items['checklist'] ?? null;
    }

    /**
     * (Optional). Message is a shared contact.
     */
    public function getContact(): ?Contact
    {
        return $this->items['contact'] ?? null;
    }

    /**
     * (Optional). Message is a dice with random value.
     */
    public function getDice(): ?Dice
    {
        return $this->items['dice'] ?? null;
    }

    /**
     * (Optional). Message is a game.
     */
    public function getGame(): ?Game
    {
        return $this->items['game'] ?? null;
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
     * (Optional). Message is an invoice.
     */
    public function getInvoice(): ?Invoice
    {
        return $this->items['invoice'] ?? null;
    }

    /**
     * (Optional). Message is a shared location.
     */
    public function getLocation(): ?Location
    {
        return $this->items['location'] ?? null;
    }

    /**
     * (Optional). Message is a native poll.
     */
    public function getPoll(): ?Poll
    {
        return $this->items['poll'] ?? null;
    }

    /**
     * (Optional). Message is a venue.
     */
    public function getVenue(): ?Venue
    {
        return $this->items['venue'] ?? null;
    }
}
