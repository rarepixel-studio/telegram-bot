<?php

namespace Telegram\Bot\Traits;

use Closure;
use Illuminate\Support\Collection;
use Telegram\Bot\Contracts\ApiRequestInterface;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\BotCommand;
use Telegram\Bot\Objects\BotDescription;
use Telegram\Bot\Objects\BotName;
use Telegram\Bot\Objects\BotShortDescription;
use Telegram\Bot\Objects\BusinessConnection;
use Telegram\Bot\Objects\Chat;
use Telegram\Bot\Objects\ChatAdministratorRights;
use Telegram\Bot\Objects\ChatInviteLink;
use Telegram\Bot\Objects\ChatMember;
use Telegram\Bot\Objects\File;
use Telegram\Bot\Objects\ForumTopic;
use Telegram\Bot\Objects\GameHighScore;
use Telegram\Bot\Objects\Gifts;
use Telegram\Bot\Objects\InputSticker;
use Telegram\Bot\Objects\MenuButton;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\MessageId;
use Telegram\Bot\Objects\Sticker;
use Telegram\Bot\Objects\Update;
use Telegram\Bot\Objects\User;
use Telegram\Bot\Objects\UserChatBoosts;
use Telegram\Bot\Objects\UserProfilePhotos;
use Telegram\Bot\Objects\WebhookInfo;
use Telegram\Bot\Requests\AddStickerToSetRequest;
use Telegram\Bot\Requests\AnswerCallbackQueryRequest;
use Telegram\Bot\Requests\AnswerInlineQueryRequest;
use Telegram\Bot\Requests\AnswerPreCheckoutQueryRequest;
use Telegram\Bot\Requests\AnswerShippingQueryRequest;
use Telegram\Bot\Requests\AnswerWebAppQueryRequest;
use Telegram\Bot\Requests\ApproveChatJoinRequestRequest;
use Telegram\Bot\Requests\ApproveSuggestedPostRequest;
use Telegram\Bot\Requests\BanChatMemberRequest;
use Telegram\Bot\Requests\BanChatSenderChatRequest;
use Telegram\Bot\Requests\CloseForumTopicRequest;
use Telegram\Bot\Requests\CloseGeneralForumTopicRequest;
use Telegram\Bot\Requests\CloseRequest;
use Telegram\Bot\Requests\ConvertGiftToStarsRequest;
use Telegram\Bot\Requests\CopyMessageRequest;
use Telegram\Bot\Requests\CopyMessagesRequest;
use Telegram\Bot\Requests\CreateChatInviteLinkRequest;
use Telegram\Bot\Requests\CreateChatSubscriptionInviteLinkRequest;
use Telegram\Bot\Requests\CreateForumTopicRequest;
use Telegram\Bot\Requests\CreateInvoiceLinkRequest;
use Telegram\Bot\Requests\CreateNewStickerSetRequest;
use Telegram\Bot\Requests\DeclineChatJoinRequestRequest;
use Telegram\Bot\Requests\DeclineSuggestedPostRequest;
use Telegram\Bot\Requests\DeleteBusinessMessagesRequest;
use Telegram\Bot\Requests\DeleteChatPhotoRequest;
use Telegram\Bot\Requests\DeleteChatStickerSetRequest;
use Telegram\Bot\Requests\DeleteForumTopicRequest;
use Telegram\Bot\Requests\DeleteMessageRequest;
use Telegram\Bot\Requests\DeleteMessagesRequest;
use Telegram\Bot\Requests\DeleteMyCommandsRequest;
use Telegram\Bot\Requests\DeleteStickerFromSetRequest;
use Telegram\Bot\Requests\DeleteStickerSetRequest;
use Telegram\Bot\Requests\DeleteStoryRequest;
use Telegram\Bot\Requests\DeleteWebhookRequest;
use Telegram\Bot\Requests\EditChatInviteLinkRequest;
use Telegram\Bot\Requests\EditChatSubscriptionInviteLinkRequest;
use Telegram\Bot\Requests\EditForumTopicRequest;
use Telegram\Bot\Requests\EditGeneralForumTopicRequest;
use Telegram\Bot\Requests\EditMessageCaptionRequest;
use Telegram\Bot\Requests\EditMessageLiveLocationRequest;
use Telegram\Bot\Requests\EditMessageMediaRequest;
use Telegram\Bot\Requests\EditMessageReplyMarkupRequest;
use Telegram\Bot\Requests\EditMessageTextRequest;
use Telegram\Bot\Requests\EditStoryRequest;
use Telegram\Bot\Requests\EditUserStarSubscriptionRequest;
use Telegram\Bot\Requests\ExportChatInviteLinkRequest;
use Telegram\Bot\Requests\ForwardMessageRequest;
use Telegram\Bot\Requests\ForwardMessagesRequest;
use Telegram\Bot\Requests\GetAvailableGiftsRequest;
use Telegram\Bot\Requests\GetBusinessAccountGiftsRequest;
use Telegram\Bot\Requests\GetBusinessAccountStarBalanceRequest;
use Telegram\Bot\Requests\GetBusinessConnectionRequest;
use Telegram\Bot\Requests\GetChatAdministratorsRequest;
use Telegram\Bot\Requests\GetChatMemberCountRequest;
use Telegram\Bot\Requests\GetChatMemberRequest;
use Telegram\Bot\Requests\GetChatMenuButtonRequest;
use Telegram\Bot\Requests\GetChatRequest;
use Telegram\Bot\Requests\GetCustomEmojiStickersRequest;
use Telegram\Bot\Requests\GetFileRequest;
use Telegram\Bot\Requests\GetForumTopicIconStickersRequest;
use Telegram\Bot\Requests\GetGameHighScoresRequest;
use Telegram\Bot\Requests\GetMeRequest;
use Telegram\Bot\Requests\GetMyCommandsRequest;
use Telegram\Bot\Requests\GetMyDefaultAdministratorRightsRequest;
use Telegram\Bot\Requests\GetMyDescriptionRequest;
use Telegram\Bot\Requests\GetMyNameRequest;
use Telegram\Bot\Requests\GetMyShortDescriptionRequest;
use Telegram\Bot\Requests\GetMyStarBalanceRequest;
use Telegram\Bot\Requests\GetStarTransactionsRequest;
use Telegram\Bot\Requests\GetStickerSetRequest;
use Telegram\Bot\Requests\GetUpdatesRequest;
use Telegram\Bot\Requests\GetUserChatBoostsRequest;
use Telegram\Bot\Requests\GetUserProfilePhotosRequest;
use Telegram\Bot\Requests\GetWebhookInfoRequest;
use Telegram\Bot\Requests\GiftPremiumSubscriptionRequest;
use Telegram\Bot\Requests\HideGeneralForumTopicRequest;
use Telegram\Bot\Requests\LeaveChatRequest;
use Telegram\Bot\Requests\LogOutRequest;
use Telegram\Bot\Requests\PinChatMessageRequest;
use Telegram\Bot\Requests\PostStoryRequest;
use Telegram\Bot\Requests\PromoteChatMemberRequest;
use Telegram\Bot\Requests\ReadBusinessMessageRequest;
use Telegram\Bot\Requests\RefundStarPaymentRequest;
use Telegram\Bot\Requests\RemoveBusinessAccountProfilePhotoRequest;
use Telegram\Bot\Requests\RemoveChatVerificationRequest;
use Telegram\Bot\Requests\RemoveUserVerificationRequest;
use Telegram\Bot\Requests\ReopenForumTopicRequest;
use Telegram\Bot\Requests\ReopenGeneralForumTopicRequest;
use Telegram\Bot\Requests\ReplaceStickerInSetRequest;
use Telegram\Bot\Requests\RestrictChatMemberRequest;
use Telegram\Bot\Requests\RevokeChatInviteLinkRequest;
use Telegram\Bot\Requests\SavePreparedInlineMessageRequest;
use Telegram\Bot\Requests\SendAnimationRequest;
use Telegram\Bot\Requests\SendAudioRequest;
use Telegram\Bot\Requests\SendChatActionRequest;
use Telegram\Bot\Requests\SendChecklistRequest;
use Telegram\Bot\Requests\SendContactRequest;
use Telegram\Bot\Requests\SendDiceRequest;
use Telegram\Bot\Requests\SendDocumentRequest;
use Telegram\Bot\Requests\SendGameRequest;
use Telegram\Bot\Requests\SendGiftRequest;
use Telegram\Bot\Requests\SendInvoiceRequest;
use Telegram\Bot\Requests\SendLocationRequest;
use Telegram\Bot\Requests\SendMediaGroupRequest;
use Telegram\Bot\Requests\SendMessageRequest;
use Telegram\Bot\Requests\SendPaidMediaRequest;
use Telegram\Bot\Requests\SendPhotoRequest;
use Telegram\Bot\Requests\SendPollRequest;
use Telegram\Bot\Requests\SendStickerRequest;
use Telegram\Bot\Requests\SendVenueRequest;
use Telegram\Bot\Requests\SendVideoNoteRequest;
use Telegram\Bot\Requests\SendVideoRequest;
use Telegram\Bot\Requests\SendVoiceRequest;
use Telegram\Bot\Requests\SetBusinessAccountBioRequest;
use Telegram\Bot\Requests\SetBusinessAccountGiftSettingsRequest;
use Telegram\Bot\Requests\SetBusinessAccountNameRequest;
use Telegram\Bot\Requests\SetBusinessAccountProfilePhotoRequest;
use Telegram\Bot\Requests\SetBusinessAccountUsernameRequest;
use Telegram\Bot\Requests\SetChatAdministratorCustomTitleRequest;
use Telegram\Bot\Requests\SetChatDescriptionRequest;
use Telegram\Bot\Requests\SetChatMenuButtonRequest;
use Telegram\Bot\Requests\SetChatPermissionsRequest;
use Telegram\Bot\Requests\SetChatPhotoRequest;
use Telegram\Bot\Requests\SetChatStickerSetRequest;
use Telegram\Bot\Requests\SetChatTitleRequest;
use Telegram\Bot\Requests\SetCustomEmojiStickerSetThumbnailRequest;
use Telegram\Bot\Requests\SetGameScoreRequest;
use Telegram\Bot\Requests\SetMessageReactionRequest;
use Telegram\Bot\Requests\SetMyCommandsRequest;
use Telegram\Bot\Requests\SetMyDefaultAdministratorRightsRequest;
use Telegram\Bot\Requests\SetMyDescriptionRequest;
use Telegram\Bot\Requests\SetMyNameRequest;
use Telegram\Bot\Requests\SetMyShortDescriptionRequest;
use Telegram\Bot\Requests\SetPassportDataErrorsRequest;
use Telegram\Bot\Requests\SetStickerEmojiListRequest;
use Telegram\Bot\Requests\SetStickerKeywordsRequest;
use Telegram\Bot\Requests\SetStickerMaskPositionRequest;
use Telegram\Bot\Requests\SetStickerPositionInSetRequest;
use Telegram\Bot\Requests\SetStickerSetThumbnailRequest;
use Telegram\Bot\Requests\SetStickerSetTitleRequest;
use Telegram\Bot\Requests\SetUserEmojiStatusRequest;
use Telegram\Bot\Requests\SetWebhookRequest;
use Telegram\Bot\Requests\StopMessageLiveLocationRequest;
use Telegram\Bot\Requests\StopPollRequest;
use Telegram\Bot\Requests\TransferBusinessAccountStarsRequest;
use Telegram\Bot\Requests\TransferGiftRequest;
use Telegram\Bot\Requests\UnbanChatMemberRequest;
use Telegram\Bot\Requests\UnbanChatSenderChatRequest;
use Telegram\Bot\Requests\UnhideGeneralForumTopicRequest;
use Telegram\Bot\Requests\UnpinAllChatMessagesRequest;
use Telegram\Bot\Requests\UnpinAllForumTopicMessagesRequest;
use Telegram\Bot\Requests\UnpinAllGeneralForumTopicMessagesRequest;
use Telegram\Bot\Requests\UnpinChatMessageRequest;
use Telegram\Bot\Requests\UpgradeGiftRequest;
use Telegram\Bot\Requests\UploadStickerFileRequest;
use Telegram\Bot\Requests\VerifyChatRequest;
use Telegram\Bot\Requests\VerifyUserRequest;
use Telegram\Bot\TelegramResponse;

