<?php

namespace devprojoh\Press\Fields;

use devprojoh\Press\MarkdownParser;

class Body implements FieldInterface
{
    public static function process($type, $value)
    {
        return [$type => MarkdownParser::parse($value)];
    }
}
