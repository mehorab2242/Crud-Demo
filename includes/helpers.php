<?php

declare(strict_types=1);

function appRoot(): string
{
    $scriptDir = dirname($_SERVER['SCRIPT_NAME'] ?? '');
    $scriptDir = str_replace('\\', '/', $scriptDir);

    if ($scriptDir === '.' || $scriptDir === '' || $scriptDir === '/' || $scriptDir === '\\') {
        return '/';
    }

    return rtrim($scriptDir, '/') . '/';
}

function singleLineDescription(string $text, int $maxLength = 120): string
{
    $firstLine = trim(preg_split('/\r\n|\r|\n/', $text, 2)[0] ?? '');

    if ($firstLine === '') {
        return '';
    }

    $length = function_exists('mb_strlen') ? mb_strlen($firstLine) : strlen($firstLine);

    if ($length <= $maxLength) {
        return $firstLine;
    }

    $slice = function_exists('mb_substr')
        ? mb_substr($firstLine, 0, $maxLength - 1)
        : substr($firstLine, 0, $maxLength - 1);

    return rtrim($slice) . '…';
}

