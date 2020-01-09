<?php

namespace devprojoh\Press\Fields;

use Carbon\Carbon;

class Date implements FieldInterface
{
    public static function process($type, $value)
    {
        return [$type => Carbon::parse($value)];
    }
}
