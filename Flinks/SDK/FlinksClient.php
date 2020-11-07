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

    public function GetAuthToken(): string
    {
        return $this->AuthToken;
    }

    public function SetAuthToken(string $AuthToken = null): string
    {
        $this->AuthToken = $AuthToken;
        return $this;
    }

    public function __construct(string $customerId, string $instance)
    {
        $this->CustomerId = $customerId;
        $this->Instance  = $instance;
        $this->AuthToken = null;
    }

    public function GenerateAuthorizeToken(string $secret_key): array
    {
        $client = new Client([
            "base_uri" => "https://{$this->GetInstance()}-api.private.fin.ag/v3/{$this->GetCustomerId()}",
        ]);

        $response = $client->request('POST', '/BankingServices/GenerateAuthorizeToken', [
            "headers" => [
                'flinks-auth-key' => $secret_key
            ]
        ]);

        $body = $response->getBody();
        $arr_body = json_decode($body);

        if($response->getStatusCode() == 200)
        {
            $this->SetAuthToken($arr_body["Token"]);
        }

        return($arr_body);
    }

    public function Authorize(string $institution, string $username, string $password, bool $mostRecentCached, bool $save): array
    {
        $client = new Client([
            'base_uri' => "https://{$this->GetInstance()}-api.private.fin.ag/v3/{$this->GetCustomerId()}",
        ]);

        $response = $client->request('POST', '/BankingServices/Authorize', [
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
        $arr_body = json_decode($body);
        return($arr_body);
    }

    public function AuthorizeWithLoginId(string $loginId): array
    {
        $client = new Client([
            'base_uri' => "https://{$this->GetInstance()}-api.private.fin.ag/v3/{$this->GetCustomerId()}",
        ]);

        $response = $client->request('POST', '/BankingServices/Authorize', [
            "headers" => [
                "Content-Type" => "application/json"
            ],
            'json' => [
                "LoginId" => $loginId,
                "MostRecentCached" => true
            ]
        ]);

        $body = $response->getBody();
        $arr_body = json_decode($body);
        return($arr_body);
    }
}

//tests

$client1 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
$client1->GenerateAuthorizeToken("TheSecretKey");

//$client2 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
//$status2 = $client2->Authorize("FlinksCapital", "Greatday", "Everyday", false, true);
//print_r($status2);

