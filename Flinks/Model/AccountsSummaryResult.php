<?php

namespace Flinks;

class AccountsSummaryResult
{
    protected int $HttpStatusCode;
    protected array $Accounts;
    protected Object $Login;
    protected string $Institution;
    protected string $RequestId;

    public function __construct(int $HttpStatusCode, array $Accounts, Object $Login,
                                string $Institution, string $RequestId)
    {
        $this->HttpStatusCode = $HttpStatusCode;
        $this->Accounts = $Accounts;
        $this->Login = $Login;
        $this->Institution = $Institution;
        $this->RequestId = $RequestId;
    }

    public function getHttpStatusCode(): int
    {
        return $this->HttpStatusCode;
    }

    public function setHttpStatusCode(int $HttpStatusCode): void
    {
        $this->HttpStatusCode = $HttpStatusCode;
    }

    public function getAccounts(): array
    {
        return $this->Accounts;
    }

    public function setLinks(array $Accounts): void
    {
        $this->Accounts = $Accounts;
    }

    public function getLogin(): Object
    {
        return $this->Login;
    }

    public function setLogin(Object $Login): void
    {
        $this->Login = $Login;
    }

    public function getInstitution(): string
    {
        return $this->Institution;
    }

    public function setInstitution(string $Institution): void
    {
        $this->Institution = $Institution;
    }

    public function getRequestId(): string
    {
        return $this->RequestId;
    }

    public function setRequestId(string $RequestId): void
    {
        $this->RequestId = $RequestId;
    }
}