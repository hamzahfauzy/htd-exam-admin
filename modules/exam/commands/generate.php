<?php

if (!isset($argv[2])) 
{
    echo "Schedule id is empty\n";
    die;
}

$schedule_id  = $argv[2];

generateQuestionSchedule($schedule_id);