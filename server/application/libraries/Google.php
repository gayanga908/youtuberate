<?php

/**
 * Created by PhpStorm.
 * User: Tharindu Gayanga
 * Date: 1/25/2017
 * Time: 5:58 PM
 */

use Google\Auth\CacheInterface;

class NullGoogleCache implements CacheInterface
{

    public function get($key, $expiration = false)
    {
        return false;
    }

    public function set($key, $value)
    {
        //do nothing
    }

    public function delete($key)
    {
        //do nothing
    }
}