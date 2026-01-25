<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the repostStory method.
 *
 * Reposts a story on behalf of a business account from another business account.
 *
 * @link https://core.telegram.org/bots/api#repoststory
 */
class RepostStoryRequest extends TelegramApiRequest
{
    /** @var string Unique identifier of the business connection */
    protected string $businessConnectionId;

    /** @var int Unique identifier of the chat which posted the story that should be reposted */
    protected int $fromChatId;

    /** @var int Unique identifier of the story that should be reposted */
    protected int $fromStoryId;

    /** @var int Period after which the story is moved to the archive, in seconds */
    protected int $activePeriod;

    /** @var bool|null Pass True to keep the story accessible after it expires */
    protected ?bool $postToChatPage = null;

    /** @var bool|null Pass True if the content of the story must be protected from forwarding and screenshotting */
    protected ?bool $protectContent = null;

    /**
     * RepostStoryRequest constructor.
     */
    public function __construct(string $businessConnectionId, int $fromChatId, int $fromStoryId, int $activePeriod)
    {
        $this->businessConnectionId = $businessConnectionId;
        $this->fromChatId = $fromChatId;
        $this->fromStoryId = $fromStoryId;
        $this->activePeriod = $activePeriod;
    }

    /**
     * @return $this
     */
    public function setPostToChatPage(bool $postToChatPage): self
    {
        $this->postToChatPage = $postToChatPage;

        return $this;
    }

    /**
     * @return $this
     */
    public function setProtectContent(bool $protectContent): self
    {
        $this->protectContent = $protectContent;

        return $this;
    }

    /**
     * Get the method name.
     */
    public function getMethod(): string
    {
        return 'repostStory';
    }

    /**
     * Validate the request.
     */
    public function validate(): void
    {
        // No specific validation rules beyond type hints
    }

    /**
     * Get the request parameters.
     */
    protected function buildParams(): array
    {
        return [
            'business_connection_id' => $this->businessConnectionId,
            'from_chat_id' => $this->fromChatId,
            'from_story_id' => $this->fromStoryId,
            'active_period' => $this->activePeriod,
            'post_to_chat_page' => $this->postToChatPage,
            'protect_content' => $this->protectContent,
        ];
    }
}
