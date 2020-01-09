<?php

namespace devprojoh\Press\Tests;

use Carbon\Carbon;
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
        $this->assertStringContainsString('Blog post body here', $data[2]);
    }

    public function test_a_string_can_also_be_used_instead()
    {
        $pressFileParser = new PressFileParser("---\ntitle: My Title\n---\nPost body here");

        $data = $pressFileParser->getData();

        $this->assertStringContainsString('title: My Title', $data[1]);
        $this->assertStringContainsString('Post body here', $data[2]);
    }

    public function test_each_head_field_gets_separated()
    {
        $pressFileParser = new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md');

        $data = $pressFileParser->getData();

        $this->assertEquals('My Title', $data['title']);
        $this->assertEquals('Description here', $data['description']);
    }

    public function test_the_body_gets_saved_and_trimmed()
    {
        $pressFileParser = new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md');

        $data = $pressFileParser->getData();

        $this->assertEquals("<h1>Heading</h1>\n<p>Blog post body here</p>", $data['body']);
    }

    public function test_a_date_field_gets_parsed()
    {
        $pressFileParser = new PressFileParser("---\ndate: May 14, 1988\n---\n");

        $data = $pressFileParser->getData();

        $this->assertInstanceOf(Carbon::class, $data['date']);
        $this->assertEquals('05/14/1988', $data['date']->format('m/d/Y'));
    }
}
