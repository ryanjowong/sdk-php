<?php

namespace Flinks;

require_once "../../vendor/autoload.php";

use AuthorizeRequestBody;
use ClientStatus;
use Exception;
use GuzzleHttp\Client;

class FlinksClient
{
    private string $CustomerId;
    private string $Instance;
    private string $BaseUrl;
    private AuthorizeRequestBody $AuthorizeBody;
    private ClientStatus $ClientStatus;
    private ?string $AuthToken;

    public function GetCustomerId(): string
    {
        return $this->CustomerId;
    }

    public function GetInstance(): string
    {
        return $this->Instance;
    }

    public function GetAuthToken(): ?string
    {
        return $this->AuthToken;
    }

    public function SetAuthToken(string $AuthToken): void
    {
        $this->AuthToken = $AuthToken;
    }

    public function __construct(string $customerId, string $instance)
    {
        try {
            if (is_null($customerId) || empty($customerId) || is_null($instance) || empty($instance))
            {
                throw new Exception("The properties customerId and instance can't be null.");
            }
        }
        catch (Exception $message) {
            echo $message->getMessage();
        }

        $this->CustomerId = $customerId;
        $this->Instance = $instance;
        $this->AuthToken = null;
    }

    public function Authorize(string $institution, string $username, string $password, bool $mostRecentCached, bool $save): Object
    {
        $client = new Client([
            'base_uri' => "https://{$this->GetInstance()}-api.private.fin.ag/v3/{$this->GetCustomerId()}/",
        ]);

        $response = $client->request('POST', 'BankingServices/Authorize', [
            "headers" => [
                "Content-Type" => "application/json"
            ],
            'json' => [
                'Institution' => $institution,
                'username' => $username,
                'Password' => $password,
                'MostRecentCached' => $mostRecentCached,
                'Save' => $save
            ]
        ]);

        $body = $response->getBody();
        $object_body = json_decode($body);
        return($object_body);
    }

    public function AuthorizeWithLoginId(string $loginId): Object
    {
        $client = new Client([
            'base_uri' => "https://{$this->GetInstance()}-api.private.fin.ag/v3/{$this->GetCustomerId()}/",
        ]);

        $response = $client->request('POST', 'BankingServices/Authorize', [
            "headers" => [
                "Content-Type" => "application/json"
            ],
            'json' => [
                "LoginId" => $loginId,
                "MostRecentCached" => true
            ]
        ]);

        $body = $response->getBody();
        $object_body = json_decode($body);
        return($object_body);
    }

    public function GenerateAuthorizeToken(string $secret_key): Object
    {
        $client = new Client([
            "base_uri" => "https://{$this->GetInstance()}-api.private.fin.ag/v3/{$this->GetCustomerId()}/",
        ]);

        $response = $client->request('POST', 'BankingServices/GenerateAuthorizeToken', [
            "headers" => [
                'flinks-auth-key' => $secret_key
            ]
        ]);

        $body = $response->getBody();
        $object_body = json_decode($body);
        $array_body = (array) json_decode($body);

        if($response->getStatusCode() == 200)
        {
            $this->SetAuthToken($array_body["Token"]);
        }

        return($object_body);
    }
}

//tests

new FlinksClient("","");
print("<br>\n");
$client1 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
$response1 = $client1->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
print_r($response1);
print("<br>\n");
$response2 = $client1->AuthorizeWithLoginId("b4c824ca-28a0-4a5a-3208-08d883ee0a9c");
print_r($response2);
print("<br>\n");
$client2 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
$response3 = $client2->GenerateAuthorizeToken("TheSecretKey");
print_r($response3);