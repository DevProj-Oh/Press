<?php

namespace devprojoh\Press\Tests;

use devprojoh\Press\PressFileParser;
use Orchestra\Testbench\TestCase;

class PressFileParserTest extends TestCase
{
    public function test_the_head_and_body_gets_split()
    {
        $pressFileParser = new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md');

        $data = $pressFileParser->getData();

        $this->assertStringContainsString('title: My Title', $data[1]);
        $this->assertStringContainsString('description: Description here', $data[1]);
        $this->assertStringContainsString('Post body here', $data[2]);
    }
}
