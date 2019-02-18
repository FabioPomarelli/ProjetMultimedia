<?php

class Validator
{
    public static function checkString($s):int
    {
        return preg_match('/^[[:alnum:]][[:alnum:][:space:]_\-,\.]*$/',$s,$resultat);
    }

    public static function checkUserName($s):int
    {
        return preg_match('/^[[:alnum:]][[:alnum:] \-_]{5,}$/',$s,$reponse);
    }

    public static function checkPassword($s):int
    {
        return preg_match('/^(?=.*[[:alnum:]])(?=.*[[:digit:]])(?=.*[[:punct:]])[[:alnum:][:digit:][:punct:]]{8,}$/',$s, $resultat);
    }
}
