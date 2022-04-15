<?php

class Checker
{
    public static function securityAgainstXxs(string $field) : string
    {
        return strip_tags(trim($field));

    }
}