<?php

function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        throw new Exception(".env file not found: " . $filePath);
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $line = trim($line);

        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }

        if (strpos($line, '=') === false) {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        $value = trim($value, '"');
        $value = trim($value, "'");

        if (!defined($key)) {
            define($key, $value);
        }
    }
}

loadEnv(__DIR__ . '/../.env');