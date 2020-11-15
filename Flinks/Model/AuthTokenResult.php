<?php

namespace Flinks;

class AuthTokenResult
{
    protected int $HttpStatusCode;
    protected ?string $Token;
    protected ?string $Message;
    protected ?string $FlinksCode;

    public function __construct(int $HttpStatusCode, string $Token = null, string $Message = null, string $FlinksCode = null)
    {
        $this->HttpStatusCode = $HttpStatusCode;
        $this->Token = $Token;
        $this->Message = $Message;
        $this->FlinksCode = $FlinksCode;
    }

    public function getHttpStatusCode(): int
    {
        return $this->HttpStatusCode;
    }

    public function setHttpStatusCode(int $HttpStatusCode): void
    {
        $this->HttpStatusCode = $HttpStatusCode;
    }

    public function getToken(): ?string
    {
        return $this->Token;
    }

    public function setToken(string $Token): void
    {
        $this->Token = $Token;
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
}