/**
 * Trait ApiMethodWrappers.
 *
 * Contains method wrappers that accept either arrays or typed request objects.
 * This trait keeps the Api class small while providing flexible method signatures.
 */
trait ApiMethodWrappers
{
    /**
     * Handle an API request using a typed request object.
     *
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function handleRequest(ApiRequestInterface $request): mixed
    {
        $request->validate();

        $method = $request->getMethod();

        if ($request instanceof SendMediaGroupRequest) {
            $params = $request->toArray();
            $attachments = $this->extractInputMedia($params);
            $response = $this->post($method, $params, [], $attachments);

            return $this->prepareResponse(function (TelegramResponse $response) {
                return collect($response->getResult())->map(function ($message) {
                    return new Message($message);
                });
            }, $response);
        }

        if ($request instanceof SendPaidMediaRequest) {
            $params = $request->toArray();
            $attachments = $this->extractInputMedia($params);
            $response = $this->post($method, $params, [], $attachments);

            return $this->prepareResponse(function (TelegramResponse $response) {
                return new Message($response->getDecodedBody());
            }, $response);
        }

        $params = $request->toArray();

        if (in_array($method, ['logOut', 'close', 'removeWebhook'], true)) {
            return $this->{$method}();
        }

        if (in_array($method, ['getWebhookUpdate', 'getWebhookUpdates'], true)) {
            return $this->{$method}();
        }

        if (method_exists($this, $method)) {
            return $this->{$method}($params);
        }

        return $this->post($method, $params);
    }

    /**
     * Use this method to receive incoming updates using long polling.
     *
     * @link https://core.telegram.org/bots/api#getupdates
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function getUpdates(array|GetUpdatesRequest $params = []): Collection|Closure
    {
        if ($params instanceof GetUpdatesRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getUpdates', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return collect($response->getResult())->map(function ($update) {
                return new Update($update);
            });
        }, $response);
    }

    /**
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook.
     *
     * @link https://core.telegram.org/bots/api#setwebhook
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function setWebhook(array|SetWebhookRequest $params): bool|Closure
    {
        if ($params instanceof SetWebhookRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        if (filter_var($params['url'], FILTER_VALIDATE_URL) === false) {
            throw new TelegramValidationException('Invalid URL Provided');
        }

        if (parse_url($params['url'], PHP_URL_SCHEME) !== 'https') {
            throw new TelegramValidationException('Invalid URL, should be a HTTPS url.');
        }

        $parser = function (TelegramResponse $response) {
            return $response->getResult();
        };

        if (isset($params['certificate'])) {
            return $this->uploadFile('setWebhook', $params, ['certificate'], $parser);
        }

        $response = $this->post('setWebhook', $params);

        return $this->prepareResponse($parser, $response);
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates.
     *
     * @link https://core.telegram.org/bots/api#deletewebhook
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function deleteWebhook(array|DeleteWebhookRequest|null $params = null): bool|Closure
    {
        if ($params instanceof DeleteWebhookRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $params = $params ?? [];

        $response = $this->post('deleteWebhook', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Use this method to get current webhook status.
     *
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function getWebhookInfo(array|GetWebhookInfoRequest $params = []): WebhookInfo|Closure
    {
        if ($params instanceof GetWebhookInfoRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getWebhookInfo', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new WebhookInfo($response->getDecodedBody());
        }, $response);
    }

    /**
     * Returns a webhook update sent by Telegram.
     * Works only if you set a webhook.
     *
     * @see setWebhook
     */
    public function getWebhookUpdate(): Update
    {
        $body = json_decode(file_get_contents('php://input'), true);

        return new Update($body);
    }

