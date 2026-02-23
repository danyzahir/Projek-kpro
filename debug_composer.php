<?php
$output = shell_exec('composer require php-open-source-saver/jwt-auth --with-all-dependencies 2>&1');
file_put_contents('composer_debug.log', $output);
echo "Done";
