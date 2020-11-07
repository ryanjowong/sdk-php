<?php

namespace Flinks;

use PHPUnit\Framework\TestCase;

class FlinksClientTest extends TestCase
{

    public function testAuthorize()
    {

    }

    public function testAuthorizeWithLoginId()
    {

    }

    public function testGenerateAuthorizeToken()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
        $response = $client->GenerateAuthorizeToken("TheSecretKey");

        $this->assertEquals(200, $response->getStatusCode());
    }
}
