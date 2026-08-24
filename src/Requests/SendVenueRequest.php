<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;
use Telegram\Bot\Objects\SuggestedPostParameters;
use Telegram\Bot\Traits\HasEphemeralMessageParameters;

/**
 * Request object for the sendVenue method.
 *
 * Use this method to send information about a venue. On success, the sent Message is returned.
 *
 * @link https://core.telegram.org/bots/api#sendvenue
 */
class SendVenueRequest extends TelegramApiRequest
{
    use HasEphemeralMessageParameters;

    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'ephemeral_message_parameters',
        'suggested_post_parameters',
        'reply_markup',
    ];

    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  float  $latitude  Latitude of the venue
     * @param  float  $longitude  Longitude of the venue
     * @param  string  $title  Name of the venue
     * @param  string  $address  Address of the venue
     */
    public function __construct(
        protected int|string $chat_id,
        protected float $latitude,
        protected float $longitude,
        protected string $title,
        protected string $address,
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
     * Identifier of the direct messages topic to which the message will be sent; required if the message is sent to a direct messages chat.
     */
    public function directMessagesTopicId(int $direct_messages_topic_id): self
    {
        $this->params['direct_messages_topic_id'] = $direct_messages_topic_id;

        return $this;
    }

    /**
     * Foursquare identifier of the venue.
     */
    public function foursquareId(string $foursquare_id): self
    {
        $this->params['foursquare_id'] = $foursquare_id;

        return $this;
    }

    /**
     * Foursquare type of the venue, if known. (For example, "arts_entertainment/default", "arts_entertainment/aquarium" or "food/icecream".)
     */
    public function foursquareType(string $foursquare_type): self
    {
        $this->params['foursquare_type'] = $foursquare_type;

        return $this;
    }

    /**
     * Google Places identifier of the venue.
     */
    public function googlePlaceId(string $google_place_id): self
    {
        $this->params['google_place_id'] = $google_place_id;

        return $this;
    }

    /**
     * Google Places type of the venue. (See supported types.)
     */
    public function googlePlaceType(string $google_place_type): self
    {
        $this->params['google_place_type'] = $google_place_type;

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
     * A JSON-serialized object containing the parameters of the suggested post to send; for direct messages chats only.
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
     * Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard,
     * instructions to remove a reply keyboard or to force a reply from the user.
     */
    public function replyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendVenue';
    }

    public function validate(): void
    {
        $this->validateEphemeralMessageParameters($this->params);

        if ($this->latitude < -90 || $this->latitude > 90) {
            throw new TelegramValidationException('Latitude must be between -90 and 90');
        }

        if ($this->longitude < -180 || $this->longitude > 180) {
            throw new TelegramValidationException('Longitude must be between -180 and 180');
        }

        if (mb_strlen($this->title) === 0) {
            throw new TelegramValidationException('Title cannot be empty');
        }

        if (mb_strlen($this->address) === 0) {
            throw new TelegramValidationException('Address cannot be empty');
        }

        // Validate suggested post parameters if provided
        if (isset($this->params['suggested_post_parameters'])) {
            $spp = $this->params['suggested_post_parameters'];
            if ($spp instanceof SuggestedPostParameters) {
                $spp->validate();
            } elseif (is_array($spp)) {
                $object = SuggestedPostParameters::fromArray($spp);
                $object->validate();
                $this->params['suggested_post_parameters'] = $object;
            }
        }

        $this->validateReplyParameters($this->params);
        $this->validateReplyMarkup($this->params);
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'title' => $this->title,
            'address' => $this->address,
        ] + $this->params;
    }
}
