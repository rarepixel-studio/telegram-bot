## Objects

### User
- id (Integer, Required): Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
- is_bot (Boolean, Required): True, if this user is a bot
- first_name (String, Required): User's or bot's first name
- last_name (String, Optional): Optional. User's or bot's last name
- username (String, Optional): Optional. User's or bot's username
- language_code (String, Optional): Optional. IETF language tag of the user's language
- is_premium (Boolean, Optional): Optional. True, if this user is a Telegram Premium user
- added_to_attachment_menu (Boolean, Optional): Optional. True, if this user added the bot to the attachment menu
- can_join_groups (Boolean, Optional): Optional. True, if the bot can be invited to groups. Returned only in getMe.
- can_read_all_group_messages (Boolean, Optional): Optional. True, if privacy mode is disabled for the bot. Returned only in getMe.
- supports_guest_queries (Boolean, Optional): Optional. True, if the bot supports guest queries from chats it is not a member of. Returned only in getMe.
- supports_inline_queries (Boolean, Optional): Optional. True, if the bot supports inline queries. Returned only in getMe.
- can_connect_to_business (Boolean, Optional): Optional. True, if the bot can be connected to a user account to manage it. Returned only in getMe.
- has_main_web_app (Boolean, Optional): Optional. True, if the bot has a main Web App. Returned only in getMe.
- has_topics_enabled (Boolean, Optional): Optional. True, if the bot has forum topic mode enabled in private chats. Returned only in getMe.
- allows_users_to_create_topics (Boolean, Optional): Optional. True, if the bot allows users to create and delete topics in private chats. Returned only in getMe.
- can_manage_bots (Boolean, Optional): Optional. True, if other bots can be created to be controlled by the bot. Returned only in getMe.

