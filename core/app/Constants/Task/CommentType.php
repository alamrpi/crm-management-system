<?php

namespace App\Constants\Task;

class CommentType
{
    const SUBMISSION = 1;
    const GENERAL = 2;
    const REVIEW = 3;
    private static $types = [
        1 => "Submission",
        2 => "General",
        3 => "Review"
    ];

    /**
     * Get project status in text by employee type id
     * @param int $value number value of a status
     * @return string
     */
    public static function ConvertNumberToText(int $value): string
    {
        if(array_key_exists($value, CommentType::$types))
            return CommentType::$types[$value];
        return "";
    }

    /**
     * All Statuses
     * @return string[]
     */
    public static function Gets(): array
    {
        return CommentType::$types;
    }
}
