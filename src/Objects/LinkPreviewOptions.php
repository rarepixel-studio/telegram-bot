<?php

namespace Telegram\Bot\Objects;

/**
 * Class LinkPreviewOptions.
 *
 * Describes the options used for link preview generation.
 *
 * @method bool|null   getIsDisabled()       True if the link preview is disabled.
 * @method string|null getUrl()              URL to use for the link preview. If empty, the first URL found in the message text will be used.
 * @method bool|null   getPreferSmallMedia() True if the media in the link preview is supposed to be shrunk; ignored if the URL isn't explicitly specified or media size change isn't supported for the preview.
 * @method bool|null   getPreferLargeMedia() True if the media in the link preview is supposed to be enlarged; ignored if the URL isn't explicitly specified or media size change isn't supported for the preview.
 * @method bool|null   getShowAboveText()    True if the link preview must be shown above the message text; otherwise, the link preview will be shown below the message text.
 */
class LinkPreviewOptions extends BaseObject
{
    /**
     * Property relations.
     *
     * @return array
     */
    public function relations()
    {
        return [];
    }
}
