<?php

namespace Flinks;

class AuthorizeResult
{
    protected ?array $Links;
    protected int $HttpStatusCode;
    protected ?Object $Login;
    protected ?array $SecurityChallenges;
    protected ?string $Message;
    protected ?string $FlinksCode;
    protected ?string $Institution;
    protected ?string $RequestId;

    public function __construct(array $Links = null, int $HttpStatusCode, Object $Login = null, array $SecurityChallenges = null,
                                string $Message = null, string $FlinksCode = null, string $Institution = null, string $RequestId = null)
    {
        $this->Links = $Links;
        $this->HttpStatusCode = $HttpStatusCode;
        $this->Login = $Login;
        $this->SecurityChallenges = $SecurityChallenges;
        $this->Message = $Message;
        $this->FlinksCode = $FlinksCode;
        $this->Institution = $Institution;
        $this->RequestId = $RequestId;
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

    public function getLogin(): ?Object
    {
        return $this->Login;
    }

    public function setLogin(Object $Login): void
    {
        $this->Login = $Login;
    }

    public function getSecurityChallenges(): ?array
    {
        return $this->SecurityChallenges;
    }

    public function setSecurityChallenges(array $SecurityChallenges): void
    {
        $this->SecurityChallenges = $SecurityChallenges;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(string $Message): void
    {
        $this->Message = $Message;
    }

    public function getFlinksCode(): ?string
    {
        return $this->FlinksCode;
    }

    public function setFlinksCode(string $FlinksCode): void
    {
        $this->FlinksCode = $FlinksCode;
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