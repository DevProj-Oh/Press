<?php

namespace devprojoh\Press;

class Press
{
    public static function configNotPublished()
    {
        return is_null(config('press'));
    }

    public static function driver()
    {
        $driver = ucwords(config('press.driver'));
        $class = 'devprojoh\\Press\\Drivers\\' . $driver . 'Driver';

        return new $class;
    }
}