    /**
     * @deprecated Use getWebhookUpdate instead.
     */
    public function getWebhookUpdates(): Update
    {
        return $this->getWebhookUpdate();
    }

    /**
     * Alias for deleteWebhook.
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function removeWebhook(): bool|Closure
    {
        return $this->deleteWebhook();
    }

    /**
     * Log out from the cloud Bot API server before launching the bot locally.
     *
     * @link https://core.telegram.org/bots/api#logout
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function logOut(?LogOutRequest $request = null): bool|Closure
    {
        if ($request !== null) {
            $request->validate();
        }

        $response = $this->post('logOut');

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Close the bot instance before moving it from one local server to another.
     *
     * @link https://core.telegram.org/bots/api#close
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function close(?CloseRequest $request = null): bool|Closure
    {
        if ($request !== null) {
            $request->validate();
        }

        $response = $this->post('close');

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Send text messages.
     *
     * @link https://core.telegram.org/bots/api#sendmessage
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendMessage(array|SendMessageRequest $params): Message|Closure
    {
        if ($params instanceof SendMessageRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('sendMessage', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * Forward messages of any kind.
     *
     * @link https://core.telegram.org/bots/api#forwardmessage
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function forwardMessage(array|ForwardMessageRequest $params): Message|Closure
    {
        if ($params instanceof ForwardMessageRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('forwardMessage', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * Forward multiple messages of any kind.
     *
     * @link https://core.telegram.org/bots/api#forwardmessages
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function forwardMessages(array|ForwardMessagesRequest $params): Collection|Closure
    {
        if ($params instanceof ForwardMessagesRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('forwardMessages', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return collect($response->getResult())->map(function ($messageId) {
                return new MessageId($messageId);
            });
        }, $response);
    }

    /**
     * Copy messages of any kind.
     *
     * @link https://core.telegram.org/bots/api#copymessage
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function copyMessage(array|CopyMessageRequest $params): MessageId|Closure
    {
        if ($params instanceof CopyMessageRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('copyMessage', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new MessageId($response->getDecodedBody());
        }, $response);
    }

    /**
     * Copy multiple messages of any kind.
     *
     * @link https://core.telegram.org/bots/api#copymessages
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function copyMessages(array|CopyMessagesRequest $params): Collection|Closure
    {
        if ($params instanceof CopyMessagesRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('copyMessages', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return collect($response->getResult())->map(function ($messageId) {
                return new MessageId($messageId);
            });
        }, $response);
    }

    /**
     * Send Photos.
     *
     * @link https://core.telegram.org/bots/api#sendphoto
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendPhoto(array|SendPhotoRequest $params): Message|Closure
    {
        if ($params instanceof SendPhotoRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->uploadFile('sendPhoto', $params, ['photo']);
    }

    /**
     * Send regular audio files.
     *
     * @link https://core.telegram.org/bots/api#sendaudio
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendAudio(array|SendAudioRequest $params): Message|Closure
    {
        if ($params instanceof SendAudioRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->uploadFile('sendAudio', $params, ['audio', 'thumb', 'thumbnail']);
    }

    /**
     * Send general files.
     *
     * @link https://core.telegram.org/bots/api#senddocument
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendDocument(array|SendDocumentRequest $params): Message|Closure
    {
        if ($params instanceof SendDocumentRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->uploadFile('sendDocument', $params, ['document', 'thumb', 'thumbnail']);
    }

    /**
     * Send video files.
     *
     * @link https://core.telegram.org/bots/api#sendvideo
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendVideo(array|SendVideoRequest $params): Message|Closure
    {
        if ($params instanceof SendVideoRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->uploadFile('sendVideo', $params, ['video', 'thumb', 'thumbnail', 'cover']);
    }

    /**
     * Send animation files (GIF or H.264/MPEG-4 AVC video without sound).
     *
     * @link https://core.telegram.org/bots/api#sendanimation
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendAnimation(array|SendAnimationRequest $params): Message|Closure
    {
        if ($params instanceof SendAnimationRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->uploadFile('sendAnimation', $params, ['animation', 'thumb', 'thumbnail']);
    }

    /**
     * Send voice audio files.
     *
     * @link https://core.telegram.org/bots/api#sendvoice
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendVoice(array|SendVoiceRequest $params): Message|Closure
    {
        if ($params instanceof SendVoiceRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->uploadFile('sendVoice', $params, ['voice']);
    }

    /**
     * Send video note messages.
     *
     * @link https://core.telegram.org/bots/api#sendvideonote
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendVideoNote(array|SendVideoNoteRequest $params): Message|Closure
    {
        if ($params instanceof SendVideoNoteRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->uploadFile('sendVideoNote', $params, ['video_note', 'thumb', 'thumbnail']);
    }

    /**
     * Send paid media.
     *
     * @link https://core.telegram.org/bots/api#sendpaidmedia
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendPaidMedia(array|SendPaidMediaRequest $params): Message|Closure
    {
        if ($params instanceof SendPaidMediaRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $attachments = $this->extractInputMedia($params);

        $response = $this->post('sendPaidMedia', $params, [], $attachments);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * Send a group of photos or videos as an album.
     *
     * @link https://core.telegram.org/bots/api#sendmediagroup
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendMediaGroup(array|SendMediaGroupRequest $params): Collection|Closure
    {
        if ($params instanceof SendMediaGroupRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $attachments = $this->extractInputMedia($params);

        $response = $this->post('sendMediaGroup', $params, [], $attachments);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return collect($response->getResult())->map(function ($message) {
                return new Message($message);
            });
        }, $response);
    }

    /**
     * Send point on the map.
     *
     * @link https://core.telegram.org/bots/api#sendlocation
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendLocation(array|SendLocationRequest $params): Message|Closure
    {
        if ($params instanceof SendLocationRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('sendLocation', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * Send information about a venue.
     *
     * @link https://core.telegram.org/bots/api#sendvenue
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendVenue(array|SendVenueRequest $params): Message|Closure
    {
        if ($params instanceof SendVenueRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('sendVenue', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * Send phone contacts.
     *
     * @link https://core.telegram.org/bots/api#sendcontact
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendContact(array|SendContactRequest $params): Message|Closure
    {
        if ($params instanceof SendContactRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('sendContact', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * Send a native poll.
     *
     * @link https://core.telegram.org/bots/api#sendpoll
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendPoll(array|SendPollRequest $params): Message|Closure
    {
        if ($params instanceof SendPollRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('sendPoll', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * Send a checklist.
     *
     * @link https://core.telegram.org/bots/api#sendchecklist
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendChecklist(array|SendChecklistRequest $params): Message|Closure
    {
        if ($params instanceof SendChecklistRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('sendChecklist', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * Send an animated emoji that displays a random value.
     *
     * @link https://core.telegram.org/bots/api#senddice
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendDice(array|SendDiceRequest $params): Message
    {
        if ($params instanceof SendDiceRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('sendDice', $params);

        return new Message($response->getDecodedBody());
    }

    /**
     * Send a chat action to tell the user that something is happening.
     *
     * @link https://core.telegram.org/bots/api#sendchataction
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function sendChatAction(array|SendChatActionRequest $params): bool|Closure
    {
        if ($params instanceof SendChatActionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('sendChatAction', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Change the chosen reactions on a message.
     *
     * @link https://core.telegram.org/bots/api#setmessagereaction
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function setMessageReaction(array|SetMessageReactionRequest $params): bool
    {
        if ($params instanceof SetMessageReactionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setMessageReaction', $params);

        return $response->getResult();
    }

    /**
     * Get a list of profile pictures for a user.
     *
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function getUserProfilePhotos(array|GetUserProfilePhotosRequest $params): UserProfilePhotos|Closure
    {
        if ($params instanceof GetUserProfilePhotosRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getUserProfilePhotos', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new UserProfilePhotos($response->getDecodedBody());
        }, $response);
    }

    /**
     * Get basic information about a file and prepare it for downloading.
     *
     * @link https://core.telegram.org/bots/api#getfile
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function getFile(array|GetFileRequest $params): File|Closure
    {
        if ($params instanceof GetFileRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getFile', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new File($response->getDecodedBody());
        }, $response);
    }

    /**
     * Ban a user in a group, supergroup, or channel.
     *
     * @link https://core.telegram.org/bots/api#banchatmember
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function banChatMember(array|BanChatMemberRequest $params): bool|Closure
    {
        if ($params instanceof BanChatMemberRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('banChatMember', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Kick a user from a group or a supergroup.
     *
     * @link https://core.telegram.org/bots/api#kickchatmember
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function kickChatMember(array $params): bool|Closure
    {
        $response = $this->post('kickChatMember', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Unban a previously banned user in a supergroup or channel.
     *
     * @link https://core.telegram.org/bots/api#unbanchatmember
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function unbanChatMember(array|UnbanChatMemberRequest $params): bool|Closure
    {
        if ($params instanceof UnbanChatMemberRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('unbanChatMember', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Changes the emoji status for a given user.
     *
     * @link https://core.telegram.org/bots/api#setuseremojistatus
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function setUserEmojiStatus(array|SetUserEmojiStatusRequest $params): bool|Closure
    {
        if ($params instanceof SetUserEmojiStatusRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setUserEmojiStatus', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Restrict a user in a supergroup.
     *
     * @link https://core.telegram.org/bots/api#restrictchatmember
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function restrictChatMember(array|RestrictChatMemberRequest $params): bool|Closure
    {
        if ($params instanceof RestrictChatMemberRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('restrictChatMember', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Promote or demote a user in a supergroup or channel.
     *
     * @link https://core.telegram.org/bots/api#promotechatmember
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function promoteChatMember(array|PromoteChatMemberRequest $params): bool|Closure
    {
        if ($params instanceof PromoteChatMemberRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('promoteChatMember', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Set a custom title for an administrator in a supergroup.
     *
     * @link https://core.telegram.org/bots/api#setchatadministratorcustomtitle
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function setChatAdministratorCustomTitle(array|SetChatAdministratorCustomTitleRequest $params): bool|Closure
    {
        if ($params instanceof SetChatAdministratorCustomTitleRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setChatAdministratorCustomTitle', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Ban a channel chat in a supergroup or a channel.
     *
     * @link https://core.telegram.org/bots/api#banchatsenderchat
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function banChatSenderChat(array|BanChatSenderChatRequest $params): bool|Closure
    {
        if ($params instanceof BanChatSenderChatRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('banChatSenderChat', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Unban a previously banned channel chat in a supergroup or channel.
     *
     * @link https://core.telegram.org/bots/api#unbanchatsenderchat
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function unbanChatSenderChat(array|UnbanChatSenderChatRequest $params): bool|Closure
    {
        if ($params instanceof UnbanChatSenderChatRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('unbanChatSenderChat', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Set default chat permissions for all members.
     *
     * @link https://core.telegram.org/bots/api#setchatpermissions
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function setChatPermissions(array|SetChatPermissionsRequest $params): bool|Closure
    {
        if ($params instanceof SetChatPermissionsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setChatPermissions', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Generate a new primary invite link for a chat.
     *
     * @link https://core.telegram.org/bots/api#exportchatinvitelink
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function exportChatInviteLink(array|ExportChatInviteLinkRequest $params): string|Closure
    {
        if ($params instanceof ExportChatInviteLinkRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('exportChatInviteLink', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Create an additional invite link for a chat.
     *
     * @link https://core.telegram.org/bots/api#createchatinvitelink
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function createChatInviteLink(array|CreateChatInviteLinkRequest $params): ChatInviteLink|Closure
    {
        if ($params instanceof CreateChatInviteLinkRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('createChatInviteLink', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new ChatInviteLink($response->getDecodedBody());
        }, $response);
    }

    /**
     * Edit a non-primary invite link created by the bot.
     *
     * @link https://core.telegram.org/bots/api#editchatinvitelink
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function editChatInviteLink(array|EditChatInviteLinkRequest $params): ChatInviteLink|Closure
    {
        if ($params instanceof EditChatInviteLinkRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('editChatInviteLink', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new ChatInviteLink($response->getDecodedBody());
        }, $response);
    }

    /**
     * Create a subscription invite link for a channel chat.
     *
     * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function createChatSubscriptionInviteLink(array|CreateChatSubscriptionInviteLinkRequest $params): ChatInviteLink|Closure
    {
        if ($params instanceof CreateChatSubscriptionInviteLinkRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('createChatSubscriptionInviteLink', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new ChatInviteLink($response->getDecodedBody());
        }, $response);
    }

    /**
     * Edit a subscription invite link created by the bot.
     *
     * @link https://core.telegram.org/bots/api#editchatsubscriptioninvitelink
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function editChatSubscriptionInviteLink(array|EditChatSubscriptionInviteLinkRequest $params): ChatInviteLink|Closure
    {
        if ($params instanceof EditChatSubscriptionInviteLinkRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('editChatSubscriptionInviteLink', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new ChatInviteLink($response->getDecodedBody());
        }, $response);
    }

    /**
     * Revoke an invite link created by the bot.
     *
     * @link https://core.telegram.org/bots/api#revokechatinvitelink
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function revokeChatInviteLink(array|RevokeChatInviteLinkRequest $params): ChatInviteLink|Closure
    {
        if ($params instanceof RevokeChatInviteLinkRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('revokeChatInviteLink', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new ChatInviteLink($response->getDecodedBody());
        }, $response);
    }

    /**
     * Approve a chat join request.
     *
     * @link https://core.telegram.org/bots/api#approvechatjoinrequest
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function approveChatJoinRequest(array|ApproveChatJoinRequestRequest $params): bool|Closure
    {
        if ($params instanceof ApproveChatJoinRequestRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('approveChatJoinRequest', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Decline a chat join request.
     *
     * @link https://core.telegram.org/bots/api#declinechatjoinrequest
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function declineChatJoinRequest(array|DeclineChatJoinRequestRequest $params): bool|Closure
    {
        if ($params instanceof DeclineChatJoinRequestRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('declineChatJoinRequest', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Set a new profile photo for the chat.
     *
     * @link https://core.telegram.org/bots/api#setchatphoto
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function setChatPhoto(array|SetChatPhotoRequest $params): bool|Closure
    {
        if ($params instanceof SetChatPhotoRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $parser = function (TelegramResponse $response) {
            return $response->getResult();
        };

        return $this->uploadFile('setChatPhoto', $params, ['photo'], $parser);
    }

    /**
     * Delete a chat photo.
     *
     * @link https://core.telegram.org/bots/api#deletechatphoto
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function deleteChatPhoto(array|DeleteChatPhotoRequest $params): bool|Closure
    {
        if ($params instanceof DeleteChatPhotoRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('deleteChatPhoto', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Change the title of a chat.
     *
     * @link https://core.telegram.org/bots/api#setchattitle
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function setChatTitle(array|SetChatTitleRequest $params): bool|Closure
    {
        if ($params instanceof SetChatTitleRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setChatTitle', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Change the description of a group, supergroup or channel.
     *
     * @link https://core.telegram.org/bots/api#setchatdescription
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function setChatDescription(array|SetChatDescriptionRequest $params): bool|Closure
    {
        if ($params instanceof SetChatDescriptionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setChatDescription', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Add a message to the list of pinned messages in a chat.
     *
     * @link https://core.telegram.org/bots/api#pinchatmessage
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function pinChatMessage(array|PinChatMessageRequest $params): bool|Closure
    {
        if ($params instanceof PinChatMessageRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('pinChatMessage', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Remove a message from the list of pinned messages in a chat.
     *
     * @link https://core.telegram.org/bots/api#unpinchatmessage
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function unpinChatMessage(array|UnpinChatMessageRequest $params): mixed
    {
        if ($params instanceof UnpinChatMessageRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('unpinChatMessage', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Clear the list of pinned messages in a chat.
     *
     * @link https://core.telegram.org/bots/api#unpinallchatmessages
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function unpinAllChatMessages(array|UnpinAllChatMessagesRequest $params): bool|Closure
    {
        if ($params instanceof UnpinAllChatMessagesRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('unpinAllChatMessages', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Leave a group, supergroup or channel.
     *
     * @link https://core.telegram.org/bots/api#leavechat
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function leaveChat(array|LeaveChatRequest $params): bool|Closure
    {
        if ($params instanceof LeaveChatRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('leaveChat', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Get up to date information about the chat.
     *
     * @link https://core.telegram.org/bots/api#getchat
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function getChat(array|GetChatRequest $params): Chat|Closure
    {
        if ($params instanceof GetChatRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getChat', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Chat($response->getDecodedBody());
        }, $response);
    }

    /**
     * Get a list of administrators in a chat.
     *
     * @link https://core.telegram.org/bots/api#getchatadministrators
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function getChatAdministrators(array|GetChatAdministratorsRequest $params): array|Closure
    {
        if ($params instanceof GetChatAdministratorsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getChatAdministrators', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            $members = [];

            foreach ($response->getResult() as $member) {
                $members[] = new ChatMember($member);
            }

            return $members;
        }, $response);
    }

    /**
     * Get the number of members in a chat.
     *
     * @link https://core.telegram.org/bots/api#getchatmemberscount
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function getChatMembersCount(array $params): int|Closure
    {
        $response = $this->post('getChatMembersCount', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Get the number of members in a chat.
     *
     * @link https://core.telegram.org/bots/api#getchatmembercount
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function getChatMemberCount(array|GetChatMemberCountRequest $params): int|Closure
    {
        if ($params instanceof GetChatMemberCountRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getChatMemberCount', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Get information about a member of a chat.
     *
     * @link https://core.telegram.org/bots/api#getchatmember
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function getChatMember(array|GetChatMemberRequest $params): ChatMember|Closure
    {
        if ($params instanceof GetChatMemberRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getChatMember', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new ChatMember($response->getDecodedBody());
        }, $response);
    }

    /**
     * Set a new group sticker set for a supergroup.
     *
     * @link https://core.telegram.org/bots/api#setchatstickerset
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function setChatStickerSet(array|SetChatStickerSetRequest $params): bool|Closure
    {
        if ($params instanceof SetChatStickerSetRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setChatStickerSet', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Delete a group sticker set from a supergroup.
     *
     * @link https://core.telegram.org/bots/api#deletechatstickerset
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function deleteChatStickerSet(array|DeleteChatStickerSetRequest $params): bool|Closure
    {
        if ($params instanceof DeleteChatStickerSetRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('deleteChatStickerSet', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Get custom emoji stickers for forum topic icons.
     *
     * @link https://core.telegram.org/bots/api#getforumtopiconstickers
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function getForumTopicIconStickers(array|GetForumTopicIconStickersRequest $params = []): Collection|Closure
    {
        if ($params instanceof GetForumTopicIconStickersRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getForumTopicIconStickers', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return collect($response->getResult());
        }, $response);
    }

    /**
     * Create a topic in a forum supergroup chat.
     *
     * @link https://core.telegram.org/bots/api#createforumtopic
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function createForumTopic(array|CreateForumTopicRequest $params): ForumTopic|Closure
    {
        if ($params instanceof CreateForumTopicRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('createForumTopic', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new ForumTopic($response->getDecodedBody());
        }, $response);
    }

    /**
     * Edit name and icon of a topic in a forum supergroup chat.
     *
     * @link https://core.telegram.org/bots/api#editforumtopic
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function editForumTopic(array|EditForumTopicRequest $params): bool|Closure
    {
        if ($params instanceof EditForumTopicRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('editForumTopic', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Close an open topic in a forum supergroup chat.
     *
     * @link https://core.telegram.org/bots/api#closeforumtopic
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function closeForumTopic(array|CloseForumTopicRequest $params): bool|Closure
    {
        if ($params instanceof CloseForumTopicRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('closeForumTopic', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Reopen a closed topic in a forum supergroup chat.
     *
     * @link https://core.telegram.org/bots/api#reopenforumtopic
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function reopenForumTopic(array|ReopenForumTopicRequest $params): bool|Closure
    {
        if ($params instanceof ReopenForumTopicRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('reopenForumTopic', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Delete a forum topic along with all its messages.
     *
     * @link https://core.telegram.org/bots/api#deleteforumtopic
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function deleteForumTopic(array|DeleteForumTopicRequest $params): bool|Closure
    {
        if ($params instanceof DeleteForumTopicRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('deleteForumTopic', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Clear the list of pinned messages in a forum topic.
     *
     * @link https://core.telegram.org/bots/api#unpinallforumtopicmessages
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function unpinAllForumTopicMessages(array|UnpinAllForumTopicMessagesRequest $params): bool|Closure
    {
        if ($params instanceof UnpinAllForumTopicMessagesRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('unpinAllForumTopicMessages', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * Edit the name of the 'General' topic in a forum supergroup chat.
     *
     * @link https://core.telegram.org/bots/api#editgeneralforumtopic
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function editGeneralForumTopic(array|EditGeneralForumTopicRequest $params): bool|Closure
    {
        if ($params instanceof EditGeneralForumTopicRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('editGeneralForumTopic', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    public function closeGeneralForumTopic(array|CloseGeneralForumTopicRequest $params): bool|Closure
    {
        if ($params instanceof CloseGeneralForumTopicRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('closeGeneralForumTopic', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    public function reopenGeneralForumTopic(array|ReopenGeneralForumTopicRequest $params): bool|Closure
    {
        if ($params instanceof ReopenGeneralForumTopicRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('reopenGeneralForumTopic', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    public function hideGeneralForumTopic(array|HideGeneralForumTopicRequest $params): bool|Closure
    {
        if ($params instanceof HideGeneralForumTopicRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('hideGeneralForumTopic', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    public function unhideGeneralForumTopic(array|UnhideGeneralForumTopicRequest $params): bool|Closure
    {
        if ($params instanceof UnhideGeneralForumTopicRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('unhideGeneralForumTopic', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    public function unpinAllGeneralForumTopicMessages(array|UnpinAllGeneralForumTopicMessagesRequest $params): bool|Closure
    {
        if ($params instanceof UnpinAllGeneralForumTopicMessagesRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('unpinAllGeneralForumTopicMessages', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function answerCallbackQuery(array|AnswerCallbackQueryRequest $params): bool|Closure
    {
        if ($params instanceof AnswerCallbackQueryRequest) {
            $params->validate();
            $params = $params->toArray();
        }
        $response = $this->post('answerCallbackQuery', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getUserChatBoosts(array|GetUserChatBoostsRequest $params): UserChatBoosts|Closure
    {
        if ($params instanceof GetUserChatBoostsRequest) {
            $params->validate();
            $params = $params->toArray();
        }
        $response = $this->post('getUserChatBoosts', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new UserChatBoosts($response->getResult());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getBusinessConnection(array|GetBusinessConnectionRequest $params): BusinessConnection|Closure
    {
        if ($params instanceof GetBusinessConnectionRequest) {
            $params->validate();
            $params = $params->toArray();
        }
        $response = $this->post('getBusinessConnection', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new BusinessConnection($response->getResult());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setMyCommands(array|SetMyCommandsRequest $params): bool|Closure
    {
        if ($params instanceof SetMyCommandsRequest) {
            $params->validate();
            $params = $params->toArray();
        }
        $response = $this->post('setMyCommands', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function deleteMyCommands(array|DeleteMyCommandsRequest $params = []): bool|Closure
    {
        if ($params instanceof DeleteMyCommandsRequest) {
            $params->validate();
            $params = $params->toArray();
        }
        $response = $this->post('deleteMyCommands', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getMyCommands(array|GetMyCommandsRequest $params = []): array|Closure
    {
        if ($params instanceof GetMyCommandsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getMyCommands', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return collect($response->getResult())
                ->map(function ($data) {
                    return new BotCommand($data);
                })
                ->all();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setMyName(array|SetMyNameRequest $params = []): bool|Closure
    {
        if ($params instanceof SetMyNameRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setMyName', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getMyName(array|GetMyNameRequest $params = []): BotName|Closure
    {
        if ($params instanceof GetMyNameRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getMyName', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new BotName($response->getResult());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setMyDescription(array|SetMyDescriptionRequest $params = []): bool|Closure
    {
        if ($params instanceof SetMyDescriptionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setMyDescription', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getMyDescription(array|GetMyDescriptionRequest $params = []): BotDescription|Closure
    {
        if ($params instanceof GetMyDescriptionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getMyDescription', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new BotDescription($response->getResult());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setMyShortDescription(array|SetMyShortDescriptionRequest $params = []): bool|Closure
    {
        if ($params instanceof SetMyShortDescriptionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setMyShortDescription', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getMyShortDescription(array|GetMyShortDescriptionRequest $params = []): BotShortDescription|Closure
    {
        if ($params instanceof GetMyShortDescriptionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getMyShortDescription', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new BotShortDescription($response->getResult());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setChatMenuButton(array|SetChatMenuButtonRequest $params = []): bool|Closure
    {
        if ($params instanceof SetChatMenuButtonRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setChatMenuButton', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getChatMenuButton(array|GetChatMenuButtonRequest $params = []): MenuButton|Closure
    {
        if ($params instanceof GetChatMenuButtonRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getChatMenuButton', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new MenuButton($response->getResult());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setMyDefaultAdministratorRights(array|SetMyDefaultAdministratorRightsRequest $params = []): bool|Closure
    {
        if ($params instanceof SetMyDefaultAdministratorRightsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setMyDefaultAdministratorRights', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getMyDefaultAdministratorRights(array|GetMyDefaultAdministratorRightsRequest $params = []): ChatAdministratorRights|Closure
    {
        if ($params instanceof GetMyDefaultAdministratorRightsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getMyDefaultAdministratorRights', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new ChatAdministratorRights($response->getResult());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getAvailableGifts(array|GetAvailableGiftsRequest $params = []): Gifts|Closure
    {
        if ($params instanceof GetAvailableGiftsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getAvailableGifts', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Gifts($response->getResult());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function sendGift(array|SendGiftRequest $params): bool|Closure
    {
        if ($params instanceof SendGiftRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('sendGift', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function giftPremiumSubscription(array|GiftPremiumSubscriptionRequest $params): bool|Closure
    {
        if ($params instanceof GiftPremiumSubscriptionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('giftPremiumSubscription', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function verifyUser(array|VerifyUserRequest $params): bool|Closure
    {
        if ($params instanceof VerifyUserRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('verifyUser', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function verifyChat(array|VerifyChatRequest $params): bool|Closure
    {
        if ($params instanceof VerifyChatRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('verifyChat', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function removeUserVerification(array|RemoveUserVerificationRequest $params): bool|Closure
    {
        if ($params instanceof RemoveUserVerificationRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('removeUserVerification', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function removeChatVerification(array|RemoveChatVerificationRequest $params): bool|Closure
    {
        if ($params instanceof RemoveChatVerificationRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('removeChatVerification', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function readBusinessMessage(array|ReadBusinessMessageRequest $params): bool|Closure
    {
        if ($params instanceof ReadBusinessMessageRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('readBusinessMessage', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function deleteBusinessMessages(array|DeleteBusinessMessagesRequest $params): bool|Closure
    {
        if ($params instanceof DeleteBusinessMessagesRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('deleteBusinessMessages', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setBusinessAccountName(array|SetBusinessAccountNameRequest $params): bool|Closure
    {
        if ($params instanceof SetBusinessAccountNameRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setBusinessAccountName', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setBusinessAccountUsername(array|SetBusinessAccountUsernameRequest $params): bool|Closure
    {
        if ($params instanceof SetBusinessAccountUsernameRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setBusinessAccountUsername', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setBusinessAccountBio(array|SetBusinessAccountBioRequest $params): bool|Closure
    {
        if ($params instanceof SetBusinessAccountBioRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setBusinessAccountBio', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setBusinessAccountProfilePhoto(array|SetBusinessAccountProfilePhotoRequest $params): bool|Closure
    {
        if ($params instanceof SetBusinessAccountProfilePhotoRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setBusinessAccountProfilePhoto', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function removeBusinessAccountProfilePhoto(array|RemoveBusinessAccountProfilePhotoRequest $params): bool|Closure
    {
        if ($params instanceof RemoveBusinessAccountProfilePhotoRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('removeBusinessAccountProfilePhoto', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setBusinessAccountGiftSettings(array|SetBusinessAccountGiftSettingsRequest $params): bool|Closure
    {
        if ($params instanceof SetBusinessAccountGiftSettingsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setBusinessAccountGiftSettings', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getBusinessAccountStarBalance(array|GetBusinessAccountStarBalanceRequest $params): int|Closure
    {
        if ($params instanceof GetBusinessAccountStarBalanceRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getBusinessAccountStarBalance', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function transferBusinessAccountStars(array|TransferBusinessAccountStarsRequest $params): bool|Closure
    {
        if ($params instanceof TransferBusinessAccountStarsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('transferBusinessAccountStars', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getBusinessAccountGifts(array|GetBusinessAccountGiftsRequest $params): Gifts|Closure
    {
        if ($params instanceof GetBusinessAccountGiftsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getBusinessAccountGifts', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Gifts($response->getResult());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function convertGiftToStars(array|ConvertGiftToStarsRequest $params): bool|Closure
    {
        if ($params instanceof ConvertGiftToStarsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('convertGiftToStars', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function upgradeGift(array|UpgradeGiftRequest $params): bool|Closure
    {
        if ($params instanceof UpgradeGiftRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('upgradeGift', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function transferGift(array|TransferGiftRequest $params): bool|Closure
    {
        if ($params instanceof TransferGiftRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('transferGift', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function postStory(array|PostStoryRequest $params): bool|Closure
    {
        if ($params instanceof PostStoryRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('postStory', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function editStory(array|EditStoryRequest $params): bool|Closure
    {
        if ($params instanceof EditStoryRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('editStory', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function deleteStory(array|DeleteStoryRequest $params): bool|Closure
    {
        if ($params instanceof DeleteStoryRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('deleteStory', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function editMessageText(array|EditMessageTextRequest $params = []): Message|Closure
    {
        if ($params instanceof EditMessageTextRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('editMessageText', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function editMessageCaption(array|EditMessageCaptionRequest $params = []): Message|Closure
    {
        if ($params instanceof EditMessageCaptionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('editMessageCaption', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function editMessageMedia(array|EditMessageMediaRequest $params = []): bool|Closure
    {
        if ($params instanceof EditMessageMediaRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $attachments = $this->extractInputMedia($params);

        $response = $this->post('editMessageMedia', $params, [], $attachments);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return (bool) $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function editMessageLiveLocation(array|EditMessageLiveLocationRequest $params = []): Message|bool|Closure
    {
        if ($params instanceof EditMessageLiveLocationRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('editMessageLiveLocation', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            $result = $response->getResult();

            if (is_bool($result)) {
                return $result;
            }

            return new Message($result);
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function stopMessageLiveLocation(array|StopMessageLiveLocationRequest $params = []): Message|bool|Closure
    {
        if ($params instanceof StopMessageLiveLocationRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('stopMessageLiveLocation', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            $result = $response->getResult();

            if (is_bool($result)) {
                return $result;
            }

            return new Message($result);
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function editMessageReplyMarkup(array|EditMessageReplyMarkupRequest $params = []): Message|Closure
    {
        if ($params instanceof EditMessageReplyMarkupRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('editMessageReplyMarkup', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function stopPoll(array|StopPollRequest $params): \Telegram\Bot\Objects\Poll|Closure
    {
        if ($params instanceof StopPollRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new \Telegram\Bot\Objects\Poll($response->getResult());
        }, $this->post('stopPoll', $params));
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function deleteMessage(array|DeleteMessageRequest $params): bool|Closure
    {
        if ($params instanceof DeleteMessageRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('deleteMessage', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function deleteMessages(array|DeleteMessagesRequest $params): bool|Closure
    {
        if ($params instanceof DeleteMessagesRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('deleteMessages', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function sendSticker(array|SendStickerRequest $params): Message|Closure
    {
        if ($params instanceof SendStickerRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        if (is_file($params['sticker']) && (pathinfo($params['sticker'], PATHINFO_EXTENSION) !== 'webp')) {
            throw new TelegramValidationException('Invalid Sticker Provided. Supported Format: Webp');
        }

        return $this->uploadFile('sendSticker', $params, ['sticker']);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getStickerSet(array|GetStickerSetRequest $params): \Telegram\Bot\Objects\StickerSet|Closure
    {
        if ($params instanceof GetStickerSetRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getStickerSet', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new \Telegram\Bot\Objects\StickerSet($response->getDecodedBody());
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    // getCustomEmojiStickers returns Array of Stickers
    public function getCustomEmojiStickers(array|GetCustomEmojiStickersRequest $params): array|Closure
    {
        if ($params instanceof GetCustomEmojiStickersRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getCustomEmojiStickers', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return collect($response->getResult())->map(function ($data) {
                return new Sticker($data);
            })->all();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function uploadStickerFile(array|UploadStickerFileRequest $params): File|Closure
    {
        if ($params instanceof UploadStickerFileRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $parser = function (TelegramResponse $response) {
            return new File($response->getDecodedBody());
        };

        return $this->uploadFile('uploadStickerFile', $params, ['sticker'], $parser);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function createNewStickerSet(array|CreateNewStickerSetRequest $params): bool|Closure
    {
        if ($params instanceof CreateNewStickerSetRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $attachments = $this->extractInputStickers($params);
        $response = $this->post('createNewStickerSet', $params, [], $attachments);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function addStickerToSet(array|AddStickerToSetRequest $params): bool|Closure
    {
        if ($params instanceof AddStickerToSetRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $attachments = $this->extractInputStickers($params);
        $response = $this->post('addStickerToSet', $params, [], $attachments);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setStickerPositionInSet(array|SetStickerPositionInSetRequest $params): bool|Closure
    {
        if ($params instanceof SetStickerPositionInSetRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setStickerPositionInSet', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function deleteStickerFromSet(array|DeleteStickerFromSetRequest $params): bool|Closure
    {
        if ($params instanceof DeleteStickerFromSetRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('deleteStickerFromSet', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function replaceStickerInSet(array|ReplaceStickerInSetRequest $params): bool|Closure
    {
        if ($params instanceof ReplaceStickerInSetRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $attachments = $this->extractInputStickers($params);
        $response = $this->post('replaceStickerInSet', $params, [], $attachments);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setStickerEmojiList(array|SetStickerEmojiListRequest $params): bool|Closure
    {
        if ($params instanceof SetStickerEmojiListRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setStickerEmojiList', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setStickerKeywords(array|SetStickerKeywordsRequest $params): bool|Closure
    {
        if ($params instanceof SetStickerKeywordsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setStickerKeywords', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setStickerMaskPosition(array|SetStickerMaskPositionRequest $params): bool|Closure
    {
        if ($params instanceof SetStickerMaskPositionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setStickerMaskPosition', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setStickerSetTitle(array|SetStickerSetTitleRequest $params): bool|Closure
    {
        if ($params instanceof SetStickerSetTitleRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setStickerSetTitle', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setStickerSetThumbnail(array|SetStickerSetThumbnailRequest $params): bool|Closure
    {
        if ($params instanceof SetStickerSetThumbnailRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $parser = function (TelegramResponse $response) {
            return $response->getResult();
        };

        return $this->uploadFile('setStickerSetThumbnail', $params, ['thumbnail'], $parser);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setCustomEmojiStickerSetThumbnail(array|SetCustomEmojiStickerSetThumbnailRequest $params): bool|Closure
    {
        if ($params instanceof SetCustomEmojiStickerSetThumbnailRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setCustomEmojiStickerSetThumbnail', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function deleteStickerSet(array|DeleteStickerSetRequest $params): bool|Closure
    {
        if ($params instanceof DeleteStickerSetRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('deleteStickerSet', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function approveSuggestedPost(array|ApproveSuggestedPostRequest $params): bool|Closure
    {
        if ($params instanceof ApproveSuggestedPostRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('approveSuggestedPost', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function declineSuggestedPost(array|DeclineSuggestedPostRequest $params): bool|Closure
    {
        if ($params instanceof DeclineSuggestedPostRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('declineSuggestedPost', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function answerInlineQuery(array|AnswerInlineQueryRequest $params = []): bool|Closure
    {
        if ($params instanceof AnswerInlineQueryRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        if (isset($params['results']) && is_array($params['results'])) {
            $params['results'] = json_encode($params['results']);
        }

        $response = $this->post('answerInlineQuery', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function answerWebAppQuery(array|AnswerWebAppQueryRequest $params): \Telegram\Bot\Objects\SentWebAppMessage
    {
        if ($params instanceof AnswerWebAppQueryRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('answerWebAppQuery', $params);

        return new \Telegram\Bot\Objects\SentWebAppMessage($response->getDecodedBody());
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function savePreparedInlineMessage(array|SavePreparedInlineMessageRequest $params): \Telegram\Bot\Objects\PreparedInlineMessage|Closure
    {
        if ($params instanceof SavePreparedInlineMessageRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new \Telegram\Bot\Objects\PreparedInlineMessage($response->getResult());
        }, $this->post('savePreparedInlineMessage', $params));
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function sendInvoice(array|SendInvoiceRequest $params): Message|Closure
    {
        if ($params instanceof SendInvoiceRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getResult());
        }, $this->post('sendInvoice', $params));
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function createInvoiceLink(array|CreateInvoiceLinkRequest $params): string|Closure
    {
        if ($params instanceof CreateInvoiceLinkRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('createInvoiceLink', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function answerShippingQuery(array|AnswerShippingQueryRequest $params): bool|Closure
    {
        if ($params instanceof AnswerShippingQueryRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('answerShippingQuery', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getRequest();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function answerPreCheckoutQuery(array|AnswerPreCheckoutQueryRequest $params): bool|Closure
    {
        if ($params instanceof AnswerPreCheckoutQueryRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('answerPreCheckoutQuery', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getRequest();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function refundStarPayment(array|RefundStarPaymentRequest $params): bool|Closure
    {
        if ($params instanceof RefundStarPaymentRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('refundStarPayment', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function sendGame(array|SendGameRequest $params): Message|Closure
    {
        if ($params instanceof SendGameRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Message($response->getResult());
        }, $this->post('sendGame', $params));
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setGameScore(array|SetGameScoreRequest $params): Message|bool|Closure
    {
        if ($params instanceof SetGameScoreRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setGameScore', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            $result = $response->getResult();

            if (is_bool($result)) {
                return $result;
            }

            return new Message($result);
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getGameHighScores(array|GetGameHighScoresRequest $params): array|Closure
    {
        if ($params instanceof GetGameHighScoresRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('getGameHighScores', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            $body = $response->getDecodedBody();
            $scores = [];

            foreach ($body['result'] as $score) {
                $scores[] = new GameHighScore($score);
            }

            return $scores;
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function setPassportDataErrors(array|SetPassportDataErrorsRequest $params): bool|Closure
    {
        if ($params instanceof SetPassportDataErrorsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('setPassportDataErrors', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getMyStarBalance(array|GetMyStarBalanceRequest $params = []): Collection|Closure
    {
        if ($params instanceof GetMyStarBalanceRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new Collection($response->getResult());
        }, $this->post('getMyStarBalance', $params));
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function getStarTransactions(array|GetStarTransactionsRequest $params = []): BotCommand|Closure
    {
        if ($params instanceof GetStarTransactionsRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new BotCommand($response->getResult()); // Update: Return type probably Transaction objects list or specific object
        }, $this->post('getStarTransactions', $params));
    }

    /**
     * @throws TelegramSDKException
     * @throws TelegramValidationException
     */
    public function editUserStarSubscription(array|EditUserStarSubscriptionRequest $params): bool|Closure
    {
        if ($params instanceof EditUserStarSubscriptionRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        $response = $this->post('editUserStarSubscription', $params);

        return $this->prepareResponse(function (TelegramResponse $response) {
            return $response->getResult();
        }, $response);
    }

    /**
     * @throws TelegramSDKException
     */
    public function getMe(array|GetMeRequest $params = []): User|Closure
    {
        if ($params instanceof GetMeRequest) {
            $params->validate();
            $params = $params->toArray();
        }

        return $this->prepareResponse(function (TelegramResponse $response) {
            return new User($response->getResult());
        }, $this->post('getMe', $params));
    }

    /**
     * Extract attachments from InputSticker objects.
     *
     * @throws TelegramSDKException
     */
    protected function extractInputStickers(array &$params): array
    {
        $attachments = [];

        if (isset($params['stickers']) && is_array($params['stickers'])) {
            foreach ($params['stickers'] as $key => $sticker) {
                if ($sticker instanceof InputSticker) {
                    $part = $sticker->extractAttachment('__ATTACHED_FILE__'.$key);
                    $params['stickers'][$key] = $sticker->toArray();
                    if ($part) {
                        $attachments[] = $part;
                    }
                }
            }
            $params['stickers'] = json_encode($params['stickers']);
        }

        if (isset($params['sticker']) && $params['sticker'] instanceof InputSticker) {
            $sticker = $params['sticker'];
            $part = $sticker->extractAttachment('__ATTACHED_FILE__');
            $params['sticker'] = json_encode($sticker->toArray());
            if ($part) {
                $attachments[] = $part;
            }
        }

        return $attachments;
    }
}
