<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the editChatSubscriptionInviteLink method.
 *
 * Use this method to edit a subscription invite link created by the bot.
 *
 * @link https://core.telegram.org/bots/api#editchatsubscriptioninvitelink
 */
class EditChatSubscriptionInviteLinkRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string  $invite_link  The invite link to edit
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $invite_link,
    ) {}

    /**
     * Invite link name; 0-32 characters.
     */
    public function name(string $name): self
    {
        $this->params['name'] = $name;

        return $this;
    }

    public function getMethod(): string
    {
        return 'editChatSubscriptionInviteLink';
    }

    public function validate(): void
    {
        if (empty($this->invite_link)) {
            throw new TelegramValidationException('invite_link cannot be empty');
        }

        if (isset($this->params['name'])) {
            $nameLength = mb_strlen($this->params['name']);
            if ($nameLength > 32) {
                throw new TelegramValidationException('name must not exceed 32 characters');
            }
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'invite_link' => $this->invite_link,
        ] + $this->params;
    }
}
