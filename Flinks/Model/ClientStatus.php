<?php

namespace Flinks;

class ClientStatus
{
    const UNKNOWN = 0;
    const BAD_REQUEST = 400;
    const PENDING_MFA_ANSWERS = 203;
    const AUTHORIZED = 200;
    const UNAUTHORIZED = 401;
}