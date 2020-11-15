<?php

namespace Flinks;

use PHPUnit\Framework\TestCase;
require_once "../SDK/FlinksClient.php";

class FlinksClientTest extends TestCase
{
    /*public function testConstructorThrowsNullException()
    {
        $client = new FlinksClient("", "");
        $this->expectException();
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
        $this->assertNotNull($good_response->getToken());
    }

    /*public function testWrongSecretKeyGenerateAuthorizeToken()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
        $response = $client->GenerateAuthorizeToken("TheWrongSecretKey");

        $this->assertEquals(401, $response->getHttpStatusCode());
        $this->assertEquals("UNAUTHORIZED", $response->getFlinksCode());
    }*/

    public function testGetAccountsSummary()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $authorized_client = $good_client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $requestId = $authorized_client->getRequestId();
        $good_response = $good_client->GetAccountsSummary($requestId);

        $this->assertNotNull($good_response->getAccounts());
        $this->assertNotNull($good_response->getLogin());
        $this->assertNotNull($good_response->getInstitution());
        $this->assertEquals($authorized_client->getRequestId(), $good_response->getRequestId());
        $this->assertEquals(200, $good_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::AUTHORIZED, $good_client->GetClientStatus());
    }

    public function testGetAccountsSummaryAsync()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $authorized_client = $good_client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $requestId = $authorized_client->getRequestId();
        $good_response = $good_client->GetAccountsSummaryAsync($requestId);

        if($good_response->getHttpStatusCode() == 200)
        {
            $this->assertNotNull($good_response->getAccounts());
            $this->assertNotNull($good_response->getLogin());
            $this->assertNotNull($good_response->getInstitution());
            $this->assertEquals($authorized_client->getRequestId(), $good_response->getRequestId());
            $this->assertEquals(200, $good_response->getHttpStatusCode());
            $this->assertEquals(ClientStatus::AUTHORIZED, $good_client->GetClientStatus());
        }
        if($good_response->getHttpStatusCode() == 202)
        {
            $this->assertNotNull($good_response->getFlinksCode());
            $this->assertNotNull($good_response->getLinks());
            $this->assertNotNull($good_response->getMessage());
            $this->assertEquals($authorized_client->getRequestId(), $good_response->getRequestId());
            $this->assertEquals(202, $good_response->getHttpStatusCode());
        }
    }
}