### Message
- message_id (Integer, Required): Unique message identifier inside this chat. In specific instances (e.g., message containing a video sent to a big chat), the server might automatically schedule a message instead of sending it immediately. In such cases, this field will be 0 and the relevant message will be unusable until it is actually sent
- message_thread_id (Integer, Optional): Optional. Unique identifier of a message thread or forum topic to which the message belongs; for supergroups and private chats only
- direct_messages_topic (DirectMessagesTopic, Optional): Optional. Information about the direct messages chat topic that contains the message
- from (User, Optional): Optional. Sender of the message; may be empty for messages sent to channels. For backward compatibility, if the message was sent on behalf of a chat, the field contains a fake sender user in non-channel chats
- sender_chat (Chat, Optional): Optional. Sender of the message when sent on behalf of a chat. For example, the supergroup itself for messages sent by its anonymous administrators or a linked channel for messages automatically forwarded to the channel's discussion group. For backward compatibility, if the message was sent on behalf of a chat, the field from contains a fake sender user in non-channel chats.
- sender_boost_count (Integer, Optional): Optional. If the sender of the message boosted the chat, the number of boosts added by the user
- sender_business_bot (User, Optional): Optional. The bot that actually sent the message on behalf of the business account. Available only for outgoing messages sent on behalf of the connected business account.
- sender_tag (String, Optional): Optional. Tag or custom title of the sender of the message; for supergroups only
- date (Integer, Required): Date the message was sent in Unix time. It is always a positive number, representing a valid date.
- guest_query_id (String, Optional): Optional. The unique identifier for the guest query. Use this identifier with the method answerGuestQuery to send a response message. If non-empty, the message belongs to the chat where the guest bot was summoned, which may not coincide with other existing bot chats sharing the same identifier.
- business_connection_id (String, Optional): Optional. Unique identifier of the business connection from which the message was received. If non-empty, the message belongs to a chat of the corresponding business account that is independent from any potential bot chat which might share the same identifier.
- chat (Chat, Required): Chat the message belongs to
- forward_origin (MessageOrigin, Optional): Optional. Information about the original message for forwarded messages
- is_topic_message (Boolean, Optional): Optional. True, if the message is sent to a topic in a forum supergroup or a private chat with the bot
- is_automatic_forward (Boolean, Optional): Optional. True, if the message is a channel post that was automatically forwarded to the connected discussion group
- reply_to_message (Message, Optional): Optional. For replies in the same chat and message thread, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
- external_reply (ExternalReplyInfo, Optional): Optional. Information about the message that is being replied to, which may come from another chat or forum topic
- quote (TextQuote, Optional): Optional. For replies that quote part of the original message, the quoted part of the message
- reply_to_story (Story, Optional): Optional. For replies to a story, the original story
- reply_to_checklist_task_id (Integer, Optional): Optional. Identifier of the specific checklist task that is being replied to
- reply_to_poll_option_id (String, Optional): Optional. Persistent identifier of the specific poll option that is being replied to
- via_bot (User, Optional): Optional. Bot through which the message was sent
- guest_bot_caller_user (User, Optional): Optional. For a message sent by a guest bot, this is the user whose original message triggered the bot's response
- guest_bot_caller_chat (Chat, Optional): Optional. For a message sent by a guest bot, this is the chat whose original message triggered the bot's response
- edit_date (Integer, Optional): Optional. Date the message was last edited in Unix time
- has_protected_content (Boolean, Optional): Optional. True, if the message can't be forwarded
- is_from_offline (Boolean, Optional): Optional. True, if the message was sent by an implicit action, for example, as an away or a greeting business message, or as a scheduled message
- is_paid_post (Boolean, Optional): Optional. True, if the message is a paid post. Note that such posts must not be deleted for 24 hours to receive the payment and can't be edited.
- media_group_id (String, Optional): Optional. The unique identifier inside this chat of a media message group this message belongs to
- author_signature (String, Optional): Optional. Signature of the post author for messages in channels, or the custom title of an anonymous group administrator
- paid_star_count (Integer, Optional): Optional. The number of Telegram Stars that were paid by the sender of the message to send it
- text (String, Optional): Optional. For text messages, the actual UTF-8 text of the message
- entities (Array of MessageEntity, Optional): Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
- link_preview_options (LinkPreviewOptions, Optional): Optional. Options used for link preview generation for the message, if it is a text message and link preview options were changed
- suggested_post_info (SuggestedPostInfo, Optional): Optional. Information about suggested post parameters if the message is a suggested post in a channel direct messages chat. If the message is an approved or declined suggested post, then it can't be edited.
- effect_id (String, Optional): Optional. Unique identifier of the message effect added to the message
- animation (Animation, Optional): Optional. Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
- audio (Audio, Optional): Optional. Message is an audio file, information about the file
- document (Document, Optional): Optional. Message is a general file, information about the file
- live_photo (LivePhoto, Optional): Optional. Message is a live photo, information about the live photo. For backward compatibility, when this field is set, the photo field will also be set
- paid_media (PaidMediaInfo, Optional): Optional. Message contains paid media; information about the paid media
- photo (Array of PhotoSize, Optional): Optional. Message is a photo, available sizes of the photo
- sticker (Sticker, Optional): Optional. Message is a sticker, information about the sticker
- story (Story, Optional): Optional. Message is a forwarded story
- video (Video, Optional): Optional. Message is a video, information about the video
- video_note (VideoNote, Optional): Optional. Message is a video note, information about the video message
- voice (Voice, Optional): Optional. Message is a voice message, information about the file
- caption (String, Optional): Optional. Caption for the animation, audio, document, paid media, photo, video or voice
- caption_entities (Array of MessageEntity, Optional): Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
- show_caption_above_media (Boolean, Optional): Optional. True, if the caption must be shown above the message media
- has_media_spoiler (Boolean, Optional): Optional. True, if the message media is covered by a spoiler animation
- checklist (Checklist, Optional): Optional. Message is a checklist
- contact (Contact, Optional): Optional. Message is a shared contact, information about the contact
- dice (Dice, Optional): Optional. Message is a dice with random value
- game (Game, Optional): Optional. Message is a game, information about the game. More about games: https://core.telegram.org/bots/api#games
- poll (Poll, Optional): Optional. Message is a native poll, information about the poll
- venue (Venue, Optional): Optional. Message is a venue, information about the venue. For backward compatibility, when this field is set, the location field will also be set
- location (Location, Optional): Optional. Message is a shared location, information about the location
- new_chat_members (Array of User, Optional): Optional. New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
- left_chat_member (User, Optional): Optional. A member was removed from the group, information about them (this member may be the bot itself)
- chat_owner_left (ChatOwnerLeft, Optional): Optional. Service message: chat owner has left
- chat_owner_changed (ChatOwnerChanged, Optional): Optional. Service message: chat owner has changed
- new_chat_title (String, Optional): Optional. A chat title was changed to this value
- new_chat_photo (Array of PhotoSize, Optional): Optional. A chat photo was change to this value
- delete_chat_photo (Boolean, Optional): Optional. Service message: the chat photo was deleted
- group_chat_created (Boolean, Optional): Optional. Service message: the group has been created
- supergroup_chat_created (Boolean, Optional): Optional. Service message: the supergroup has been created. This field can't be received in a message coming through updates, because bot can't be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup.
- channel_chat_created (Boolean, Optional): Optional. Service message: the channel has been created. This field can't be received in a message coming through updates, because bot can't be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel.
- message_auto_delete_timer_changed (MessageAutoDeleteTimerChanged, Optional): Optional. Service message: auto-delete timer settings changed in the chat
- migrate_to_chat_id (Integer, Optional): Optional. The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
- migrate_from_chat_id (Integer, Optional): Optional. The supergroup has been migrated from a group with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
- pinned_message (MaybeInaccessibleMessage, Optional): Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
- invoice (Invoice, Optional): Optional. Message is an invoice for a payment, information about the invoice. More about payments: https://core.telegram.org/bots/api#payments
- successful_payment (SuccessfulPayment, Optional): Optional. Message is a service message about a successful payment, information about the payment. More about payments: https://core.telegram.org/bots/api#payments
- refunded_payment (RefundedPayment, Optional): Optional. Message is a service message about a refunded payment, information about the payment. More about payments: https://core.telegram.org/bots/api#payments
- users_shared (UsersShared, Optional): Optional. Service message: users were shared with the bot
- chat_shared (ChatShared, Optional): Optional. Service message: a chat was shared with the bot
- gift (GiftInfo, Optional): Optional. Service message: a regular gift was sent or received
- unique_gift (UniqueGiftInfo, Optional): Optional. Service message: a unique gift was sent or received
- gift_upgrade_sent (GiftInfo, Optional): Optional. Service message: upgrade of a gift was purchased after the gift was sent
- connected_website (String, Optional): Optional. The domain name of the website on which the user has logged in. More about Telegram Login: https://core.telegram.org/widgets/login
- write_access_allowed (WriteAccessAllowed, Optional): Optional. Service message: the user allowed the bot to write messages after adding it to the attachment or side menu, launching a Web App from a link, or accepting an explicit request from a Web App sent by the method requestWriteAccess
- passport_data (PassportData, Optional): Optional. Telegram Passport data
- proximity_alert_triggered (ProximityAlertTriggered, Optional): Optional. Service message. A user in the chat triggered another user's proximity alert while sharing Live Location.
- boost_added (ChatBoostAdded, Optional): Optional. Service message: user boosted the chat
- chat_background_set (ChatBackground, Optional): Optional. Service message: chat background set
- checklist_tasks_done (ChecklistTasksDone, Optional): Optional. Service message: some tasks in a checklist were marked as done or not done
- checklist_tasks_added (ChecklistTasksAdded, Optional): Optional. Service message: tasks were added to a checklist
- direct_message_price_changed (DirectMessagePriceChanged, Optional): Optional. Service message: the price for paid messages in the corresponding direct messages chat of a channel has changed
- forum_topic_created (ForumTopicCreated, Optional): Optional. Service message: forum topic created
- forum_topic_edited (ForumTopicEdited, Optional): Optional. Service message: forum topic edited
- forum_topic_closed (ForumTopicClosed, Optional): Optional. Service message: forum topic closed
- forum_topic_reopened (ForumTopicReopened, Optional): Optional. Service message: forum topic reopened
- general_forum_topic_hidden (GeneralForumTopicHidden, Optional): Optional. Service message: the 'General' forum topic hidden
- general_forum_topic_unhidden (GeneralForumTopicUnhidden, Optional): Optional. Service message: the 'General' forum topic unhidden
- giveaway_created (GiveawayCreated, Optional): Optional. Service message: a scheduled giveaway was created
- giveaway (Giveaway, Optional): Optional. The message is a scheduled giveaway message
- giveaway_winners (GiveawayWinners, Optional): Optional. A giveaway with public winners was completed
- giveaway_completed (GiveawayCompleted, Optional): Optional. Service message: a giveaway without public winners was completed
- managed_bot_created (ManagedBotCreated, Optional): Optional. Service message: user created a bot that will be managed by the current bot
- paid_message_price_changed (PaidMessagePriceChanged, Optional): Optional. Service message: the price for paid messages has changed in the chat
- poll_option_added (PollOptionAdded, Optional): Optional. Service message: answer option was added to a poll
- poll_option_deleted (PollOptionDeleted, Optional): Optional. Service message: answer option was deleted from a poll
- suggested_post_approved (SuggestedPostApproved, Optional): Optional. Service message: a suggested post was approved
- suggested_post_approval_failed (SuggestedPostApprovalFailed, Optional): Optional. Service message: approval of a suggested post has failed
- suggested_post_declined (SuggestedPostDeclined, Optional): Optional. Service message: a suggested post was declined
- suggested_post_paid (SuggestedPostPaid, Optional): Optional. Service message: payment for a suggested post was received
- suggested_post_refunded (SuggestedPostRefunded, Optional): Optional. Service message: payment for a suggested post was refunded
- video_chat_scheduled (VideoChatScheduled, Optional): Optional. Service message: video chat scheduled
- video_chat_started (VideoChatStarted, Optional): Optional. Service message: video chat started
- video_chat_ended (VideoChatEnded, Optional): Optional. Service message: video chat ended
- video_chat_participants_invited (VideoChatParticipantsInvited, Optional): Optional. Service message: new participants invited to a video chat
- web_app_data (WebAppData, Optional): Optional. Service message: data sent by a Web App
- reply_markup (InlineKeyboardMarkup, Optional): Optional. Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.

