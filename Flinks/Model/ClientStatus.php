<?php

namespace Flinks;

class ClientStatus
{
    const UNKNOWN = 0;
    const ERROR = 1;
    const PENDING_MFA_ANSWERS = 203;
    const AUTHORIZED = 200;
    const UNAUTHORIZED = 401;
}