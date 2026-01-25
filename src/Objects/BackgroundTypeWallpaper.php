<?php

namespace Telegram\Bot\Objects;

/**
 * Class BackgroundTypeWallpaper.
 *
 * The background is a wallpaper in the JPEG format.
 *
 * @link https://core.telegram.org/bots/api#backgroundtypewallpaper
 */
class BackgroundTypeWallpaper extends BackgroundType
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'document' => Document::class,
        ];
    }

    /**
     * Document with the wallpaper.
     */
    public function getDocument(): Document
    {
        return $this->items['document'];
    }

    /**
     * Dimming of the background in dark themes, as a percentage; 0-100.
     */
    public function getDarkThemeDimming(): int
    {
        return $this->items['dark_theme_dimming'];
    }

    /**
     * (Optional). True, if the wallpaper is downscaled to fit in a 450x450 square and then box-blurred with radius 12.
     */
    public function getIsBlurred(): ?bool
    {
        return $this->items['is_blurred'] ?? null;
    }

    /**
     * (Optional). True, if the background moves slightly when the device is tilted.
     */
    public function getIsMoving(): ?bool
    {
        return $this->items['is_moving'] ?? null;
    }
}
