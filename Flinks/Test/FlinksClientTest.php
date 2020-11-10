<?php

namespace Flinks;

use PHPUnit\Framework\TestCase;
require_once "../SDK/FlinksClient.php";

class FlinksClientTest extends TestCase
{

    public function testAuthorize()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $response = $client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testAuthorizeWithLoginId()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $response = $client->AuthorizeWithLoginId("b4c824ca-28a0-4a5a-3208-08d883ee0a9c");

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGenerateAuthorizeToken()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
        $response = $client->GenerateAuthorizeToken("TheSecretKey");

        $this->assertEquals(200, $response->getStatusCode());
    }
}