### Update
- update_id (Integer, Required): The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This identifier becomes especially handy if you're using webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
- message (Message, Optional): Optional. New incoming message of any kind - text, photo, sticker, etc.
- edited_message (Message, Optional): Optional. New version of a message that is known to the bot and was edited. This update may at times be triggered by changes to message fields that are either unavailable or not actively used by your bot.
- channel_post (Message, Optional): Optional. New incoming channel post of any kind - text, photo, sticker, etc.
- edited_channel_post (Message, Optional): Optional. New version of a channel post that is known to the bot and was edited. This update may at times be triggered by changes to message fields that are either unavailable or not actively used by your bot.
- business_connection (BusinessConnection, Optional): Optional. The bot was connected to or disconnected from a business account, or a user edited an existing connection with the bot
- business_message (Message, Optional): Optional. New message from a connected business account
- edited_business_message (Message, Optional): Optional. New version of a message from a connected business account
- deleted_business_messages (BusinessMessagesDeleted, Optional): Optional. Messages were deleted from a connected business account
- guest_message (Message, Optional): Optional. New guest message. The bot can use the field Message.guest_query_id and the method answerGuestQuery to send a message in response.
- message_reaction (MessageReactionUpdated, Optional): Optional. A reaction to a message was changed by a user. The bot must be an administrator in the chat and must explicitly specify "message_reaction" in the list of allowed_updates to receive these updates. The update isn't received for reactions set by bots.
- message_reaction_count (MessageReactionCountUpdated, Optional): Optional. Reactions to a message with anonymous reactions were changed. The bot must be an administrator in the chat and must explicitly specify "message_reaction_count" in the list of allowed_updates to receive these updates. The updates are grouped and can be sent with delay up to a few minutes.
- inline_query (InlineQuery, Optional): Optional. New incoming inline query
- chosen_inline_result (ChosenInlineResult, Optional): Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
- callback_query (CallbackQuery, Optional): Optional. New incoming callback query
- shipping_query (ShippingQuery, Optional): Optional. New incoming shipping query. Only for invoices with flexible price
- pre_checkout_query (PreCheckoutQuery, Optional): Optional. New incoming pre-checkout query. Contains full information about checkout
- purchased_paid_media (PaidMediaPurchased, Optional): Optional. A user purchased paid media with a non-empty payload sent by the bot in a non-channel chat
- poll (Poll, Optional): Optional. New poll state. Bots receive only updates about manually stopped polls and polls, which are sent by the bot
- poll_answer (PollAnswer, Optional): Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
- my_chat_member (ChatMemberUpdated, Optional): Optional. The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
- chat_member (ChatMemberUpdated, Optional): Optional. A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify "chat_member" in the list of allowed_updates to receive these updates.
- chat_join_request (ChatJoinRequest, Optional): Optional. A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates.
- chat_boost (ChatBoostUpdated, Optional): Optional. A chat boost was added or changed. The bot must be an administrator in the chat to receive these updates.
- removed_chat_boost (ChatBoostRemoved, Optional): Optional. A boost was removed from a chat. The bot must be an administrator in the chat to receive these updates.
- managed_bot (ManagedBotUpdated, Optional): Optional. A new bot was created to be managed by the bot, or token or owner of a managed bot was changed

