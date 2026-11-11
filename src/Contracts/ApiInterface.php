<?php

namespace Telegram\Bot\Contracts;

use Closure;
use Illuminate\Support\Collection;
use Telegram\Bot\Objects\BotAccessSettings;
use Telegram\Bot\Objects\BotDescription;
use Telegram\Bot\Objects\BotName;
use Telegram\Bot\Objects\BotShortDescription;
use Telegram\Bot\Objects\Chat;
use Telegram\Bot\Objects\ChatMember;
use Telegram\Bot\Objects\ChatShareThemeBackdrops;
use Telegram\Bot\Objects\File;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\MessageId;
use Telegram\Bot\Objects\Poll;
use Telegram\Bot\Objects\SentGuestMessage;
use Telegram\Bot\Objects\SentWebAppMessage;
use Telegram\Bot\Objects\StickerSet;
use Telegram\Bot\Objects\UniqueGift;
use Telegram\Bot\Objects\UnknownObject;
use Telegram\Bot\Objects\Update;
use Telegram\Bot\Objects\User;
use Telegram\Bot\Objects\UserProfilePhotos;
use Telegram\Bot\Objects\WebhookInfo;
use Telegram\Bot\Requests\AnswerChatJoinRequestQueryRequest;
use Telegram\Bot\Requests\AnswerGuestQueryRequest;
use Telegram\Bot\Requests\AnswerWidgetQueryRequest;
use Telegram\Bot\Requests\DeleteAllMessageReactionsRequest;
use Telegram\Bot\Requests\DeleteBusinessAccountGiftRequest;
use Telegram\Bot\Requests\DeleteEphemeralMessageRequest;
use Telegram\Bot\Requests\DeleteMessageReactionRequest;
use Telegram\Bot\Requests\DeleteMyCommandsRequest;
use Telegram\Bot\Requests\EditEphemeralMessageCaptionRequest;
use Telegram\Bot\Requests\EditEphemeralMessageMediaRequest;
use Telegram\Bot\Requests\EditEphemeralMessageReplyMarkupRequest;
use Telegram\Bot\Requests\EditEphemeralMessageTextRequest;
use Telegram\Bot\Requests\EditMessageTextRequest;
use Telegram\Bot\Requests\EditMessageWidgetDataRequest;
use Telegram\Bot\Requests\EditSharedWidgetDataRequest;
use Telegram\Bot\Requests\GetChatShareThemeBackdropsRequest;
use Telegram\Bot\Requests\GetManagedBotAccessSettingsRequest;
use Telegram\Bot\Requests\GetMyCommandsRequest;
use Telegram\Bot\Requests\GetMyDescriptionRequest;
use Telegram\Bot\Requests\GetMyNameRequest;
use Telegram\Bot\Requests\GetMyShortDescriptionRequest;
use Telegram\Bot\Requests\GetUniqueGiftRequest;
use Telegram\Bot\Requests\GetUserPersonalChatMessagesRequest;
use Telegram\Bot\Requests\SendChatJoinRequestWebAppRequest;
use Telegram\Bot\Requests\SendLivePhotoRequest;
use Telegram\Bot\Requests\SendRichMessageDraftRequest;
use Telegram\Bot\Requests\SendRichMessageRequest;
use Telegram\Bot\Requests\SendSharedWidgetRequest;
use Telegram\Bot\Requests\SendWidgetRequest;
use Telegram\Bot\Requests\SetManagedBotAccessSettingsRequest;
use Telegram\Bot\Requests\SetMyCommandsRequest;
use Telegram\Bot\Requests\SetMyDescriptionRequest;
use Telegram\Bot\Requests\SetMyNameRequest;
use Telegram\Bot\Requests\SetMyShortDescriptionRequest;
use Telegram\Bot\TelegramResponse;

/**
 * Interface ApiInterface.
 *
 * Contract for Telegram Bot API implementations.
 */
interface ApiInterface
{
    // Core methods
    public function getClient(): ClientInterface;

