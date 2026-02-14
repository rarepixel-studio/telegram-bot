# Telegram Bot API Type Groups

This document groups Bot API types by how they are used so SDK code can model them consistently.
Lists are derived from `doc/telegram-bot-api.md`.

## Request-only types (sent to Telegram)

These are objects you send as JSON-serialized parameters or as multipart uploads. They are
not returned by Telegram.

### Input* objects (request-only)

- InputPollOption
- InputChecklistTask
- InputChecklist
- InputMedia
- InputMediaAnimation
- InputMediaDocument
- InputMediaAudio
- InputMediaPhoto
- InputMediaVideo
- InputFile
- InputPaidMedia
- InputPaidMediaPhoto
- InputPaidMediaVideo
- InputProfilePhoto
- InputProfilePhotoStatic
- InputProfilePhotoAnimated
- InputStoryContent
- InputStoryContentPhoto
- InputStoryContentVideo
- InputSticker
- InputMessageContent
- InputTextMessageContent
- InputLocationMessageContent
- InputVenueMessageContent
- InputContactMessageContent
- InputInvoiceMessageContent

Note: `InputFile` is not a JSON object. It represents a file uploaded via `multipart/form-data`.

### Inline query results (request-only)

- InlineQueryResultsButton
- InlineQueryResult
- InlineQueryResultCachedAudio
- InlineQueryResultCachedDocument
- InlineQueryResultCachedGif
- InlineQueryResultCachedMpeg4Gif
- InlineQueryResultCachedPhoto
- InlineQueryResultCachedSticker
- InlineQueryResultCachedVideo
- InlineQueryResultCachedVoice
- InlineQueryResultArticle
- InlineQueryResultAudio
- InlineQueryResultContact
- InlineQueryResultGame
- InlineQueryResultDocument
- InlineQueryResultGif
- InlineQueryResultLocation
- InlineQueryResultMpeg4Gif
- InlineQueryResultPhoto
- InlineQueryResultVenue
- InlineQueryResultVideo
- InlineQueryResultVoice

### Reply keyboard objects (request-only)

- ReplyKeyboardMarkup
- ReplyKeyboardRemove
- ForceReply
- KeyboardButton
- KeyboardButtonRequestUsers
- KeyboardButtonRequestChat
- KeyboardButtonPollType

### Bot command scope objects (request-only)

- BotCommandScope
- BotCommandScopeDefault
- BotCommandScopeAllPrivateChats
- BotCommandScopeAllGroupChats
- BotCommandScopeAllChatAdministrators
- BotCommandScopeChat
- BotCommandScopeChatAdministrators
- BotCommandScopeChatMember

### Passport error objects (request-only)

- PassportElementError
- PassportElementErrorDataField
- PassportElementErrorFrontSide
- PassportElementErrorReverseSide
- PassportElementErrorSelfie
- PassportElementErrorFile
- PassportElementErrorFiles
- PassportElementErrorTranslationFile
- PassportElementErrorTranslationFiles
- PassportElementErrorUnspecified

## Response and dual-use types (returned by Telegram)

These are objects you receive in updates or method results. Some of these are also accepted
as request parameters (dual-use).