### SentGuestMessage
- inline_message_id (String, Required): Identifier of the sent inline message

### ChatMemberRestricted
- status (String, Required): The member's status in the chat, always "restricted"
- tag (String, Optional): Optional. Tag of the member
- user (User, Required): Information about the user
- is_member (Boolean, Required): True, if the user is a member of the chat at the moment of the request
- can_send_messages (Boolean, Required): True, if the user is allowed to send text messages, contacts, giveaways, giveaway winners, invoices, locations and venues
- can_send_audios (Boolean, Required): True, if the user is allowed to send audios
- can_send_documents (Boolean, Required): True, if the user is allowed to send documents
- can_send_photos (Boolean, Required): True, if the user is allowed to send photos
- can_send_videos (Boolean, Required): True, if the user is allowed to send videos
- can_send_video_notes (Boolean, Required): True, if the user is allowed to send video notes
- can_send_voice_notes (Boolean, Required): True, if the user is allowed to send voice notes
- can_send_polls (Boolean, Required): True, if the user is allowed to send polls and checklists
- can_send_other_messages (Boolean, Required): True, if the user is allowed to send animations, games, stickers and use inline bots
- can_add_web_page_previews (Boolean, Required): True, if the user is allowed to add web page previews to their messages
- can_react_to_messages (Boolean, Required): True, if the user is allowed to react to messages
- can_edit_tag (Boolean, Required): True, if the user is allowed to edit their own tag
- can_change_info (Boolean, Required): True, if the user is allowed to change the chat title, photo and other settings
- can_invite_users (Boolean, Required): True, if the user is allowed to invite new users to the chat
- can_pin_messages (Boolean, Required): True, if the user is allowed to pin messages
- can_manage_topics (Boolean, Required): True, if the user is allowed to create forum topics
- until_date (Integer, Required): Date when restrictions will be lifted for this user; Unix time. If 0, then the user is restricted forever

### ChatPermissions
- can_send_messages (Boolean, Optional): Optional. True, if the user is allowed to send text messages, contacts, giveaways, giveaway winners, invoices, locations and venues
- can_send_audios (Boolean, Optional): Optional. True, if the user is allowed to send audios
- can_send_documents (Boolean, Optional): Optional. True, if the user is allowed to send documents
- can_send_photos (Boolean, Optional): Optional. True, if the user is allowed to send photos
- can_send_videos (Boolean, Optional): Optional. True, if the user is allowed to send videos
- can_send_video_notes (Boolean, Optional): Optional. True, if the user is allowed to send video notes
- can_send_voice_notes (Boolean, Optional): Optional. True, if the user is allowed to send voice notes
- can_send_polls (Boolean, Optional): Optional. True, if the user is allowed to send polls and checklists
- can_send_other_messages (Boolean, Optional): Optional. True, if the user is allowed to send animations, games, stickers and use inline bots
- can_add_web_page_previews (Boolean, Optional): Optional. True, if the user is allowed to add web page previews to their messages
- can_react_to_messages (Boolean, Optional): Optional. True, if the user is allowed to react to messages. If omitted, defaults to the value of can_send_messages.
- can_edit_tag (Boolean, Optional): Optional. True, if the user is allowed to edit their own tag. If omitted, defaults to the value of can_pin_messages.
- can_change_info (Boolean, Optional): Optional. True, if the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
- can_invite_users (Boolean, Optional): Optional. True, if the user is allowed to invite new users to the chat
- can_pin_messages (Boolean, Optional): Optional. True, if the user is allowed to pin messages. Ignored in public supergroups
- can_manage_topics (Boolean, Optional): Optional. True, if the user is allowed to create forum topics. If omitted defaults to the value of can_pin_messages

