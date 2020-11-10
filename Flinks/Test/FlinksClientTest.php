<?php

namespace Flinks;

use PHPUnit\Framework\TestCase;
require_once "../SDK/FlinksClient.php";

class FlinksClientTest extends TestCase
{
    /*public function testConstructor()
    {
        $bad_client = new FlinksClient("","");

    }*/

    public function testAuthorize()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $good_response = $good_client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $good_array_response = (array) $good_response;

        $this->assertEquals(200, $good_array_response["HttpStatusCode"]);
    }

    public function testAuthorizeWithLoginId()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $good_response = $good_client->AuthorizeWithLoginId("b4c824ca-28a0-4a5a-3208-08d883ee0a9c");
        $good_array_response = (array) $good_response;

        $this->assertEquals(200, $good_array_response["HttpStatusCode"]);
    }

    public function testGenerateAuthorizeToken()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
        $good_response = $good_client->GenerateAuthorizeToken("TheSecretKey");
        $good_array_response = (array) $good_response;

        $this->assertEquals(200, $good_array_response["HttpStatusCode"]);
    }
}
