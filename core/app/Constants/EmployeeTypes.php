<?php

namespace App\Constants;

class EmployeeTypes
{
    const MANAGER = 1;
    const EXECUTIVE = 2;

    private static $types = [
        1 => "Manager",
        2 => "Executive",
    ];

    /**
     * Get employee type in text by employee type id
     * @param int $value employee type id
     * @return string
     */
    public static function ConvertNumberToText(int $value): string
    {
        if(array_key_exists($value, EmployeeTypes::$types))
            return EmployeeTypes::$types[$value];
        return "";
    }

    public static function getEmployeeTypeFromRole($role) :int
    {
        if ($role == EmployeeTypes::$types[1])
            return EmployeeTypes::MANAGER;
        if ($role == EmployeeTypes::$types[2])
            return EmployeeTypes::EXECUTIVE;
        return 0;
    }
}
