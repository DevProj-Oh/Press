<?php

namespace devprojoh\Press\Console;

use devprojoh\Press\Post;
use devprojoh\Press\PressFileParser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        if (is_null(config('press'))) {
            return $this->warn('Please publish the config file by running ' .
                '\'php artisan vendor:publish --tag=press-config\'');
        }

        $files = File::files(config('press.path'));

        // Process each file
        foreach ($files as $file) {
            $post = (new PressFileParser($file->getPathname()))->getData();
        }

        // Persist to the DB
        Post::create([
            'identifier' => Str::random(),
            'slug' => Str::slug($post['title']),
            'title' => $post['title'],
            'body' => $post['body'],
            'extra' => $post['extra'] ?? [],
        ]);
    }
}
