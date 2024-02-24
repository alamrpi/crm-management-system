<?php

namespace App\Constants;

class ProjectStatus
{
    const NEW = 1;
    const IN_PROGRESS = 2;
    const COMPLETED = 3;
    const CANCELED = 4;
    private static $statuses = [
        1 => "New",
        2 => "In-Progress",
        3 => "Completed",
        4 => "Canceled",
    ];

    private static $colorClassName =[
        1 => "bg-secondary-subtle text-secondary",
        2 => "bg-warning-subtle text-warning",
        3 => "bg-success-subtle text-success",
        4 => "bg-danger-subtle text-danger",
    ];

    /**
     * Get project status in text by employee type id
     * @param int $value number value of a status
     * @return string
     */
    public static function ConvertNumberToText(int $value): string
    {
        if(array_key_exists($value, ProjectStatus::$statuses))
            return ProjectStatus::$statuses[$value];
        return "";
    }

    /**
     * All Statuses
     * @return string[]
     */
    public static function GetStatuses(): array
    {
        return ProjectStatus::$statuses;
    }

    public static function GetColorClassName(int $value): string
    {
        if(array_key_exists($value, ProjectStatus::$colorClassName))
            return ProjectStatus::$colorClassName[$value];
        return "";
    }
}
