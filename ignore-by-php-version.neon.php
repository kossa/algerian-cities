<?php

declare(strict_types=1);

$includes = [];

if (PHP_VERSION_ID < 80200) {
    $includes[] = __DIR__.'/baseline-8.1.neon';
}

$config = [];
$config['includes'] = $includes;
$config['parameters']['phpVersion'] = PHP_VERSION_ID;

return $config;
