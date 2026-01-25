<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\CloseRequest;
use Telegram\Bot\Requests\LogOutRequest;
use Telegram\Bot\Tests\Mocks\Mocker;

class GeneralMethodsTest extends TestCase
{
    /** @test */
    public function it_logs_out_from_cloud_server()
    {
        $api = Mocker::createApiResponse(true);

        $response = $api->logOut();

        $this->assertTrue($response);
    }

    /** @test */
    public function it_logs_out_with_request_object()
    {
        $api = Mocker::createApiResponse(true);

        $request = new LogOutRequest;
        $response = $api->logOut($request);

        $this->assertTrue($response);
    }

    /** @test */
    public function it_closes_bot_instance()
    {
        $api = Mocker::createApiResponse(true);

        $response = $api->close();

        $this->assertTrue($response);
    }

    /** @test */
    public function it_closes_with_request_object()
    {
        $api = Mocker::createApiResponse(true);

        $request = new CloseRequest;
        $response = $api->close($request);

        $this->assertTrue($response);
    }

    /** @test */
    public function log_out_request_has_correct_method_name()
    {
        $request = new LogOutRequest;

        $this->assertEquals('logOut', $request->getMethod());
        $this->assertEmpty($request->toArray());
    }

    /** @test */
    public function close_request_has_correct_method_name()
    {
        $request = new CloseRequest;

        $this->assertEquals('close', $request->getMethod());
        $this->assertEmpty($request->toArray());
    }
}
