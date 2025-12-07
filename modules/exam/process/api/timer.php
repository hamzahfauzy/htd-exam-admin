<?php

use Core\Response;

$timeFirst  = strtotime(date('Y-m-d H:i:s'));
$timeSecond = strtotime($_POST['end']);
$differenceInSeconds = $timeSecond - $timeFirst;

return Response::json([
    'timer' => $differenceInSeconds
], 'timer retrieved');