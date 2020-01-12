<?php

namespace devprojoh\Press\Console;

use devprojoh\Press\Post;
use devprojoh\Press\Press;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        if (Press::configNotPublished()) {
            return $this->warn('Please publish the config file by running ' .
                '\'php artisan vendor:publish --tag=press-config\'');
        }

        $posts = Press::driver()->fetchPosts();

        try {
            foreach ($posts as $post) {
                Post::create([
                    'identifier' => $post['identifier'],
                    'slug' => Str::slug($post['title']),
                    'title' => $post['title'],
                    'body' => $post['body'],
                    'extra' => $post['extra'] ?? [],
                ]);
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
