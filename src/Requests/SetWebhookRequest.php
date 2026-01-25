<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;

/**
 * Request object for the setWebhook method.
 *
 * @link https://core.telegram.org/bots/api#setwebhook
 */
class SetWebhookRequest extends TelegramApiRequest
{
    protected string $url;

    protected InputFile|string|null $certificate = null;

    protected ?string $ipAddress = null;

    protected ?int $maxConnections = null;

    /** @var string[]|null */
    protected ?array $allowedUpdates = null;

    protected ?bool $dropPendingUpdates = null;

    protected ?string $secretToken = null;

    /**
     * Create a new SetWebhookRequest instance.
     *
     * @param  string  $url  HTTPS URL to send updates to
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'setWebhook';
    }

    /**
     * Set the webhook URL.
     *
     * @param  string  $url  HTTPS URL
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set the certificate for webhook verification.
     *
     * @param  InputFile|string  $certificate  Public key certificate
     * @return $this
     */
    public function setCertificate(InputFile|string $certificate): self
    {
        $this->certificate = $certificate;

        return $this;
    }

    /**
     * Set a fixed IP address for webhook requests.
     *
     * @param  string  $ipAddress  IP address
     * @return $this
     */
    public function setIpAddress(string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Set maximum simultaneous HTTPS connections.
     *
     * @param  int  $maxConnections  Number of connections (1-100)
     * @return $this
     */
    public function setMaxConnections(int $maxConnections): self
    {
        $this->maxConnections = $maxConnections;

        return $this;
    }

    /**
     * Set allowed update types.
     *
     * @param  string[]  $allowedUpdates  List of update types
     * @return $this
     */
    public function setAllowedUpdates(array $allowedUpdates): self
    {
        $this->allowedUpdates = $allowedUpdates;

        return $this;
    }

    /**
     * Set whether to drop pending updates.
     *
     * @param  bool  $dropPendingUpdates  Pass true to drop pending updates
     * @return $this
     */
    public function setDropPendingUpdates(bool $dropPendingUpdates): self
    {
        $this->dropPendingUpdates = $dropPendingUpdates;

        return $this;
    }

    /**
     * Set a secret token for webhook verification.
     *
     * @param  string  $secretToken  Secret token (1-256 chars, A-Za-z0-9_-)
     * @return $this
     */
    public function setSecretToken(string $secretToken): self
    {
        $this->secretToken = $secretToken;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (filter_var($this->url, FILTER_VALIDATE_URL) === false) {
            throw new TelegramValidationException('Invalid URL provided');
        }

        if (parse_url($this->url, PHP_URL_SCHEME) !== 'https') {
            throw new TelegramValidationException('Invalid URL, should be a HTTPS url.');
        }

        if ($this->maxConnections !== null && ($this->maxConnections < 1 || $this->maxConnections > 100)) {
            throw new TelegramValidationException('max_connections must be between 1 and 100');
        }

        if ($this->secretToken !== null) {
            if (strlen($this->secretToken) < 1 || strlen($this->secretToken) > 256) {
                throw new TelegramValidationException('secret_token must be 1-256 characters');
            }

            if (! preg_match('/^[A-Za-z0-9_-]+$/', $this->secretToken)) {
                throw new TelegramValidationException('secret_token may only contain A-Z, a-z, 0-9, _ and -');
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function buildParams(): array
    {
        return [
            'url' => $this->url,
            'certificate' => $this->certificate,
            'ip_address' => $this->ipAddress,
            'max_connections' => $this->maxConnections,
            'allowed_updates' => $this->allowedUpdates,
            'drop_pending_updates' => $this->dropPendingUpdates,
            'secret_token' => $this->secretToken,
        ];
    }
}
