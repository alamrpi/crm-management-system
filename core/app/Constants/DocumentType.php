<?php

namespace App\Constants;

class DocumentType
{
    const PROJECT = 1;
    const RESEARCH = 2;
    private static $types = [
        1 => "Project",
        2 => "Research",
    ];

    /**
     * Get project status in text by employee type id
     * @param int $value number value of a status
     * @return string
     */
    public static function ConvertNumberToText(int $value): string
    {
        if(array_key_exists($value, DocumentType::$types))
            return DocumentType::$types[$value];
        return "";
    }

    /**
     * All Statuses
     * @return string[]
     */
    public static function Gets(): array
    {
        return DocumentType::$types;
    }
}
