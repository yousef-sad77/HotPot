<?php
function all(array $items, callable $callback): bool
{
    foreach ($items as $item) {
        if (!$callback($item)) {
            return false;
        }
    }
    return true;
}
function any(array $items, callable $callback): bool
{
    foreach ($items as $item) {
        if ($callback($item)) {
            return true;
        }
    }
    return false;
}

// function is_empty($x)
// {
//     return empty($x);
// }
function is_empty($x)
{
    return trim($x) === '';  // trim() will remove any whitespace from the string and check if it’s truly empty
}

function is_filled($x)
{
    return !empty($x);
}
?>