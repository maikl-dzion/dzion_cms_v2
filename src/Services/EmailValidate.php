<?php
/**
 * Created by PhpStorm.
 * User: maikl
 * Date: 28.10.2020
 * Time: 17:29
 */

namespace Dzion\Services;

class EmailValidate
{
    private $email;

    public function validate($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return false;
            // throw new Exception(sprintf('"%s" is not a valid email', $email));
        $this->email = $email;
        return true;
    }

    public function __toString()
    {
        return $this->email;
    }

    public function equals(EmailValidate $email)
    {
        return strtolower((string) $this) === strtolower((string) $email);
    }
}