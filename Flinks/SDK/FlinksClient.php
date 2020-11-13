<?php

namespace Flinks;

require_once "../../vendor/autoload.php";
require_once "../Model/EndpointConstant.php";
require_once "../Model/ClientStatus.php";
require_once "../Model/AuthTokenResult.php";
require_once "../Model/AuthorizeResult.php";
require_once "../Model/AccountsSummaryResult.php";

//use Flinks\AuthorizeRequestBody;
use Exception;
use GuzzleHttp\Client;

class FlinksClient
{
    private string $CustomerId;
    private string $Instance;
    private string $BaseUrl;
    //private AuthorizeRequestBody $AuthorizeBody;
    private int $ClientStatus;
    private ?string $AuthToken;

    public function GetCustomerId(): string
    {
        return $this->CustomerId;
    }

    public function GetInstance(): string
    {
        return $this->Instance;
    }

    public function GetClientStatus(): int
    {
        return $this->ClientStatus;
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
                throw new Exception("Null Reference Exception: customerId and instance can't be null");
            }
        }
        catch (Exception $message) {
            echo $message->getMessage();
        }

        $this->CustomerId = $customerId;
        $this->Instance = $instance;
        $this->BaseUrl = $this->GetBaseUrl();
        $this->AuthToken = null;
        $this->ClientStatus = ClientStatus::UNKNOWN;
    }

    public function Authorize(string $institution, string $username, string $password, bool $mostRecentCached, bool $save): Object
    {
        $client = new Client([
            'base_uri' => $this->BaseUrl,
        ]);

        $response = $client->request('POST', EndpointConstant::Authorize, [
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

        $this->SetClientStatus($response->getStatusCode());

        $decoded_response = $this->DecodeResponse($response);

        if($decoded_response["HttpStatusCode"] == 200)
        {
            $apiResponse = new AuthorizeResult($decoded_response["Links"], $decoded_response["HttpStatusCode"],
                $decoded_response["Login"], null, $decoded_response["Institution"], $decoded_response["RequestId"]);
        }
        if($decoded_response["HttpStatusCode"] == 203)
        {
            $apiResponse = new AuthorizeResult($decoded_response["Links"], $decoded_response["HttpStatusCode"],
                null, $decoded_response["SecurityChallenges"], $decoded_response["Institution"], $decoded_response["RequestId"]);
        }

        return $apiResponse;
    }

    public function AuthorizeWithLoginId(string $loginId): Object
    {
        $client = new Client([
            'base_uri' => $this->BaseUrl,
        ]);

        $response = $client->request('POST', EndpointConstant::Authorize, [
            "headers" => [
                "Content-Type" => "application/json"
            ],
            'json' => [
                "LoginId" => $loginId,
                "MostRecentCached" => true
            ]
        ]);

        $this->SetClientStatus($response->getStatusCode());

        $decoded_response = $this->DecodeResponse($response);

        if($decoded_response["HttpStatusCode"] == 200)
        {
            $apiResponse = new AuthorizeResult($decoded_response["Links"], $decoded_response["HttpStatusCode"],
                $decoded_response["Login"], null, $decoded_response["Institution"], $decoded_response["RequestId"]);
        }

        return $apiResponse;
    }

    public function GenerateAuthorizeToken(string $secret_key): Object
    {
        $client = new Client([
            "base_uri" => $this->BaseUrl,
        ]);

        $response = $client->request('POST', EndpointConstant::GenerateAuthorizeToken, [
            "headers" => [
                'flinks-auth-key' => $secret_key
            ]
        ]);

        $decoded_response = $this->DecodeResponse($response);

        if($decoded_response["HttpStatusCode"] == 200)
        {
            $apiResponse = new AuthTokenResult($decoded_response["HttpStatusCode"], $decoded_response["Token"]);
            $this->SetAuthToken($apiResponse->getToken());
        }

        return $apiResponse;
    }

    public function GetAccountsSummary(string $requestId): Object
    {
        if (!($this->IsClientStatusAuthorized()))
        {
            throw new Exception("You can't call GetAccountsSummary when the ClientStatus is not Authorized, you current status is: {$this->GetClientStatus()}.");
        }

        $client = new Client([
            'base_uri' => $this->BaseUrl,
        ]);

        $response = $client->request('POST', EndpointConstant::GetAccountsSummary, [
            "headers" => [
                "Content-Type" => "application/json"
            ],
            'json' => [
                "RequestId" => $requestId,
            ]
        ]);

        $decoded_response = $this->DecodeResponse($response);

        if($decoded_response["HttpStatusCode"] == 200)
        {
            $apiResponse = new AccountsSummaryResult($decoded_response["HttpStatusCode"], $decoded_response["Accounts"],
                $decoded_response["Login"], $decoded_response["Institution"], $decoded_response["RequestId"]);
        }

        return $apiResponse;
    }

    //Helper functions
    private function GetBaseUrl(): string
    {
        $endpoint = new EndpointConstant();
        return $endpoint->BaseUrl($this->GetInstance(), $this->GetCustomerId());
    }

    private function DecodeResponse($response): array
    {
        $body = $response->getBody();
        return ((array) json_decode($body));
    }

    private function SetClientStatus(int $httpStatusCode): void
    {
        switch ($httpStatusCode)
        {
            case 203:
                $this->ClientStatus = ClientStatus::PENDING_MFA_ANSWERS;
                break;
            case 200:
                $this->ClientStatus = ClientStatus::AUTHORIZED;
                break;
            case 401:
                $this->ClientStatus = ClientStatus::UNAUTHORIZED;
                break;
            default:
                $this->ClientStatus = ClientStatus::UNKNOWN;
        }
    }

    private function IsClientStatusAuthorized(): bool
    {
        return ($this->ClientStatus == ClientStatus::AUTHORIZED);
    }
}

//build to tests
new FlinksClient("","");
print("\n");
/*Authorize with a 203 status code response
$client1 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
$response_203 = $client1->Authorize("FlinksCapital", "Greatday", "Everyday", false, true);
print_r($response_203);
print("\n");*/
//Authorize with a 200 status code response
$client2 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "toolbox");
$response1 = $client2->Authorize("FlinksCapital", "Greatday", "Everyday", true, true);
print_r($response1);
print("\n");
//AuthorizeWithLoginId with a 200 status code response
$response2 = $client2->AuthorizeWithLoginId("e86a6f65-f486-4018-52a6-08d885d6c2f9");
print_r($response2);
print("\n");
//GenerateAuthorizeToken with a 200 status code response
$client3 = new FlinksClient("43387ca6-0391-4c82-857d-70d95f087ecb", "demo");
$response3 = $client3->GenerateAuthorizeToken("TheSecretKey");
print_r($response3);
print("\n");
//GetAccountsSummary with a 200 status code response
$requestId = $response2->getRequestId();
$response4 = $client2->GetAccountsSummary($requestId);
print_r($response4);