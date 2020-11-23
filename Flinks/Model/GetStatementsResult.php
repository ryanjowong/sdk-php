<?php
namespace Flinks;

class GetStatementsResult
{
    protected ?string $FlinksCode;
    protected ?array $Links;
    protected int $HttpStatusCode;
    protected ?array $StatementsByAccount;
    protected ?Object $Login;
    protected ?string $Institution;
    protected ?string $Message;
    protected ?string $RequestId;

    public function __construct(string $FlinksCode = null, array $Links = null, int $HttpStatusCode, array $StatementsByAccount = null,
                                Object $Login = null, string $Institution = null, string $Message = null, string $RequestId = null)
    {
        $this->FlinksCode = $FlinksCode;
        $this->Links = $Links;
        $this->HttpStatusCode = $HttpStatusCode;
        $this->Accounts = $StatementsByAccount;
        $this->Login = $Login;
        $this->Institution = $Institution;
        $this->Message = $Message;
        $this->RequestId = $RequestId;
    }

    public function getFlinksCode(): string
    {
        return $this->FlinksCode;
    }

    public function setFlinksCode(string $FlinksCode): void
    {
        $this->FlinksCode =$FlinksCode;
    }

    public function getLinks(): array
    {
        return $this->Links;
    }

    public function setLinks(array $Links): void
    {
        $this->Links = $Links;
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

    public function setAccounts(array $StatementsByAccount): void
    {
        $this->Accounts = $StatementsByAccount;
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

    public function getMessage(): string
    {
        return $this->Message;
    }

    public function setMessage(string $Message): void
    {
        $this->Message = $Message;
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