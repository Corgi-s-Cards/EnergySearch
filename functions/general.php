<?php

function sanitizeInput($input)
{
    // Remove whitespace from the beginning and end of the input
    $input = trim($input);

    // Strip HTML and PHP tags from the input
    $input = strip_tags($input);

    // Replace quotes with their HTML entities to prevent SQL injection attacks
    $input = str_replace("'", "&#39;", $input);
    $input = str_replace("\"", "&quot;", $input);

    // Use htmlspecialchars to prevent XSS attacks
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

    return $input;
}

?>