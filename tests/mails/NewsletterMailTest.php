<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use App\Mail\Newsletter;

use App\Post;
use App\User;

class NewsletterMailTest extends TestCase
{
    use DatabaseMigrations;

    public function testNewsletterMail()
    {
        $user = factory(User::class)->create();
        $posts = factory(Post::class, 10)->create();

        Mail::fake();

        Mail::to($user->email)->send(new Newsletter($posts, $user->email));

        Mail::assertSentTo([$user], Newsletter::class);
    }
}
