<?php

namespace Telegram\Bot\Tests\Unit;

use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\ChatBoost;
use Telegram\Bot\Objects\ChatBoostSource;
use Telegram\Bot\Objects\UserChatBoosts;

class UserChatBoostsTest extends TestCase
{
    public function test_it_maps_boosts_to_chat_boost_objects()
    {
        $boosts = new UserChatBoosts([
            'boosts' => [
                [
                    'boost_id' => 'boost-1',
                    'add_date' => 1700000000,
                    'expiration_date' => 1700001000,
                    'source' => [
                        'source' => 'premium',
                        'user' => [
                            'id' => 123,
                            'is_bot' => false,
                            'first_name' => 'Alex',
                        ],
                    ],
                ],
            ],
        ]);

        $collection = $boosts->getBoosts();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertInstanceOf(ChatBoost::class, $collection->first());
        $this->assertInstanceOf(ChatBoostSource::class, $collection->first()->getSource());
        $this->assertEquals('boost-1', $collection->first()->getBoostId());
    }
}
