<?php

use Carbon\Carbon;

if (!function_exists('is_email')) {
    function is_email(?string $email): bool
    {
        if (empty($email)) return false;
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
if (!function_exists('week_days')) {
    function week_days(?int $day = null): array|string
    {
        if (!blank($day) && $day >= 0 && $day < 7) return Carbon::getDays()[$day];
        return Carbon::getDays();
    }
}
