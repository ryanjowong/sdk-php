<?php

namespace Flinks;

class AuthTokenResult
{
    protected int $HttpStatusCode;
    protected string $Token;

    public function __construct(int $HttpStatusCode, string $Token)
    {
        $this->HttpStatusCode = $HttpStatusCode;
        $this->Token = $Token;
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
}