    public function getAccessToken(): string;

    public function getLastResponse(): ?TelegramResponse;

    public function setAccessToken(string $accessToken): self;

    public function asyncWait(): array;

    public function setAsyncRequest(bool $isAsyncRequest): self;

    public function isAsyncRequest(): bool;

    // Request object entry point
    public function handleRequest(ApiRequestInterface $request): mixed;

    public function getMe(): User|Closure;

    public function logOut(): bool|Closure;

    public function close(): bool|Closure;

    // Message methods
    public function sendMessage(array $params): Message|Closure;

    public function sendRichMessage(array|SendRichMessageRequest $params): Message|Closure;

    public function sendRichMessageDraft(array|SendRichMessageDraftRequest $params): bool|Closure;

    public function forwardMessage(array $params): Message|Closure;

    public function forwardMessages(array $params): Collection|Closure;

    public function copyMessage(array $params): MessageId|Closure;

    public function sendPhoto(array $params): Message|Closure;

    public function sendLivePhoto(array|SendLivePhotoRequest $params): Message|Closure;

    public function sendAudio(array $params): Message|Closure;

    public function sendDocument(array $params): Message|Closure;

    public function sendSticker(array $params): Message|Closure;

    public function sendVideo(array $params): Message|Closure;

    public function sendAnimation(array $params): Message|Closure;

    public function sendVoice(array $params): Message|Closure;

    public function sendVideoNote(array $params): Message|Closure;

    public function sendPaidMedia(array $params): Message|Closure;

    public function sendMediaGroup(array $params): Collection|Closure;

    public function sendLocation(array $params): Message|Closure;

    public function editMessageLiveLocation(array $params): Message|bool|Closure;

    public function stopMessageLiveLocation(array $params): Message|bool|Closure;

    public function sendVenue(array $params): Message|Closure;

    public function sendContact(array $params): Message|Closure;

    public function sendPoll(array $params): Message|Closure;

    public function stopPoll(array $params): Poll|Closure;

    public function sendChatAction(array $params): bool|Closure;

    public function editMessageText(array|EditMessageTextRequest $params): Message|bool|Closure;

    public function editMessageCaption(array $params): Message|Closure;

    public function editMessageMedia(array $params): bool|Closure;

    public function editMessageReplyMarkup(array $params): Message|Closure;

    public function editEphemeralMessageText(array|EditEphemeralMessageTextRequest $params): bool|Closure;

    public function editEphemeralMessageCaption(array|EditEphemeralMessageCaptionRequest $params): bool|Closure;

    public function editEphemeralMessageMedia(array|EditEphemeralMessageMediaRequest $params): bool|Closure;

    public function editEphemeralMessageReplyMarkup(array|EditEphemeralMessageReplyMarkupRequest $params): bool|Closure;

    public function deleteMessage(array $params): bool|Closure;

    public function deleteEphemeralMessage(array|DeleteEphemeralMessageRequest $params): bool|Closure;

    public function deleteMessageReaction(array|DeleteMessageReactionRequest $params): bool|Closure;

    public function deleteAllMessageReactions(array|DeleteAllMessageReactionsRequest $params): bool|Closure;

    public function sendDice(array $params): Message;

    public function setMessageReaction(array $params): bool;

    // Chat methods
    public function kickChatMember(array $params): bool|Closure;

    public function leaveChat(array $params): bool|Closure;

    public function unbanChatMember(array $params): bool|Closure;

    public function restrictChatMember(array $params): bool|Closure;

    public function promoteChatMember(array $params): bool|Closure;

    public function exportChatInviteLink(array $params): string|Closure;

    public function setChatPhoto(array $params): bool|Closure;

    public function deleteChatPhoto(array $params): bool|Closure;

    public function setChatTitle(array $params): bool|Closure;

    public function setChatDescription(array $params): bool|Closure;

    public function pinChatMessage(array $params): bool|Closure;

    public function unpinChatMessage(array $params): mixed;

    public function getChat(array $params): Chat|Closure;

