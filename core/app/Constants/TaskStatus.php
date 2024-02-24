<?php

namespace App\Constants;

class TaskStatus
{
    const TODO = 1;
    const IN_PROGRESS = 2;
    const COMPlETE = 3;
    private static $types = [
        1 => "Todo",
        2 => "In Progress",
        3 => "Complete"
    ];

    private static $textColors = [
        1 => "text-secondary",
        2 => "text-primary",
        3 => "text-success",
    ];
    private static $bgColors = [
        1 => "bg-secondary",
        2 => "bg-primary",
        3 => "bg-success",
    ];
    
    private static $bgSubTitleColors = [
        1 => "bg-secondary-subtle",
        2 => "bg-primary-subtle",
        3 => "bg-success-subtle",
    ];
    private static $btnColors = [
        1 => "btn-secondary",
        2 => "btn-primary",
        3 => "btn-success",
    ];


    /**
     * Get project status in text by employee type id
     * @param int $value number value of a status
     * @return string
     */
    public static function ConvertNumberToText(int $value): string
    {
        if(array_key_exists($value, TaskStatus::$types))
            return TaskStatus::$types[$value];
        return "";
    }

    public static function getTextColor(int $value): string
    {
        if(array_key_exists($value, TaskStatus::$textColors))
            return TaskStatus::$textColors[$value];
        return "";
    }

    public static function getBgColor(int $value): string
    {
        if(array_key_exists($value, TaskStatus::$bgColors))
            return TaskStatus::$bgColors[$value];
        return "";
    }
    public static function getBgSubTitleColor(int $value): string
    {
        if(array_key_exists($value, TaskStatus::$bgSubTitleColors))
            return TaskStatus::$bgSubTitleColors[$value];
        return "";
    }

    public static function getBtnColor(int $value): string
    {
        if(array_key_exists($value, TaskStatus::$btnColors))
            return TaskStatus::$btnColors[$value];
        return "";
    }

    /**
     * All Statuses
     * @return string[]
     */
    public static function Gets(): array
    {
        return TaskStatus::$types;
    }
}
