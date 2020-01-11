<?php

namespace devprojoh\Press\Fields;

use devprojoh\Press\MarkdownParser;

class Body extends FieldContract
{
    public static function process($type, $value, $data)
    {
        return [$type => MarkdownParser::parse($value)];
    }
}
