<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\PromoteChatMemberRequest;

class PromoteChatMemberRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new PromoteChatMemberRequest(-100123456789, 0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new PromoteChatMemberRequest(-100123456789, 12345);
        $request->canManageChat(true)
                ->canDeleteMessages(true)
                ->canPromoteMembers(true);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(12345, $array['user_id']);
        $this->assertTrue($array['can_manage_chat']);
        $this->assertTrue($array['can_delete_messages']);
        $this->assertTrue($array['can_promote_members']);
    }

    public function test_it_sets_all_permission_flags()
    {
        $request = new PromoteChatMemberRequest(-100123456789, 12345);
        $request->isAnonymous(true)
                ->canManageVideoChats(true)
                ->canRestrictMembers(true)
                ->canChangeInfo(true)
                ->canInviteUsers(true)
                ->canPostStories(true)
                ->canEditStories(true)
                ->canDeleteStories(true)
                ->canPostMessages(true)
                ->canEditMessages(true)
                ->canPinMessages(true)
                ->canManageTopics(true);

        $array = $request->toArray();

        $this->assertArrayHasKey('is_anonymous', $array);
        $this->assertArrayHasKey('can_manage_video_chats', $array);
        $this->assertArrayHasKey('can_restrict_members', $array);
        $this->assertArrayHasKey('can_post_stories', $array);
        $this->assertArrayHasKey('can_manage_topics', $array);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new PromoteChatMemberRequest(-100123456789, 12345);
        $this->assertEquals('promoteChatMember', $request->getMethod());
    }
}
