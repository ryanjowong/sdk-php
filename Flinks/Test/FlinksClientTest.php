<?php

namespace Flinks;

use PHPUnit\Framework\TestCase;
require_once "../SDK/FlinksClient.php";

class FlinksClientTest extends TestCase
{
    /*public function testConstructorThrowsNullException()
    {
        new FlinksClient("", "");
        $this->expectException();
    }*/

    public function testAuthorize()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $good_response = $good_client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);

        $this->assertEquals(200, $good_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::AUTHORIZED, $good_client->GetClientStatus());
    }

    public function test401Authorize()
    {
        $bad_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $bad_response = $bad_client->Authorize("FlinksCapital", "Greatday", "WrongPassword", false,);

        $this->assertEquals(401, $bad_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::UNAUTHORIZED, $bad_client->GetClientStatus());
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

    public function test400AuthorizeWithLoginId()
    {
        $bad_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $bad_response = $bad_client->AuthorizeWithLoginId("e86a6f65-f486-4018-52a6-08d885d6c2f0");

        $this->assertEquals(400, $bad_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::BAD_REQUEST, $bad_client->GetClientStatus());
    }

    public function testGenerateAuthorizeToken()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
        $good_response = $good_client->GenerateAuthorizeToken("TheSecretKey");

        $this->assertEquals(200, $good_response->getHttpStatusCode());
        $this->assertNotNull($good_response->getToken());
    }

    public function testWrongSecretKeyGenerateAuthorizeToken()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
        $response = $client->GenerateAuthorizeToken("TheWrongSecretKey");

        $this->assertEquals(401, $response->getHttpStatusCode());
        $this->assertEquals("UNAUTHORIZED", $response->getFlinksCode());
    }

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

    public function test400GetAccountsSummary()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $bad_response = $client->GetAccountsSummary("883faa95-a3f5-4ff3-98fe-03d5d6b5862a");

        $this->assertEquals(400, $bad_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::BAD_REQUEST, $client->GetClientStatus());
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

    public function test400GetAccountsSummaryAsync()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $bad_response = $client->GetAccountsSummaryAsync("883faa95-a3f5-4ff3-98fe-03d5d6b5862a");

        $this->assertEquals(400, $bad_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::BAD_REQUEST, $client->GetClientStatus());
    }

    public function testGetAccountsDetail()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $authorized_client = $client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $requestId = $authorized_client->getRequestId();
        $response = $client->GetAccountsDetail($requestId);

        $this->assertNotNull($response->getAccounts());
        $this->assertNotNull($response->getLogin());
        $this->assertEquals($authorized_client->getRequestId(), $response->getRequestId());
        $this->assertEquals(200, $response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::AUTHORIZED, $client->GetClientStatus());
    }

    public function test400GetAccountsDetail()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $bad_response = $client->GetAccountsDetail("883faa95-a3f5-4ff3-98fe-03d5d6b5862a");

        $this->assertEquals(400, $bad_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::BAD_REQUEST, $client->GetClientStatus());
    }

    public function testGetAccountsDetailAsync()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $authorized_client = $good_client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $requestId = $authorized_client->getRequestId();
        $good_response = $good_client->GetAccountsDetailAsync($requestId);

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

    public function test400GetAccountsDetailAsync()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $bad_response = $client->GetAccountsDetailAsync("883faa95-a3f5-4ff3-98fe-03d5d6b5862a");

        $this->assertEquals(400, $bad_response->getHttpStatusCode());
        $this->assertEquals(ClientStatus::BAD_REQUEST, $client->GetClientStatus());
    }

    public function test200GetStatements()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $authorized_client = $good_client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $requestId = $authorized_client->getRequestId();
        $good_response = $good_client->GetStatements($requestId);

        $this->assertEquals(200, $good_response->getHttpStatusCode());
        $this->assertNotNull($good_response->getAccounts());
        $this->assertEquals(ClientStatus::AUTHORIZED, $good_client->GetClientStatus());
    }

    public function test400GetStatements()
    {
        $client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $client->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
        $bad_response = $client->GetStatements("883faa95-a3f5-4ff3-98fe-03d5d6b5862a");

        $this->assertEquals(400, $bad_response->getHttpStatusCode());
        $this->assertNotNull($bad_response->getMessage());
        $this->assertEquals(ClientStatus::BAD_REQUEST, $client->GetClientStatus());
    }

    public function testDeleteCard()
    {
        $good_client = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
        $loginId = "6117943d-f9d0-4a3a-b38c-08d88f1492f7";
        $response = $good_client->DeleteCard($loginId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("All of the information about LoginId {$loginId} has been removed", $response->getMessage());
        $this->assertEquals(ClientStatus::AUTHORIZED, $good_client->GetClientStatus());
    }
}
