<?php

class AuthorizeRequestBody
{
    protected string $username;
    protected string $password;
    protected string $loginId;
    protected array $securityResponses;
    protected bool $save;
    protected bool $mostRecentCached;
    protected string $withMfaQuestions;
    protected string $language;
    protected string $tag;
    protected bool $scheduleRefresh;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getLoginId(): string
    {
        return $this->loginId;
    }

    public function setLoginId(string $loginId): self
    {
        $this->loginId = $loginId;
        return $this;
    }

    public function getSecurityResponses(): array
    {
        return $this->securityResponses;
    }

    public function setSecurityResponses(array $securityResponses): self
    {
        $this->securityResponses = $securityResponses;
        return $this;
    }

    public function getSave(): bool
    {
        return $this->save;
    }

    public function setSave(bool $save): self
    {
        $this->save = $save;
        return $this;
    }

    public function getMostRecentCached(): bool
    {
        return $this->mostRecentCached;
    }

    public function setMostRecentCached(bool $mostRecentCached): self
    {
        $this->mostRecentCached = $mostRecentCached;
        return $this;
    }

    public function getWithMfaQuestions(): string
    {
        return $this->withMfaQuestions;
    }

    public function setWithMfaQuestions(string $withMfaQuestions): self
    {
        $this->withMfaQuestions = $withMfaQuestions;
        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    public function getScheduleRefresh(): bool
    {
        return $this->scheduleRefresh;
    }

    public function setScheduleRefresh(bool $scheduleRefresh): self
    {
        $this->scheduleRefresh = $scheduleRefresh;
        return $this;
    }
}