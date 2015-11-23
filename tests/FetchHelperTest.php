<?php

namespace NB\Tests\Utilities\Fetch;

use NB\Utilities\Fetch\FetchHelper;
use PHPUnit_Framework_TestCase;

class FetchHelperTest extends PHPUnit_Framework_TestCase
{
    public function testGets()
    {
        $f = new FetchHelper();

        $body = '{"applicationName":"NoteBowl Campus Solution","productRelease":"1.0","versions":{"1.0":"https:\/\/api.notebowl.com\/v1.0"}}';
        $this->assertEquals($f->get('https://api.notebowl.com'), $body);
    }

    public function testGetsRaw()
    {
    }

    public function testGetsResponseHeader()
    {
    }

    public function testGetsRetry()
    {
    }

    public function testGetsRetryRaw()
    {
    }
}
