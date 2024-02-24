<?php

namespace App\Constants;

class Priority
{
    const HIGh = 1;
    const MEDIUM = 2;
    const LOW = 3;
    private static $priorities = [
        3 => "Low",
        2 => "Medium",
        1 => "High",
    ];

    private static $colorClassNames = [
        1 => "bg-danger-subtle text-danger",
        2 => "bg-warning-subtle text-warning",
        3 => "bg-success-subtle text-success",
    ];

    private static $bgColors = [
        1 => "bg-danger",
        2 => "bg-warning",
        3 => "bg-success",
    ];
    /**
     * Get project status in text by employee type id
     * @param int $value number value of a status
     * @return string
     */
    public static function ConvertNumberToText(int $value): string
    {
        if(array_key_exists($value, Priority::$priorities))
            return Priority::$priorities[$value];
        return "";
    }

    /**
     * All Statuses
     * @return string[]
     */
    public static function GetPriorities(): array
    {
        return Priority::$priorities;
    }

    /**
     * Get Color class name based on Priority id
     *
     * @param int $value priority id
     * @return string bootstrap class name
     */
    public static function GetColorName(int $value): string
    {
        if(array_key_exists($value, Priority::$colorClassNames))
            return Priority::$colorClassNames[$value];
        return "";
    }

    public static function getBgColor(int $value): string
    {
        if(array_key_exists($value, Priority::$bgColors))
            return Priority::$bgColors[$value];
        return "";
    }
}