### InputMediaSticker
- type (String, Required): Type of the result, must be sticker
- media (String, Required): File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a .WEBP sticker from the Internet, or pass "attach://<file_attach_name>" to upload a new .WEBP, .TGS, or .WEBM sticker using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
- emoji (String, Optional): Optional. Emoji associated with the sticker; only for just uploaded stickers

### InputMediaLocation
- type (String, Required): Type of the result, must be location
- latitude (Float, Required): Latitude of the location
- longitude (Float, Required): Longitude of the location
- horizontal_accuracy (Float, Optional): Optional. The radius of uncertainty for the location, measured in meters; 0-1500

### InputMediaVenue
- type (String, Required): Type of the result, must be venue
- latitude (Float, Required): Latitude of the location
- longitude (Float, Required): Longitude of the location
- title (String, Required): Name of the venue
- address (String, Required): Address of the venue
- foursquare_id (String, Optional): Optional. Foursquare identifier of the venue
- foursquare_type (String, Optional): Optional. Foursquare type of the venue, if known. (For example, "arts_entertainment/default", "arts_entertainment/aquarium" or "food/icecream".)
- google_place_id (String, Optional): Optional. Google Places identifier of the venue
- google_place_type (String, Optional): Optional. Google Places type of the venue. (See supported types.)

### PollMedia
- animation (Animation, Optional): Optional. Media is an animation, information about the animation
- audio (Audio, Optional): Optional. Media is an audio file, information about the file; currently, can't be received in a poll option
- document (Document, Optional): Optional. Media is a general file, information about the file; currently, can't be received in a poll option
- live_photo (LivePhoto, Optional): Optional. Media is a live photo, information about the live photo
- location (Location, Optional): Optional. Media is a shared location, information about the location
- photo (Array of PhotoSize, Optional): Optional. Media is a photo, available sizes of the photo
- sticker (Sticker, Optional): Optional. Media is a sticker, information about the sticker; currently, for poll options only
- venue (Venue, Optional): Optional. Media is a venue, information about the venue
- video (Video, Optional): Optional. Media is a video, information about the video

### Poll
- id (String, Required): Unique poll identifier
- question (String, Required): Poll question, 1-300 characters
- question_entities (Array of MessageEntity, Optional): Optional. Special entities that appear in the question. Currently, only custom emoji entities are allowed in poll questions
- options (Array of PollOption, Required): List of poll options
- total_voter_count (Integer, Required): Total number of users that voted in the poll
- is_closed (Boolean, Required): True, if the poll is closed
- is_anonymous (Boolean, Required): True, if the poll is anonymous
- type (String, Required): Poll type, currently can be "regular" or "quiz"
- allows_multiple_answers (Boolean, Required): True, if the poll allows multiple answers
- allows_revoting (Boolean, Required): True, if the poll allows to change the chosen answer options
- members_only (Boolean, Required): True if voting is limited to users who have been members of the chat where the poll was originally sent for more than 24 hours
- country_codes (Array of String, Optional): Optional. A list of two-letter ISO 3166-1 alpha-2 country codes indicating the countries from which users can vote in the poll. If omitted, then users from any country can participate in the poll.
- correct_option_ids (Array of Integer, Optional): Optional. Array of 0-based identifiers of the correct answer options. Available only for polls in quiz mode which are closed or were sent (not forwarded) by the bot or to the private chat with the bot.
- explanation (String, Optional): Optional. Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters
- explanation_entities (Array of MessageEntity, Optional): Optional. Special entities like usernames, URLs, bot commands, etc. that appear in the explanation
- explanation_media (PollMedia, Optional): Optional. Media added to the quiz explanation
- open_period (Integer, Optional): Optional. Amount of time in seconds the poll will be active after creation
- close_date (Integer, Optional): Optional. Point in time (Unix timestamp) when the poll will be automatically closed
- description (String, Optional): Optional. Description of the poll; for polls inside the Message object only
- description_entities (Array of MessageEntity, Optional): Optional. Special entities like usernames, URLs, bot commands, etc. that appear in the description
- media (PollMedia, Optional): Optional. Media added to the poll description; for polls inside the Message object only

### PollOption
- persistent_id (String, Required): Unique identifier of the option, persistent on option addition and deletion
- text (String, Required): Option text, 1-100 characters
- text_entities (Array of MessageEntity, Optional): Optional. Special entities that appear in the option text. Currently, only custom emoji entities are allowed in poll option texts
- media (PollMedia, Optional): Optional. Media added to the poll option
- voter_count (Integer, Required): Number of users who voted for this option; may be 0 if unknown
- added_by_user (User, Optional): Optional. User who added the option; omitted if the option wasn't added by a user after poll creation
- added_by_chat (Chat, Optional): Optional. Chat that added the option; omitted if the option wasn't added by a chat after poll creation
- addition_date (Integer, Optional): Optional. Point in time (Unix timestamp) when the option was added; omitted if the option existed in the original poll

