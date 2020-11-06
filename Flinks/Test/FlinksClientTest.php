<?php

namespace Flinks;

use PHPUnit\Framework\TestCase;

class FlinksClientTest extends TestCase
{
    public function testFoo()
    {
        $i = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $val = $i->foo();

        $this->assertEquals(200, $val->getStatusCode());
    }
}