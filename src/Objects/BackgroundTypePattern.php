<?php

namespace Telegram\Bot\Objects;

/**
 * Class BackgroundTypePattern.
 *
 * The background is a PNG or TGV (gzipped subset of SVG with MIME type application/x-tgwallpattern) pattern to be combined with the background fill chosen by the user.
 *
 * @link https://core.telegram.org/bots/api#backgroundtypepattern
 */
class BackgroundTypePattern extends BackgroundType
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'document' => Document::class,
            'fill' => BackgroundFill::class,
        ];
    }

    /**
     * Document with the pattern.
     */
    public function getDocument(): Document
    {
        return $this->items['document'];
    }

    /**
     * The background fill that is combined with the pattern.
     */
    public function getFill(): BackgroundFill
    {
        return $this->items['fill'];
    }

    /**
     * Intensity of the pattern when it is shown above the filled background; 0-100.
     */
    public function getIntensity(): int
    {
        return $this->items['intensity'];
    }

    /**
     * (Optional). True, if the background fill must be applied only to the pattern itself. All other pixels are black in this case. For dark themes only.
     */
    public function getIsInverted(): ?bool
    {
        return $this->items['is_inverted'] ?? null;
    }

    /**
     * (Optional). True, if the background moves slightly when the device is tilted.
     */
    public function getIsMoving(): ?bool
    {
        return $this->items['is_moving'] ?? null;
    }
}
