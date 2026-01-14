<?php

function phpSizeToBytes(string $size): int
{
    $unit = strtoupper(substr($size, -1));
    $value = (int)$size;

    switch ($unit) {
        case 'G': return $value * 1024 * 1024 * 1024;
        case 'M': return $value * 1024 * 1024;
        case 'K': return $value * 1024;
        default:  return (int)$size;
    }
}

