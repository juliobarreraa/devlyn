<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
use globalcms\components\login;

class UserIdentity extends login\GCLoginAuth
{
}