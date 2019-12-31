<?php

if (! file_exists('.cache/config.json')) {
    exec('cd src && php command.php');
}

echo "\n\nDev Server Started at http://localhost:8000\n\n";
exec(PHP_BINARY . ' -S localhost:8000 -t public/');
