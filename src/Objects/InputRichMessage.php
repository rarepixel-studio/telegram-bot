<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class InputRichMessage.
 *
 * Describes a rich message to be sent.
 *
 * @link https://core.telegram.org/bots/api#inputrichmessage
 */
class InputRichMessage extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'media' => InputRichMessageMedia::class,
            'blocks' => InputRichBlock::class,
        ];
    }

    /**
     * Validate the rich message payload.
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        $hasHtml = $this->has('html') && $this->get('html') !== '';
        $hasMarkdown = $this->has('markdown') && $this->get('markdown') !== '';

        if ($hasHtml === $hasMarkdown) {
            // Both html and markdown are provided, or neither are provided.
            // But if blocks are provided, it's valid to have neither.
            if (! $this->has('blocks') || ($hasHtml && $hasMarkdown)) {
                throw new TelegramValidationException('Exactly one of html, markdown, or blocks must be provided');
            }
        }
    }

    /**
     * (Optional). Content described using HTML formatting.
     */
    public function getHtml(): ?string
    {
        return $this->items['html'] ?? null;
    }

    /**
     * (Optional). Content described using Markdown formatting.
     */
    public function getMarkdown(): ?string
    {
        return $this->items['markdown'] ?? null;
    }

    /**
     * (Optional). True if the rich message must be shown right-to-left.
     */
    public function getIsRtl(): ?bool
    {
        return $this->items['is_rtl'] ?? null;
    }

    /**
     * (Optional). True to skip automatic detection of rich text entities.
     */
    public function getSkipEntityDetection(): ?bool
    {
        return $this->items['skip_entity_detection'] ?? null;
    }

    /**
     * (Optional). Media used in markdown or html formatting.
     *
     * @return \Illuminate\Support\Collection<int, InputRichMessageMedia>|null
     */
    public function getMedia(): ?\Illuminate\Support\Collection
    {
        return $this->items['media'] ?? null;
    }

    /**
     * (Optional). Blocks used in formatting.
     *
     * @return \Illuminate\Support\Collection<int, InputRichBlock>|null
     */
    public function getBlocks(): ?\Illuminate\Support\Collection
    {
        return $this->items['blocks'] ?? null;
    }
}
