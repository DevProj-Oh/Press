<?php

namespace devprojoh\Press;

class Press
{
    public function configNotPublished()
    {
        return is_null(config('press'));
    }

    public function driver()
    {
        $driver = ucwords(config('press.driver'));
        $class = 'devprojoh\\Press\\Drivers\\' . $driver . 'Driver';

        return new $class;
    }

    public function path()
    {
        return config('press.path', 'blogs');
    }
}
