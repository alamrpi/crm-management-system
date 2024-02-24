<?php

namespace App\Constants\Task;

class AcceptedStatus
{
    const SUBMIT = 1;
    const REVISION = 2;
    const ACCEPT = 3;
    private static $types = [
        1 => "Submit",
        2 => "Revision",
        3 => "Accept"
    ];

    private static $bgColors = [
        1 => "bg-warning",
        2 => "bg-danger",
        3 => "bg-success",
    ];

    /**
     * Get project status in text by employee type id
     * @param int $value number value of a status
     * @return string
     */
    public static function ConvertNumberToText(int $value): string
    {
        if(array_key_exists($value, AcceptedStatus::$types))
            return AcceptedStatus::$types[$value];
        return "";
    }

    /**
     * All Statuses
     * @return string[]
     */
    public static function Gets(): array
    {
        return AcceptedStatus::$types;
    }

    public static function getBgColor(int $value): string
    {
        if(array_key_exists($value, AcceptedStatus::$bgColors))
            return AcceptedStatus::$bgColors[$value];
        return "";
    }
}
