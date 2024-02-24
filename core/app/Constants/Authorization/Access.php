<?php

namespace App\Constants\Authorization;

class Access
{
    const DEPT_ALL = 1;
    const DEPT_ADD = 2;
    const DEPT_EDIT = 3;
    const DEPT_DELETE = 4;
    const DEPT_SERVICE_LIST = 5;
    const DEPT_SERVICE_ADD = 6;
    const DEPT_SERVICE_EDIT = 7;
    const DEPT_SERVICE_DELETE = 8;

    const EMPLOYEE_ALL = 9;
    const EMPLOYEE_ADD = 10;
    const EMPLOYEE_EDIT = 11;
    const EMPLOYEE_DEACTIVE = 12;
    const EMPLOYEE_PROFILE = 13;

    const FEEDBACK_ALL = 14;

    const CLIENT_ALL = 15;
    const CLIENT_ADD = 16;
    const CLIENT_EDIT = 17;
    const CLIENT_DELETE = 18;
    const CLIENT_ENROLL = 19;

    const REQUEST_VIEW = 20;
    const REQUEST_APPROVE = 21;
    const REQUEST_DENY = 22;

    const TASKS_ALL = 23;

    const PR_ALL = 24;
    const PR_ADD = 25;
    const PR_EDIT = 26;
    const PR_REMOVE = 27;
    const PR_CANCEL = 28;
    const PR_OVERVIEW = 29;

    const PR_SERVICE_ALL = 30;
    const PR_SERVICE_ADD = 31;
    const PR_SERVICE_EDIT = 32;
    const PR_SERVICE_DELETE = 33;

    const PR_DOCUMENT_ALL = 34;
    const PR_DOCUMENT_ADD = 35;
    const PR_DOCUMENT_EDIT = 36;
    const PR_DOCUMENT_DELETE = 37;

    const PR_TEAM_ALL = 38;
    const PR_TEAM_ASSIGN_MEMBER = 39;
    const PR_TEAM_ACTIVITIES = 40;
    const PR_TEAM_REMOVE = 41;

    const PR_ACTIVITIES_VIEW = 42;

    const PR_ACCESS_ALL = 43;
    const PR_ACCESS_ADD = 44;
    const PR_ACCESS_EDIT = 45;
    const PR_ACCESS_DELETE = 46;
    const PR_ACCESS_REQUEST_ALL = 47;
    const PR_ACCESS_REQUEST_ADD = 48;
    const PR_ACCESS_REQUEST_EDIT = 49;
    const PR_ACCESS_REQUEST_DELETE = 50;

    const PR_TASK_ALL = 51;
    const PR_TASK_CALENDER = 52;
    const PR_TASK_ACTIVITIES = 53;
    const PR_TASK_ADD = 54;
    const PR_TASK_SUB_TASK_ADD = 55;
    const PR_TASK_ASSIGN = 56;
    const PR_TASK_CONVERT_TO_SUBTASK = 57;
    const PR_TASK_DUPLICATE = 58;
    const PR_TASK_ARCHIVE = 59;
    const PR_TASK_DELETE = 60;

    const PR_TASK_DESCRIPTION = 61;
    const PR_TASK_COMMENT_ADD = 62;
    const PR_TASK_COMMENT_VIEW = 63;
    const PR_TASK_DETAILS = 64;
    const PR_TASK_DETAILS_ADD = 65;
    const PR_TASK_DETAILS_REMOVE = 66;
    const PR_TASK_ATTACHMENT = 67;
    const PR_TASK_ATTACHMENT_ADD = 68;
    const PR_TASK_ATTACHMENT_REMOVE = 69;
    const PR_TASK_ACTION_ITEM = 70;
    const PR_TASK_IN_REVIEW = 71;
    const PR_TASK_SUBMIT = 72;

    const PR_INTEGRATION_CONFIG_ALL = 73;
    const PR_INTEGRATION_CONFIG_ADD = 74;
}
