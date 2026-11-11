<?php

namespace Telegram\Bot\Requests;

use ArrayAccess;
use Closure;
use Psr\Http\Message\StreamInterface;
use Telegram\Bot\Contracts\ApiRequestInterface;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\FileUpload\InputFileInterface;
use Telegram\Bot\Objects\EphemeralMessageParameters;
use Telegram\Bot\Objects\InputMedia;

/**
 * Serializes request parameters at each stage of outbound API and webhook preparation.
 *
 * @internal
 */
final class RequestSerializer
{
    /** @var array<string, string> Attachment prefixes for secondary media fields. */
    private const MEDIA_ATTACHMENT_PREFIXES = [
        'thumb' => '__ATTACHED_THUMB__',
        'thumbnail' => '__ATTACHED_THUMBNAIL__',
        'cover' => '__ATTACHED_COVER__',
        'photo' => '__ATTACHED_PHOTO__',
    ];

    /**
     * Prepare wrapper input, preserving the request object's validation and serialization hooks.
     *
     * @param  array<string, mixed>|ApiRequestInterface  $input  Wrapper input.
     * @return array<string, mixed>
     *
     * @throws TelegramValidationException If the typed request is invalid.
     */
    public static function forApi(array|ApiRequestInterface $input): array
    {
        if (is_array($input)) {
            return $input;
        }

        $input->validate();

        return $input->toArray();
    }

    /**
     * Normalize parameters using the request's value conversion.
     *
     * @param  array<string, mixed>  $params  Parameters from the request.
     * @param  Closure(mixed): mixed  $normalize  The request's value normalization hook.
     * @param  list<string>  $preservedFields  Fields reserved for later processing.
     * @return array<string, mixed>
     */
    public static function normalizeParameters(array $params, Closure $normalize, array $preservedFields = []): array
    {
        foreach ($params as $field => $value) {
            $params[$field] = in_array($field, $preservedFields, true) ? $value : $normalize($value);
        }

        return $params;
    }

    /**
     * JSON-encode configured array fields, leaving pre-serialized values intact.
     *
     * @param  array<string, mixed>  $params  Parameters from the request.
     * @param  array<int, string>  $fields  Names of fields to encode.
     * @return array<string, mixed>
     */
    public static function encodeJsonFields(array $params, array $fields): array
    {
        foreach ($fields as $field) {
            if (array_key_exists($field, $params) && is_array($params[$field])) {
                $params[$field] = json_encode($params[$field]);
            }
        }

        return $params;
    }

    /**
     * Apply the field conversions shared by outbound POST requests.
     *
     * @param  array<string, mixed>  $params  Parameters passed to the POST helper.
     * @return array<string, mixed>
     */
    public static function preparePost(array $params): array
    {
        $ephemeralParameters = $params['ephemeral_message_parameters'] ?? null;
        if (is_array($ephemeralParameters)) {
            $ephemeralParameters = EphemeralMessageParameters::fromArray($ephemeralParameters);
        }

        if ($ephemeralParameters instanceof EphemeralMessageParameters) {
            $params['ephemeral_message_parameters'] = json_encode($ephemeralParameters->toArray());
        }

        $params = self::encodeJsonFields($params, ['custom_description_entities']);

        $replyParameters = $params['reply_parameters'] ?? null;
        if ((is_array($replyParameters) || $replyParameters instanceof ArrayAccess) && isset($replyParameters['quote_rich_texts'])) {
            $params['reply_parameters'] = json_encode($replyParameters);
        }

        return $params;
    }

    /**
     * Open configured file fields while leaving existing streams and resources intact.
     *
     * @param  array<string, mixed>  $params  Parameters from the wrapper.
     * @param  array<int, string>  $files  Fields that accept uploads.
     * @return array<string, mixed>
     *
     * @throws TelegramSDKException If an upload cannot be read.
     * @throws \RuntimeException If the file stream cannot be opened.
     * @throws \TypeError If a file value cannot be passed to the filesystem.
     */
    public static function prepareFiles(array $params, array $files): array
    {
        foreach ($files as $key) {
            if (! array_key_exists($key, $params) || is_resource($params[$key]) || $params[$key] instanceof StreamInterface) {
                continue;
            }

            if ($params[$key] instanceof InputFileInterface) {
                $params[$key] = $params[$key]->open();

                continue;
            }

            $validUrl = filter_var($params[$key], FILTER_VALIDATE_URL);
            $params[$key] = (is_file($params[$key]) || $validUrl) ? (new InputFile($params[$key]))->open() : (string) $params[$key];
        }

        return $params;
    }

    /**
     * Serialize media and collect multipart attachments, retaining the mutation of InputMedia objects.
     *
     * @param  array<string, mixed>  $params  Parameters whose media field will be serialized.
     * @return list<array{name: string, contents: mixed}>
     *
     * @throws TelegramSDKException If an attachment cannot be read.
     * @throws \RuntimeException If an attachment stream cannot be opened.
     */
    public static function extractInputMedia(array &$params): array
    {
        $attachments = [];
        if (! isset($params['media']) || ! is_array($params['media'])) {
            return $attachments;
        }

        foreach ($params['media'] as $key => $media) {
            if (! $media instanceof InputMedia) {
                continue;
            }

            $parts = [$media->extractAttachment('__ATTACHED_FILE__'.$key)];
            foreach (self::MEDIA_ATTACHMENT_PREFIXES as $field => $prefix) {
                $parts[] = $media->extractAttachment($prefix.$key, $field);
            }

            $params['media'][$key] = $media->toArray();
            foreach ($parts as $part) {
                if ($part) {
                    $attachments[] = $part;
                }
            }
        }

        $params['media'] = json_encode($params['media']);

        return $attachments;
    }
}