    public function getChatAdministrators(array $params): array|Closure;

    public function getChatMembersCount(array $params): int|Closure;

    public function getChatMember(array $params): ChatMember|Closure;

    public function getUserPersonalChatMessages(array|GetUserPersonalChatMessagesRequest $params): Collection|Closure;

    public function setChatStickerSet(array $params): bool|Closure;

    public function deleteChatStickerSet(array $params): bool|Closure;

    // Update and webhook methods
    public function getWebhookInfo(): WebhookInfo|Closure;

    public function setWebhook(array $params): bool|Closure;

    public function getWebhookUpdate(): Update;

    public function getWebhookUpdates(): Update;

    public function removeWebhook(): bool|Closure;

    public function deleteWebhook(): bool|Closure;

    public function getUpdates(array $params = []): Collection|Closure;

    // File methods
    public function getUserProfilePhotos(array $params): UserProfilePhotos|Closure;

    public function getFile(array $params): File|Closure;

    // Sticker methods
    public function getStickerSet(array $params): StickerSet|Closure;

    public function uploadStickerFile(array $params): File|Closure;

    public function createNewStickerSet(array $params): bool|Closure;

    public function addStickerToSet(array $params): bool|Closure;

    public function setStickerPositionInSet(array $params): bool|Closure;

    public function deleteStickerFromSet(array $params): bool|Closure;

    // Inline query methods
    public function answerCallbackQuery(array $params): bool|Closure;

    public function answerGuestQuery(array|AnswerGuestQueryRequest $params): SentGuestMessage|Closure;

    public function answerChatJoinRequestQuery(array|AnswerChatJoinRequestQueryRequest $params): bool|Closure;

    public function sendChatJoinRequestWebApp(array|SendChatJoinRequestWebAppRequest $params): bool|Closure;

    public function answerInlineQuery(array $params = []): bool|Closure;

    // Game methods
    public function sendGame(array $params): Message|Closure;

    public function setGameScore(array $params): Message|bool|Closure;

    public function getGameHighScores(array $params): array|Closure;

    // Payment methods
    public function sendInvoice(array $params): Message|Closure;

    public function answerShippingQuery(array $params): bool|Closure;

    public function answerPreCheckoutQuery(array $params): bool|Closure;

    // Bot configuration methods
    public function setMyCommands(array|SetMyCommandsRequest $params): bool|Closure;

    public function getMyCommands(array|GetMyCommandsRequest $params = []): array|Closure;

    public function deleteMyCommands(array|DeleteMyCommandsRequest $params = []): bool|Closure;

    public function setMyName(array|SetMyNameRequest $params = []): bool|Closure;

    public function getMyName(array|GetMyNameRequest $params = []): BotName|Closure;

    public function setMyDescription(array|SetMyDescriptionRequest $params = []): bool|Closure;

    public function getMyDescription(array|GetMyDescriptionRequest $params = []): BotDescription|Closure;

    public function setMyShortDescription(array|SetMyShortDescriptionRequest $params = []): bool|Closure;

    public function getMyShortDescription(array|GetMyShortDescriptionRequest $params = []): BotShortDescription|Closure;

    public function getManagedBotAccessSettings(array|GetManagedBotAccessSettingsRequest $params): BotAccessSettings|Closure;

    public function setManagedBotAccessSettings(array|SetManagedBotAccessSettingsRequest $params): bool|Closure;

    public function answerWebAppQuery(array $params): SentWebAppMessage;

    // Magic method
    public function __call(string $method, array $arguments): bool|TelegramResponse|UnknownObject;

    // Configuration methods
    public function getTimeOut(): int;

    public function setTimeOut(int $timeOut): self;

    public function getConnectTimeOut(): int;

    public function setConnectTimeOut(int $connectTimeOut): self;

    public function onSending(?Closure $onSending = null): self;

    public function onFulfilled(?Closure $onFulfilled = null): self;

    public function onRejected(?Closure $onRejected = null): self;

