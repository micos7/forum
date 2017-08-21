<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function unauthenticated_users_may_not_add_replies(){
        
        $this->withExceptionHandling()->post('threads/some/1/replies',[])->assertRedirect('/login');
    }

    /** @test */
    function an_aunthenticated_user_may_participate_in_forum_threads()
    {
        $this->be(factory('App\User')->create());
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();

        $this->post($thread->path().'/replies',$reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    function a_reply_requires_a_body(){
        $this->withExceptionHandling()->signIn();

        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply',['body'=> null])->make();

        $this->post($thread->path().'/replies',$reply->toArray())->assertSessionHasErrors('body');
    }

}
