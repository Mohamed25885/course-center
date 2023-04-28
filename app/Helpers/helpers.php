<?php

if (!function_exists('is_email')) {
    function is_email(?string $email): bool
    {
        if (empty($email)) return false;
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