    /**
     * Send a message containing an HTML widget.
     *
     * @param  array<string, mixed>|SendWidgetRequest  $params  Telegram request parameters
     * @return Message|Closure The Telegram result or the async response resolver
     *
     * @link https://core.telegram.org/bots/api#sendwidget
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     * @throws \Telegram\Bot\Exceptions\TelegramValidationException
     */
    public function sendWidget(array|SendWidgetRequest $params): Message|Closure;

    /**
     * Send an existing shared widget created by the bot.
     *
     * @param  array<string, mixed>|SendSharedWidgetRequest  $params  Telegram request parameters
     * @return Message|Closure The Telegram result or the async response resolver
     *
     * @link https://core.telegram.org/bots/api#sendsharedwidget
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     * @throws \Telegram\Bot\Exceptions\TelegramValidationException
     */
    public function sendSharedWidget(array|SendSharedWidgetRequest $params): Message|Closure;

    /**
     * Answer a query from a widget.
     *
     * @param  array<string, mixed>|AnswerWidgetQueryRequest  $params  Telegram request parameters
     * @return bool|Closure The Telegram result or the async response resolver
     *
     * @link https://core.telegram.org/bots/api#answerwidgetquery
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     * @throws \Telegram\Bot\Exceptions\TelegramValidationException
     */
    public function answerWidgetQuery(array|AnswerWidgetQueryRequest $params): bool|Closure;

    /**
     * Edit the data of a widget in a message.
     *
     * @param  array<string, mixed>|EditMessageWidgetDataRequest  $params  Telegram request parameters
     * @return bool|Closure The Telegram result or the async response resolver
     *
     * @link https://core.telegram.org/bots/api#editmessagewidgetdata
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     * @throws \Telegram\Bot\Exceptions\TelegramValidationException
     */
    public function editMessageWidgetData(array|EditMessageWidgetDataRequest $params): bool|Closure;

    /**
     * Edit the public data of a shared widget.
     *
     * @param  array<string, mixed>|EditSharedWidgetDataRequest  $params  Telegram request parameters
     * @return bool|Closure The Telegram result or the async response resolver
     *
     * @link https://core.telegram.org/bots/api#editsharedwidgetdata
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     * @throws \Telegram\Bot\Exceptions\TelegramValidationException
     */
    public function editSharedWidgetData(array|EditSharedWidgetDataRequest $params): bool|Closure;

    /**
     * Get the available backdrops for chat share themes.
     *
     * @param  array<string, mixed>|GetChatShareThemeBackdropsRequest  $params  Telegram request parameters
     * @return ChatShareThemeBackdrops|Closure The Telegram result or the async response resolver
     *
     * @link https://core.telegram.org/bots/api#getchatsharethemebackdrops
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     * @throws \Telegram\Bot\Exceptions\TelegramValidationException
     */
    public function getChatShareThemeBackdrops(array|GetChatShareThemeBackdropsRequest $params = []): ChatShareThemeBackdrops|Closure;

    /**
     * Get a unique gift by its name.
     *
     * @param  array<string, mixed>|GetUniqueGiftRequest  $params  Telegram request parameters
     * @return UniqueGift|Closure The Telegram result or the async response resolver
     *
     * @link https://core.telegram.org/bots/api#getuniquegift
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     * @throws \Telegram\Bot\Exceptions\TelegramValidationException
     */
    public function getUniqueGift(array|GetUniqueGiftRequest $params): UniqueGift|Closure;

    /**
     * Delete a regular gift owned by a managed business account.
     *
     * @param  array<string, mixed>|DeleteBusinessAccountGiftRequest  $params  Telegram request parameters
     * @return bool|Closure The Telegram result or the async response resolver
     *
     * @link https://core.telegram.org/bots/api#deletebusinessaccountgift
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     * @throws \Telegram\Bot\Exceptions\TelegramValidationException
     */
    public function deleteBusinessAccountGift(array|DeleteBusinessAccountGiftRequest $params): bool|Closure;
}
