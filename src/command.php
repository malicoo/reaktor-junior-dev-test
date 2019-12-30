<?php
require __DIR__. '/../vendor/autoload.php';

use Reaktor\App\Status;

$status = new Status;

$status->savePackages();
