<?php

namespace Flinks;

require_once "../../vendor/autoload.php";

use GuzzleHttp\Client;

class FlinksClient
{
    private $CustomerId;

    private $Instance;

    private $AuthToken;
    /**
     * @return string
     */
    public function GetCustomerId()
    {
        return $this->CustomerId;
    }
    /**
     * @return string
     */
    public function GetInstance()
    {
        return $this->Instance;
    }
    /**
     * @return string
     */
    public function GetAuthToken()
    {
        return $this->AuthToken;
    }
    /**
     * @param string $AuthToken
     *
     * @return self
     */
    public function SetAuthToken($AuthToken)
    {
        $this->AuthToken = $AuthToken;
        return $this;
    }

    /**
     * @param string            $customerId
     * @param string            $instance
     */
    public function __construct($customerId, $instance)
    {
        $this->CustomerId = $customerId;
        $this->Instance  = $instance;
        $this->AuthToken = null;
    }

    public function foo()
    {
        $instance = $this->GetInstance();
        $customerId = $this->GetCustomerId();

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => "https://{$instance}-api.private.fin.ag/v3/{$customerId}",
            //'verify' => false,
        ]);

        $response = $client->request('POST', '/BankingServices/GetAccountsDetail', [
            'json' => [
                'LoginId' => 'fd8537cd-0118-4a2b-c4ad-08d6b6ae68da',
                'MostRecentCached' => true
            ]
        ]);

        //get status code using $response->getStatusCode();

        $body = $response->getBody();
        $arr_body = json_decode($body);
        print_r($arr_body);
        return($response);
    }

    /**
     * @param string            $secret_key
     *
     * @return AuthTokenResult|null
     */
    public function GenerateAuthorizeToken($secret_key)
    {
        //$instance = $this->GetInstance();
        //$customerId = $this->GetCustomerId();

        $client = new Client([
            'base_uri' => "https://{$this->GetInstance()}-api.private.fin.ag/v3/{$this->GetCustomerId()}",
        ]);

        $response = $client->request('POST', '/BankingServices/GenerateAuthorizeToken', [
            "headers" => [
                "flinks-auth-key" => $secret_key
            ]
        ]);

        $body = $response->getBody();
        $arr_body = json_decode($body);

        if($response->getStatusCode() == 200)
        {
            //$AuthToken->SetAuthToken();
        }

        print_r($arr_body);
        return($response);
    }

    public function Authorize($institution, $username, $password, $mostRecentCached, $save)
    {
        //$instance = $this->GetInstance();
        //$customerId = $this->GetCustomerId();

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
        print_r($arr_body);
        return($response);
    }

    public function AuthorizeWithLoginId($loginId)
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
        print_r($arr_body);
        return($response);
    }
}

//tests
/*$a = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
$b = $a->foo();
print_r($b->getStatusCode());
print_r($b->getReasonPhrase());

$client1 = new FlinksClient("00000000-0000-0000-0000-000000000000", "demo");
$status = $client1->GenerateAuthorizeToken("TheSecretKey");
print_r($status->getStatusCode());
print_r($status->getReasonPhrase());
*/
$client2 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
$status = $client2->Authorize("FlinksCapital", "Greatday", "Everyday", false, true);
print_r($status->getStatusCode());
print_r($status->getReasonPhrase());
$body = $status->getBody();
print_r(json_decode($body));
