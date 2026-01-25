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
 * Request object for the sendLocation method.
 *
 * Use this method to send point on the map. On success, the sent Message is returned.
 *
 * @link https://core.telegram.org/bots/api#sendlocation
 */
class SendLocationRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  float  $latitude  Latitude of the location
     * @param  float  $longitude  Longitude of the location
     */
    public function __construct(
        protected int|string $chat_id,
        protected float $latitude,
        protected float $longitude,
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
     * The radius of uncertainty for the location, measured in meters; 0-1500.
     */
    public function horizontalAccuracy(float $horizontal_accuracy): self
    {
        $this->params['horizontal_accuracy'] = $horizontal_accuracy;

        return $this;
    }

    /**
     * Period in seconds during which the location will be updated (see Live Locations, should be between 60 and 86400, or 0x7FFFFFFF for live locations that can be edited indefinitely.
     */
    public function livePeriod(int $live_period): self
    {
        $this->params['live_period'] = $live_period;

        return $this;
    }

    /**
     * For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
     */
    public function heading(int $heading): self
    {
        $this->params['heading'] = $heading;

        return $this;
    }

    /**
     * For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     */
    public function proximityAlertRadius(int $proximity_alert_radius): self
    {
        $this->params['proximity_alert_radius'] = $proximity_alert_radius;

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
        return 'sendLocation';
    }

    public function validate(): void
    {
        if ($this->latitude < -90 || $this->latitude > 90) {
            throw new TelegramValidationException('Latitude must be between -90 and 90');
        }

        if ($this->longitude < -180 || $this->longitude > 180) {
            throw new TelegramValidationException('Longitude must be between -180 and 180');
        }

        if (isset($this->params['horizontal_accuracy'])) {
            $accuracy = $this->params['horizontal_accuracy'];
            if ($accuracy < 0 || $accuracy > 1500) {
                throw new TelegramValidationException('Horizontal accuracy must be between 0 and 1500');
            }
        }

        if (isset($this->params['live_period'])) {
            $livePeriod = $this->params['live_period'];
            if ($livePeriod !== 0x7FFFFFFF && ($livePeriod < 60 || $livePeriod > 86400)) {
                throw new TelegramValidationException('Live period must be between 60 and 86400, or 0x7FFFFFFF for indefinite');
            }
        }

        if (isset($this->params['heading'])) {
            $heading = $this->params['heading'];
            if ($heading < 1 || $heading > 360) {
                throw new TelegramValidationException('Heading must be between 1 and 360');
            }
        }

        if (isset($this->params['proximity_alert_radius'])) {
            $radius = $this->params['proximity_alert_radius'];
            if ($radius < 1 || $radius > 100000) {
                throw new TelegramValidationException('Proximity alert radius must be between 1 and 100000');
            }
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
        ] + $this->params;
    }
}