### InputPollMedia

### InputPollOptionMedia

### InputPollOption
- text (String, Required): Option text, 1-100 characters
- text_parse_mode (String, Optional): Optional. Mode for parsing entities in the text. See formatting options for more details. Currently, only custom emoji entities are allowed
- text_entities (Array of MessageEntity, Optional): Optional. A JSON-serialized list of special entities that appear in the poll option text. It can be specified instead of text_parse_mode
- media (InputPollOptionMedia, Optional): Optional. Media added to the poll option

### LivePhoto
- photo (Array of PhotoSize, Optional): Optional. Available sizes of the corresponding static photo
- file_id (String, Required): Identifier for the video file which can be used to download or reuse the file
- file_unique_id (String, Required): Unique identifier for the video file which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
- width (Integer, Required): Video width as defined by the sender
- height (Integer, Required): Video height as defined by the sender
- duration (Integer, Required): Duration of the video in seconds as defined by the sender
- mime_type (String, Optional): Optional. MIME type of the file as defined by the sender
- file_size (Integer, Optional): Optional. File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.

### InputMediaLivePhoto
- type (String, Required): Type of the result, must be live_photo
- media (String, Required): Video of the live photo to send. Pass a file_id to send a file that exists on the Telegram servers (recommended) or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files. Sending live photos by a URL is currently unsupported.
- photo (String, Required): The static photo to send. Pass a file_id to send a file that exists on the Telegram servers (recommended) or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files. Sending live photos by a URL is currently unsupported.
- caption (String, Optional): Optional. Caption of the live photo to be sent, 0-1024 characters after entities parsing
- parse_mode (String, Optional): Optional. Mode for parsing entities in the live photo caption. See formatting options for more details.
- caption_entities (Array of MessageEntity, Optional): Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
- show_caption_above_media (Boolean, Optional): Optional. Pass True, if the caption must be shown above the message media
- has_spoiler (Boolean, Optional): Optional. Pass True if the live photo needs to be covered with a spoiler animation

### ExternalReplyInfo
- origin (MessageOrigin, Required): Origin of the message replied to by the given message
- chat (Chat, Optional): Optional. Chat the original message belongs to. Available only if the chat is a supergroup or a channel.
- message_id (Integer, Optional): Optional. Unique message identifier inside the original chat. Available only if the original chat is a supergroup or a channel.
- link_preview_options (LinkPreviewOptions, Optional): Optional. Options used for link preview generation for the original message, if it is a text message
- animation (Animation, Optional): Optional. Message is an animation, information about the animation
- audio (Audio, Optional): Optional. Message is an audio file, information about the file
- document (Document, Optional): Optional. Message is a general file, information about the file
- live_photo (LivePhoto, Optional): Optional. Message is a live photo, information about the live photo
- paid_media (PaidMediaInfo, Optional): Optional. Message contains paid media; information about the paid media
- photo (Array of PhotoSize, Optional): Optional. Message is a photo, available sizes of the photo
- sticker (Sticker, Optional): Optional. Message is a sticker, information about the sticker
- story (Story, Optional): Optional. Message is a forwarded story
- video (Video, Optional): Optional. Message is a video, information about the video
- video_note (VideoNote, Optional): Optional. Message is a video note, information about the video message
- voice (Voice, Optional): Optional. Message is a voice message, information about the file
- has_media_spoiler (Boolean, Optional): Optional. True, if the message media is covered by a spoiler animation
- checklist (Checklist, Optional): Optional. Message is a checklist
- contact (Contact, Optional): Optional. Message is a shared contact, information about the contact
- dice (Dice, Optional): Optional. Message is a dice with random value
- game (Game, Optional): Optional. Message is a game, information about the game. More about games: https://core.telegram.org/bots/api#games
- giveaway (Giveaway, Optional): Optional. Message is a scheduled giveaway, information about the giveaway
- giveaway_winners (GiveawayWinners, Optional): Optional. A giveaway with public winners was completed
- invoice (Invoice, Optional): Optional. Message is an invoice for a payment, information about the invoice. More about payments: https://core.telegram.org/bots/api#payments
- location (Location, Optional): Optional. Message is a shared location, information about the location
- poll (Poll, Optional): Optional. Message is a native poll, information about the poll
- venue (Venue, Optional): Optional. Message is a venue, information about the venue

### PaidMediaLivePhoto
- type (String, Required): Type of the paid media, always "live_photo"
- live_photo (LivePhoto, Required): The photo

### InputPaidMediaLivePhoto
- type (String, Required): Type of the media, must be live_photo
- media (String, Required): Video of the live photo to send. Pass a file_id to send a file that exists on the Telegram servers (recommended) or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files. Sending live photos by a URL is currently unsupported.
- photo (String, Required): The static photo to send. Pass a file_id to send a file that exists on the Telegram servers (recommended) or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files. Sending live photos by a URL is currently unsupported.

### BotAccessSettings
- is_access_restricted (Boolean, Required): True, if only selected users can access the bot. The bot's owner can always access it.
- added_users (Array of User, Optional): Optional. The list of other users who have access to the bot if the access is restricted

## Methods

