<?php

namespace Flinks;

use PHPUnit\Framework\TestCase;
require_once "../SDK/FlinksClient.php";

class FlinksClientTest extends TestCase
{
    /*public function testConstructorThrowsNullException()
    {
        $thrown_exception = new FlinksClient("","");
        $this->expectExceptionObject($thrown_exception);
    }*/

    public function testAuthorize()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $good_response = $good_client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);

        $this->assertEquals(200, $good_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::AUTHORIZED, $good_client->GetClientStatus());
    }

    public function testAuthorizeWithLoginId()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $cached_client = $good_client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $cached_client_login_array = (array) $cached_client->getLogin();
        $loginId = $cached_client_login_array["Id"];
        $good_response = $good_client->AuthorizeWithLoginId($loginId);

        $this->assertEquals(200, $good_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::AUTHORIZED, $good_client->GetClientStatus());
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
        $authorized_client = $good_client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $requestId = $authorized_client->getRequestId();
        $good_response = $good_client->GetAccountsSummary($requestId);

        $this->assertNotNull($good_response->getAccounts());
        $this->assertEquals($authorized_client->getRequestId(), $good_response->getRequestId());
        $this->assertEquals(200, $good_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::AUTHORIZED, $good_client->GetClientStatus());
    }
}
