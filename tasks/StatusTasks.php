<?php

declare(strict_types=1);

use Crunz\Schedule;

$scheduler = new Schedule();

$task = $scheduler->run(PHP_BINARY . ' command.php');

$task->description('Generate Status Cache Files')
    ->in('src')
    ->preventOverlapping()
    ->weekly();

return $scheduler;