- Update
- WebhookInfo
- User
- Chat
- ChatFullInfo
- Message
- MessageId
- InaccessibleMessage
- MaybeInaccessibleMessage
- MessageEntity
- TextQuote
- ExternalReplyInfo
- ReplyParameters
- MessageOrigin
- MessageOriginUser
- MessageOriginHiddenUser
- MessageOriginChat
- MessageOriginChannel
- PhotoSize
- Animation
- Audio
- Document
- Story
- Video
- VideoNote
- Voice
- PaidMediaInfo
- PaidMedia
- PaidMediaPreview
- PaidMediaPhoto
- PaidMediaVideo
- Contact
- Dice
- PollOption
- PollAnswer
- Poll
- ChecklistTask
- Checklist
- ChecklistTasksDone
- ChecklistTasksAdded
- Location
- Venue
- WebAppData
- ProximityAlertTriggered
- MessageAutoDeleteTimerChanged
- ChatBoostAdded
- BackgroundFill
- BackgroundFillSolid
- BackgroundFillGradient
- BackgroundFillFreeformGradient
- BackgroundType
- BackgroundTypeFill
- BackgroundTypeWallpaper
- BackgroundTypePattern
- BackgroundTypeChatTheme
- ChatBackground
- ForumTopicCreated
- ForumTopicClosed
- ForumTopicEdited
- ForumTopicReopened
- GeneralForumTopicHidden
- GeneralForumTopicUnhidden
- SharedUser
- UsersShared
- ChatShared
- WriteAccessAllowed
- VideoChatScheduled
- VideoChatStarted
- VideoChatEnded
- VideoChatParticipantsInvited
- ChatOwnerLeft
- ChatOwnerChanged
- PaidMessagePriceChanged
- DirectMessagePriceChanged
- SuggestedPostApproved
- SuggestedPostApprovalFailed
- SuggestedPostDeclined
- SuggestedPostPaid
- SuggestedPostRefunded
- GiveawayCreated
- Giveaway
- GiveawayWinners
- GiveawayCompleted
- LinkPreviewOptions
- SuggestedPostPrice
- SuggestedPostInfo
- SuggestedPostParameters
- DirectMessagesTopic
- UserProfilePhotos
- UserProfileAudios
- VideoQuality
- File
- WebAppInfo
- InlineKeyboardMarkup
- InlineKeyboardButton
- LoginUrl
- SwitchInlineQueryChosenChat
- CopyTextButton
- CallbackQuery
- ChatPhoto
- ChatInviteLink
- ChatAdministratorRights
- ChatMemberUpdated
- ChatMember
- ChatMemberOwner
- ChatMemberAdministrator
- ChatMemberMember
- ChatMemberRestricted
- ChatMemberLeft
- ChatMemberBanned
- ChatJoinRequest
- ChatPermissions
- Birthdate
- BusinessIntro
- BusinessLocation
- BusinessOpeningHoursInterval
- BusinessOpeningHours
- StoryAreaPosition
- LocationAddress
- StoryAreaType
- StoryAreaTypeLocation
- StoryAreaTypeSuggestedReaction
- StoryAreaTypeLink
- StoryAreaTypeWeather
- StoryAreaTypeUniqueGift
- StoryArea
- ChatLocation
- ReactionType
- ReactionTypeEmoji
- ReactionTypeCustomEmoji
- ReactionTypePaid
- ReactionCount
- MessageReactionUpdated
- MessageReactionCountUpdated
- ForumTopic
- Gift
- Gifts
- UniqueGiftModel
- UniqueGiftSymbol
- UniqueGiftBackdropColors
- UniqueGiftBackdrop
- UniqueGift
- GiftInfo
- UniqueGiftInfo
- OwnedGift
- OwnedGiftRegular
- OwnedGiftUnique
- OwnedGifts
- AcceptedGiftTypes
- StarAmount
- BotCommand
- BotName
- BotDescription
- BotShortDescription
- MenuButton
- MenuButtonCommands
- MenuButtonWebApp
- MenuButtonDefault
- ChatBoostSource
- ChatBoostSourcePremium
- ChatBoostSourceGiftCode
- ChatBoostSourceGiveaway
- ChatBoost
- ChatBoostUpdated
- ChatBoostRemoved
- UserChatBoosts
- BusinessBotRights
- BusinessConnection
- BusinessMessagesDeleted
- ResponseParameters
- Sticker
- StickerSet
- MaskPosition
- InlineQuery
- ChosenInlineResult
- SentWebAppMessage
- PreparedInlineMessage
- LabeledPrice
- Invoice
- ShippingAddress
- OrderInfo
- ShippingOption
- SuccessfulPayment
- RefundedPayment
- ShippingQuery
- PreCheckoutQuery
- PaidMediaPurchased
- RevenueWithdrawalState
- RevenueWithdrawalStatePending
- RevenueWithdrawalStateSucceeded
- RevenueWithdrawalStateFailed
- AffiliateInfo
- TransactionPartner
- TransactionPartnerUser
- TransactionPartnerChat
- TransactionPartnerAffiliateProgram
- TransactionPartnerFragment
- TransactionPartnerTelegramAds
- TransactionPartnerTelegramApi
- TransactionPartnerOther
- StarTransaction
- StarTransactions
- PassportData
- PassportFile
- EncryptedPassportElement
- EncryptedCredentials
- Game
- CallbackGame
- GameHighScore

## Dual-use notes

Some response types are also valid request parameters. Common examples include:
MessageEntity, ChatPermissions, BotCommand, ReactionType, InlineKeyboardMarkup,
InlineKeyboardButton, LinkPreviewOptions, and ChatAdministratorRights.

## Quick classification checklist

1) Name starts with `Input*` -> request-only.
2) Description says "to be sent" or "A JSON-serialized object for ..." -> likely request-only.
3) Appears in update payloads or method results -> response (or dual-use if also used as input).
