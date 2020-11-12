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
        $good_response = $good_client->AuthorizeWithLoginId("e86a6f65-f486-4018-52a6-08d885d6c2f9");
        $good_array_response = (array) $good_response;

        $this->assertEquals(200, $good_array_response["HttpStatusCode"]);
    }

    public function testGenerateAuthorizeToken()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
        $good_response = $good_client->GenerateAuthorizeToken("TheSecretKey");

        $this->assertEquals(200, $good_response->getHttpStatusCode());
        $this->assertNotNull($good_response->getHttpStatusCode());
    }

    public function testGetAccountsSummary()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $authorized_client = (array) $good_client->AuthorizeWithLoginId("e86a6f65-f486-4018-52a6-08d885d6c2f9");
        $requestId = $authorized_client["RequestId"];
        $good_response = $good_client->GetAccountsSummary($requestId);
        $good_array_response = (array) $good_response;

        $this->assertEquals(200, $good_array_response["HttpStatusCode"]);
    }
}
