<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;

/**
 * Class LinkPreviewOptions.
 *
 * Describes the options used for link preview generation.
 */
class LinkPreviewOptions extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [];
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
     * Create a LinkPreviewOptions instance.
     *
     * @param  array<string, mixed>  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
    {
        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * Set whether the preview is disabled.
     */
    public function withIsDisabled(?bool $isDisabled): self
    {
        $this->items['is_disabled'] = $isDisabled;

        return $this;
    }

    /**
     * Set the URL used for the link preview.
     */
    public function withUrl(?string $url): self
    {
        $this->items['url'] = $url;

        return $this;
    }

    /**
     * Prefer smaller media in the preview.
     */
    public function withPreferSmallMedia(?bool $preferSmallMedia): self
    {
        $this->items['prefer_small_media'] = $preferSmallMedia;

        return $this;
    }

    /**
     * Prefer larger media in the preview.
     */
    public function withPreferLargeMedia(?bool $preferLargeMedia): self
    {
        $this->items['prefer_large_media'] = $preferLargeMedia;

        return $this;
    }

    /**
     * Show preview above the message text.
     */
    public function withShowAboveText(?bool $showAboveText): self
    {
        $this->items['show_above_text'] = $showAboveText;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        // No validation rules defined for link preview options.
    }

    /**
     * True if the link preview is disabled.
     */
    public function getIsDisabled(): ?bool
    {
        return $this->items['is_disabled'] ?? null;
    }

    /**
     * URL to use for the link preview. If empty, the first URL found in the message text will be used.
     */
    public function getUrl(): ?string
    {
        return $this->items['url'] ?? null;
    }

    /**
     * True if the media in the link preview is supposed to be shrunk; ignored if the URL isn't explicitly specified or media size change isn't supported for the preview.
     */
    public function getPreferSmallMedia(): ?bool
    {
        return $this->items['prefer_small_media'] ?? null;
    }

    /**
     * True if the media in the link preview is supposed to be enlarged; ignored if the URL isn't explicitly specified or media size change isn't supported for the preview.
     */
    public function getPreferLargeMedia(): ?bool
    {
        return $this->items['prefer_large_media'] ?? null;
    }

    /**
     * True if the link preview must be shown above the message text; otherwise, the link preview will be shown below the message text.
     */
    public function getShowAboveText(): ?bool
    {
        return $this->items['show_above_text'] ?? null;
    }
}
