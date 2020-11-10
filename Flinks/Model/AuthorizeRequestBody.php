<?php

namespace Authorize;

class AuthorizeRequestBody
{
    /**
     * @var string
     */
    protected $username;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var string
     */
    protected $loginId;
    /**
     * @var string[][]
     */
    protected $securityResponses;
    /**
     * @var bool
     */
    protected $save;
    /**
     * @var bool
     */
    protected $mostRecentCached;
    /**
     * @var string
     */
    protected $withMfaQuestions;
    /**
     * @var string
     */
    protected $language;
    /**
     * @var string
     */
    protected $tag;
    /**
     * @var bool
     */
    protected $scheduleRefresh;
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username = null)
    {
        $this->username = $username;
        return $this;
    }
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param string $password
     *
     * @return self
     */
    public function setPassword($password = null)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @return string
     */
    public function getLoginId()
    {
        return $this->loginId;
    }
    /**
     * @param string $loginId
     *
     * @return self
     */
    public function setLoginId($loginId = null)
    {
        $this->loginId = $loginId;
        return $this;
    }
     /**
     * @return string[][]
     */
    public function getSecurityResponses()
    {
        return $this->securityResponses;
    }
    /**
     * @param string[][] $securityResponses
     *
     * @return self
     */
    public function setSecurityResponses(\ArrayObject $securityResponses = null)
    {
        $this->securityResponses = $securityResponses;
        return $this;
    }
    /**
     * @return bool
     */
    public function getSave()
    {
        return $this->save;
    }
    /**
     * @param bool $save
     *
     * @return self
     */
    public function setSave($save = null)
    {
        $this->save = $save;
        return $this;
    }
    /**
     * @return bool
     */
    public function getMostRecentCached()
    {
        return $this->mostRecentCached;
    }
    /**
     * @param bool $mostRecentCached
     *
     * @return self
     */
    public function setMostRecentCached($mostRecentCached = null)
    {
        $this->mostRecentCached = $mostRecentCached;
        return $this;
    }
    /**
     * @return string
     */
    public function getWithMfaQuestions()
    {
        return $this->withMfaQuestions;
    }
    /**
     * @param string $withMfaQuestions
     *
     * @return self
     */
    public function setWithMfaQuestions($withMfaQuestions = null)
    {
        $this->withMfaQuestions = $withMfaQuestions;
        return $this;
    }
     /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }
    /**
     * @param string $language
     *
     * @return self
     */
    public function setLanguage($language = null)
    {
        $this->language = $language;
        return $this;
    }
     /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }
    /**
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;
        return $this;
    }
    /**
     * @return bool
     */
    public function getScheduleRefresh()
    {
        return $this->scheduleRefresh;
    }
    /**
     * @param bool $scheduleRefresh
     *
     * @return self
     */
    public function setScheduleRefresh($scheduleRefresh = null)
    {
        $this->scheduleRefresh = $scheduleRefresh;
        return $this;
    }
}