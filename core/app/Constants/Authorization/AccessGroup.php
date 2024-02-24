<?php

namespace App\Constants\Authorization;

class AccessGroup
{
    const DEPARTMENT = 1;
    const EMPLOYEE = 2;
    const FEEDBACK = 3;
    const CLIENT = 4;
    const REQUEST = 5;
    const TASK = 6;
    const PROJECT = 7;
    const PR_SERVICE = 8;
    const PR_DOCUMENT = 9;
    const PR_TEAM = 10;
    const PR_ACTIVITIES = 11;
    const PR_ACCESS = 12;
    const PR_TASK = 13;
    const PR_TASK_DETAILS_VIEW = 14;
    const PR_INTEGRATION_CONFIGURATION = 15;


    private static $groups = [
        1 => "Department",
        2 => "Employee",
        3 => "Feedback",
        4 => "Client",
        5 => "Request",
        6 => "Task",
        7 => "Project",
        8 => "Project Service",
        9 => "Project Document",
        10 => "Project Team",
        11 => "Project Activities",
        12 => "Project Access & Sample",
        13 => "Project Task",
        14 => "Project Task Details View",
        15 => "Project Integration & Configuration",
    ];

    public static function groupName(int $value): string
    {
        if(array_key_exists($value, AccessGroup::$groups))
            return AccessGroup::$groups[$value];
        return "";
    }


}
