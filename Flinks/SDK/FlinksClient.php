<?php

namespace Flinks;

require_once "../../vendor/autoload.php";

use GuzzleHttp\Client;

class FlinksClient
{
    private $CustomerId;

    private $Instance;

    private $AuthToken;

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
        $this->CustomerId = $customerId;
        $this->Instance  = $instance;
        $this->AuthToken = null;
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
}

//tests

$client1 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
$response1 = $client1->GenerateAuthorizeToken("TheSecretKey");
print_r($response1);

$client2 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
$response2 = $client2->Authorize("FlinksCapital", "Greatday", "Everyday", false, true);
print_r($response2);

//$client3 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
//$response3 = $client3->AuthorizeWithLoginId("");
//print_r($response3);