### answerGuestQuery
- guest_query_id (String, Required): Unique identifier for the query to be answered
- result (InlineQueryResult, Required): A JSON-serialized object describing the message to be sent
Returns: SentGuestMessage

### getChatAdministrators
- chat_id (Integer|String, Required): Unique identifier for the target chat or username of the target supergroup or channel in the format @username
- return_bots (Boolean, Optional): Pass True to additionally receive all bots that are administrators of the chat. By default, bots other than the current bot are omitted.
Returns: Array of ChatMember

### deleteAllMessageReactions
- chat_id (Integer|String, Required): Unique identifier for the target chat or username of the target supergroup (in the format @username)
- user_id (Integer, Optional): Identifier of the user whose reactions will be removed, if the reactions were added by a user
- actor_chat_id (Integer, Optional): Identifier of the chat whose reactions will be removed, if the reactions were added by a chat
Returns: Boolean

### deleteMessageReaction
- chat_id (Integer|String, Required): Unique identifier for the target chat or username of the target supergroup (in the format @username)
- message_id (Integer, Required): Identifier of the target message
- user_id (Integer, Optional): Identifier of the user whose reaction will be removed, if the reaction was added by a user
- actor_chat_id (Integer, Optional): Identifier of the chat whose reaction will be removed, if the reaction was added by a chat
Returns: Boolean

### sendPoll
- business_connection_id (String, Optional): Unique identifier of the business connection on behalf of which the message will be sent
- chat_id (Integer|String, Required): Unique identifier for the target chat or username of the target bot, supergroup or channel in the format @username. Polls can't be sent to channel direct messages chats.
- message_thread_id (Integer, Optional): Unique identifier for the target message thread (topic) of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
- question (String, Required): Poll question, 1-300 characters
- question_parse_mode (String, Optional): Mode for parsing entities in the question. See formatting options for more details. Currently, only custom emoji entities are allowed
- question_entities (Array of MessageEntity, Optional): A JSON-serialized list of special entities that appear in the poll question. It can be specified instead of question_parse_mode
- options (Array of InputPollOption, Required): A JSON-serialized list of 1-12 answer options
- is_anonymous (Boolean, Optional): True, if the poll needs to be anonymous, defaults to True
- type (String, Optional): Poll type, "quiz" or "regular", defaults to "regular"
- allows_multiple_answers (Boolean, Optional): Pass True, if the poll allows multiple answers, defaults to False
- allows_revoting (Boolean, Optional): Pass True, if the poll allows to change chosen answer options, defaults to False for quizzes and to True for regular polls
- shuffle_options (Boolean, Optional): Pass True, if the poll options must be shown in random order
- allow_adding_options (Boolean, Optional): Pass True, if answer options can be added to the poll after creation; not supported for anonymous polls and quizzes
- hide_results_until_closes (Boolean, Optional): Pass True, if poll results must be shown only after the poll closes
- members_only (Boolean, Optional): Pass True, if voting is limited to users who have been members of the chat where the poll is being sent for more than 24 hours; for channel chats only
- country_codes (Array of String, Optional): A JSON-serialized list of 0-12 two-letter ISO 3166-1 alpha-2 country codes indicating the countries from which users can vote in the poll; for channel chats only. If omitted or empty, then users from any country can participate in the poll.
- correct_option_ids (Array of Integer, Optional): A JSON-serialized list of monotonically increasing 0-based identifiers of the correct answer options, required for polls in quiz mode
- explanation (String, Optional): Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters with at most 2 line feeds after entities parsing
- explanation_parse_mode (String, Optional): Mode for parsing entities in the explanation. See formatting options for more details.
- explanation_entities (Array of MessageEntity, Optional): A JSON-serialized list of special entities that appear in the poll explanation. It can be specified instead of explanation_parse_mode
- explanation_media (InputPollMedia, Optional): Media added to the quiz explanation
- open_period (Integer, Optional): Amount of time in seconds the poll will be active after creation, 5-2628000. Can't be used together with close_date.
- close_date (Integer, Optional): Point in time (Unix timestamp) when the poll will be automatically closed. Must be at least 5 and no more than 2628000 seconds in the future. Can't be used together with open_period.
- is_closed (Boolean, Optional): Pass True if the poll needs to be immediately closed. This can be useful for poll preview.
- description (String, Optional): Description of the poll to be sent, 0-1024 characters after entities parsing
- description_parse_mode (String, Optional): Mode for parsing entities in the poll description. See formatting options for more details.
- description_entities (Array of MessageEntity, Optional): A JSON-serialized list of special entities that appear in the poll description, which can be specified instead of description_parse_mode
- media (InputPollMedia, Optional): Media added to the poll description
- disable_notification (Boolean, Optional): Sends the message silently. Users will receive a notification with no sound.
- protect_content (Boolean, Optional): Protects the contents of the sent message from forwarding and saving
- allow_paid_broadcast (Boolean, Optional): Pass True to allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance.
- message_effect_id (String, Optional): Unique identifier of the message effect to be added to the message; for private chats only
- reply_parameters (ReplyParameters, Optional): Description of the message to reply to
- reply_markup (InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply, Optional): Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user
Returns: Message

