<?php

    function transformNumber($str)
    {
        return (int) preg_replace("/[^0-9]/", "", $str);
    }

    function getYearOfBirth($value, $format = 'Y')
    {
        return date($format, strtotime($value));
    }
