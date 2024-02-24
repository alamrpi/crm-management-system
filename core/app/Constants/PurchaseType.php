<?php

namespace App\Constants;

class PurchaseType
{
    const FIXED_HOUR = 1;
    const PER_DAY_HOUR = 2;
    private static $types = [
        1 => "Fixed Hour",
        2 => "Per Day Hour"
    ];

    /**
     * Get project status in text by employee type id
     * @param int $value number value of a status
     * @return string
     */
    public static function ConvertNumberToText(int $value): string
    {
        if(array_key_exists($value, PurchaseType::$types))
            return PurchaseType::$types[$value];
        return "";
    }

    /**
     * All Statuses
     * @return string[]
     */
    public static function GetTypes(): array
    {
        return PurchaseType::$types;
    }
}