### sendLivePhoto
- business_connection_id (String, Optional): Unique identifier of the business connection on behalf of which the message will be sent
- chat_id (Integer|String, Required): Unique identifier for the target chat or username of the target channel (in the format @channelusername)
- message_thread_id (Integer, Optional): Unique identifier for the target message thread (topic) of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
- direct_messages_topic_id (Integer, Optional): Identifier of the direct messages topic to which the message will be sent; required if the message is sent to a direct messages chat
- live_photo (InputFile|String, Required): Live photo video to send. The video must be no longer than 10 seconds and must not exceed 10 MB in size. Pass a file_id as String to send a video that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data. More information on Sending Files: https://core.telegram.org/bots/api#sending-files. Sending live photos by a URL is currently unsupported.
- photo (InputFile|String, Required): The static photo to send. Pass a file_id as String to send a photo that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data. More information on Sending Files: https://core.telegram.org/bots/api#sending-files. Sending live photos by a URL is currently unsupported.
- caption (String, Optional): Video caption (may also be used when resending videos by file_id), 0-1024 characters after entities parsing
- parse_mode (String, Optional): Mode for parsing entities in the video caption. See formatting options for more details.
- caption_entities (Array of MessageEntity, Optional): A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
- show_caption_above_media (Boolean, Optional): Pass True, if the caption must be shown above the message media
- has_spoiler (Boolean, Optional): Pass True if the video needs to be covered with a spoiler animation
- disable_notification (Boolean, Optional): Sends the message silently. Users will receive a notification with no sound.
- protect_content (Boolean, Optional): Protects the contents of the sent message from forwarding and saving
- allow_paid_broadcast (Boolean, Optional): Pass True to allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance.
- message_effect_id (String, Optional): Unique identifier of the message effect to be added to the message; for private chats only
- suggested_post_parameters (SuggestedPostParameters, Optional): A JSON-serialized object containing the parameters of the suggested post to send; for direct messages chats only. If the message is sent as a reply to another suggested post, then that suggested post is automatically declined.
- reply_parameters (ReplyParameters, Optional): Description of the message to reply to
- reply_markup (InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply, Optional): Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user.
Returns: Message

### sendMediaGroup
- business_connection_id (String, Optional): Unique identifier of the business connection on behalf of which the message will be sent
- chat_id (Integer|String, Required): Unique identifier for the target chat or username of the target bot, supergroup or channel in the format @username
- message_thread_id (Integer, Optional): Unique identifier for the target message thread (topic) of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
- direct_messages_topic_id (Integer, Optional): Identifier of the direct messages topic to which the messages will be sent; required if the messages are sent to a direct messages chat
- media (Array of InputMediaAudio|Array of InputMediaDocument|Array of InputMediaLivePhoto|Array of InputMediaPhoto|Array of InputMediaVideo, Required): A JSON-serialized array describing messages to be sent, must include 2-10 items
- disable_notification (Boolean, Optional): Sends messages silently. Users will receive a notification with no sound.
- protect_content (Boolean, Optional): Protects the contents of the sent messages from forwarding and saving
- allow_paid_broadcast (Boolean, Optional): Pass True to allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance.
- message_effect_id (String, Optional): Unique identifier of the message effect to be added to the message; for private chats only
- reply_parameters (ReplyParameters, Optional): Description of the message to reply to
Returns: Array of Message

### editMessageMedia
- business_connection_id (String, Optional): Unique identifier of the business connection on behalf of which the message to be edited was sent
- chat_id (Integer|String, Optional): Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target bot, supergroup or channel in the format @username.
- message_id (Integer, Optional): Required if inline_message_id is not specified. Identifier of the message to edit
- inline_message_id (String, Optional): Required if chat_id and message_id are not specified. Identifier of the inline message
- media (InputMedia, Required): A JSON-serialized object for a new media content of the message
- reply_markup (InlineKeyboardMarkup, Optional): A JSON-serialized object for a new inline keyboard.
Returns: Message|Boolean

### getManagedBotAccessSettings
- user_id (Integer, Required): User identifier of the managed bot whose access settings will be returned
Returns: BotAccessSettings

### setManagedBotAccessSettings
- user_id (Integer, Required): User identifier of the managed bot whose access settings will be changed
- is_access_restricted (Boolean, Required): Pass True, if only selected users can access the bot. The bot's owner can always access it.
- added_user_ids (Array of Integer, Optional): A JSON-serialized list of up to 10 identifiers of users who will have access to the bot in addition to its owner. Ignored if is_access_restricted is false.
Returns: Boolean

### getUserPersonalChatMessages
- user_id (Integer, Required): Unique identifier for the target user
- limit (Integer, Required): The maximum number of messages to return; 1-20
Returns: Array of Message

### sendMessageDraft
- chat_id (Integer, Required): Unique identifier for the target private chat
- message_thread_id (Integer, Optional): Unique identifier for the target message thread
- draft_id (Integer, Required): Unique identifier of the message draft; must be non-zero. Changes of drafts with the same identifier are animated.
- text (String, Optional): Text of the message to be sent, 0-4096 characters after entities parsing. Pass an empty text to show a "Thinking..." placeholder.
- parse_mode (String, Optional): Mode for parsing entities in the message text. See formatting options for more details.
- entities (Array of MessageEntity, Optional): A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
Returns: Boolean

