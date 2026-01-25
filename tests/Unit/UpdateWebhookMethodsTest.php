<?php

namespace Telegram\Bot\Tests\Unit;

use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\Update;
use Telegram\Bot\Objects\WebhookInfo;
use Telegram\Bot\Requests\DeleteWebhookRequest;
use Telegram\Bot\Requests\GetUpdatesRequest;
use Telegram\Bot\Requests\SetWebhookRequest;
use Telegram\Bot\Tests\Mocks\Mocker;

class UpdateWebhookMethodsTest extends TestCase
{
    /** @test */
    public function it_returns_a_webhook_info_object_when_get_webhook_info_is_called()
    {
        $api = Mocker::createApiResponse(
            [
                'url' => 'https://example.com/webhook',
                'has_custom_certificate' => false,
                'pending_update_count' => 0,
            ]
        );

        /** @var WebhookInfo $response */
        $response = $api->getWebhookInfo();

        $this->assertInstanceOf(WebhookInfo::class, $response);
        $this->assertEquals('https://example.com/webhook', $response->getUrl());
        $this->assertFalse($response->getHasCustomCertificate());
    }

    /** @test */
    public function it_returns_updates_collection_when_get_updates_is_called_with_request_object()
    {
        $api = Mocker::createApiResponse(
            [
                ['update_id' => 1],
                ['update_id' => 2],
            ]
        );

        $request = (new GetUpdatesRequest)->setLimit(2);
        $response = $api->getUpdates($request);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(2, $response);
        $this->assertInstanceOf(Update::class, $response->first());
        $this->assertEquals(1, $response->first()->getUpdateId());
    }

    /** @test */
    public function it_handles_typed_request_objects_with_handle_request()
    {
        $api = Mocker::createApiResponse(
            [
                ['update_id' => 99],
            ]
        );

        $request = (new GetUpdatesRequest)->setLimit(1);
        $response = $api->handleRequest($request);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertInstanceOf(Update::class, $response->first());
        $this->assertEquals(99, $response->first()->getUpdateId());
    }

    /** @test */
    public function it_sets_webhook_when_request_object_is_used()
    {
        $api = Mocker::createApiResponse(true);

        $request = new SetWebhookRequest('https://example.com/webhook');
        $response = $api->setWebhook($request);

        $this->assertTrue($response);
    }

    /** @test */
    public function it_throws_validation_exception_when_set_webhook_request_is_invalid()
    {
        $api = Mocker::createApiResponse(true);
        $request = new SetWebhookRequest('http://example.com/webhook');

        $this->expectException(TelegramValidationException::class);

        $api->setWebhook($request);
    }

    /** @test */
    public function it_deletes_webhook_with_request_object_params()
    {
        $api = Mocker::createApiResponse(true);

        $request = (new DeleteWebhookRequest)->setDropPendingUpdates(true);
        $response = $api->deleteWebhook($request);

        $this->assertTrue($response);
    }

}

