<?php

namespace App\Constants;

class TaskType
{
    const MAIN = 1;
    const SUB = 2;
    private static $types = [
        1 => "Main",

        2 => "Sub",
    ];

    /**
     * Get project status in text by employee type id
     * @param int $value number value of a status
     * @return string
     */
    public static function ConvertNumberToText(int $value): string
    {
        if(array_key_exists($value, TaskType::$types))
            return TaskType::$types[$value];
        return "";
    }

    /**
     * All Statuses
     * @return string[]
     */
    public static function Gets(): array
    {
        return TaskType::$types;
    }
}
