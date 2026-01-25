<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetStarTransactionsRequest;

class GetStarTransactionsRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetStarTransactionsRequest();
        $request->offset(10);
        $request->limit(20);

        $array = $request->toArray();

        $this->assertEquals(10, $array['offset']);
        $this->assertEquals(20, $array['limit']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetStarTransactionsRequest();
        $this->assertEquals('getStarTransactions', $request->getMethod());
    }
}
