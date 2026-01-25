<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class KeyboardButtonRequestChat.
 *
 * Defines the criteria used to request a suitable chat.
 */
class KeyboardButtonRequestChat extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'user_administrator_rights' => ChatAdministratorRights::class,
            'bot_administrator_rights' => ChatAdministratorRights::class,
        ];
    }

    /**
     * Create a new instance from array data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    /**
     * Create a KeyboardButtonRequestChat instance.
     *
     * @param  array<string, mixed>  $items
     */
    public static function make($items = []): self
    {
        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * Set whether to request a forum supergroup.
     */
    public function withChatIsForum(?bool $chatIsForum): self
    {
        $this->items['chat_is_forum'] = $chatIsForum;

        return $this;
    }

    /**
     * Set whether to request a chat with a username.
     */
    public function withChatHasUsername(?bool $chatHasUsername): self
    {
        $this->items['chat_has_username'] = $chatHasUsername;

        return $this;
    }

    /**
     * Set whether to request a chat created by the user.
     */
    public function withChatIsCreated(?bool $chatIsCreated): self
    {
        $this->items['chat_is_created'] = $chatIsCreated;

        return $this;
    }

    /**
     * Set required administrator rights for the user.
     *
     * @param  ChatAdministratorRights|array<string, mixed>|null  $rights
     */
    public function withUserAdministratorRights(ChatAdministratorRights|array|null $rights): self
    {
        $this->items['user_administrator_rights'] = $rights;

        return $this;
    }

    /**
     * Set required administrator rights for the bot.
     *
     * @param  ChatAdministratorRights|array<string, mixed>|null  $rights
     */
    public function withBotAdministratorRights(ChatAdministratorRights|array|null $rights): self
    {
        $this->items['bot_administrator_rights'] = $rights;

        return $this;
    }

    /**
     * Set whether the bot must be a member of the chat.
     */
    public function withBotIsMember(?bool $botIsMember): self
    {
        $this->items['bot_is_member'] = $botIsMember;

        return $this;
    }

    /**
     * Request the chat title.
     */
    public function withRequestTitle(?bool $requestTitle): self
    {
        $this->items['request_title'] = $requestTitle;

        return $this;
    }

    /**
     * Request the chat username.
     */
    public function withRequestUsername(?bool $requestUsername): self
    {
        $this->items['request_username'] = $requestUsername;

        return $this;
    }

    /**
     * Request the chat photo.
     */
    public function withRequestPhoto(?bool $requestPhoto): self
    {
        $this->items['request_photo'] = $requestPhoto;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['request_id'])) {
            throw new TelegramValidationException('request_id is required');
        }

        if (! isset($this->items['chat_is_channel'])) {
            throw new TelegramValidationException('chat_is_channel is required');
        }
    }

    /**
     * Signed 32-bit identifier of the request.
     */
    public function getRequestId(): int
    {
        return $this->items['request_id'];
    }

    /**
     * True if requesting a channel chat.
     */
    public function getChatIsChannel(): bool
    {
        return $this->items['chat_is_channel'];
    }

    /**
     * True if requesting a forum supergroup.
     */
    public function getChatIsForum(): ?bool
    {
        return $this->items['chat_is_forum'] ?? null;
    }

    /**
     * True if requesting a chat with a username.
     */
    public function getChatHasUsername(): ?bool
    {
        return $this->items['chat_has_username'] ?? null;
    }

    /**
     * True if requesting a chat created by the user.
     */
    public function getChatIsCreated(): ?bool
    {
        return $this->items['chat_is_created'] ?? null;
    }

    /**
     * Required administrator rights for the user.
     */
    public function getUserAdministratorRights(): ?ChatAdministratorRights
    {
        return $this->items['user_administrator_rights'] ?? null;
    }

    /**
     * Required administrator rights for the bot.
     */
    public function getBotAdministratorRights(): ?ChatAdministratorRights
    {
        return $this->items['bot_administrator_rights'] ?? null;
    }

    /**
     * True if the bot must be a member.
     */
    public function getBotIsMember(): ?bool
    {
        return $this->items['bot_is_member'] ?? null;
    }

    /**
     * True if requesting the chat title.
     */
    public function getRequestTitle(): ?bool
    {
        return $this->items['request_title'] ?? null;
    }

    /**
     * True if requesting the chat username.
     */
    public function getRequestUsername(): ?bool
    {
        return $this->items['request_username'] ?? null;
    }

    /**
     * True if requesting the chat photo.
     */
    public function getRequestPhoto(): ?bool
    {
        return $this->items['request_photo'] ?? null;
    }
}
