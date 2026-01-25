<?php

namespace Telegram\Bot\Objects;

/**
 * Class WriteAccessAllowed.
 *
 * Represents a service message about a user allowing a bot to write messages.
 */
class WriteAccessAllowed extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * (Optional). True, if the access was granted after an explicit request.
     */
    public function getFromRequest(): ?bool
    {
        return $this->items['from_request'] ?? null;
    }

    /**
     * (Optional). Name of the Web App, if the access was granted from a link.
     */
    public function getWebAppName(): ?string
    {
        return $this->items['web_app_name'] ?? null;
    }

    /**
     * (Optional). True, if the access was granted from the attachment menu.
     */
    public function getFromAttachmentMenu(): ?bool
    {
        return $this->items['from_attachment_menu'] ?? null;
    }
}
