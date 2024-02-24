<?php

namespace App\Constants;

class GroupType
{
    const SINGLE = 1;
    const MULTIPLE = 2;
    private static $types = [
        1 => "Single",

        2 => "Multiple",
    ];

    /**
     * Get project status in text by employee type id
     * @param int $value number value of a status
     * @return string
     */
    public static function ConvertNumberToText(int $value): string
    {
        if(array_key_exists($value, GroupType::$types))
            return GroupType::$types[$value];
        return "";
    }

    /**
     * All Statuses
     * @return string[]
     */
    public static function Gets(): array
    {
        return GroupType::$types;
    }
}
