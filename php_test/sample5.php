<?php
//camelCase
//checkPostCode();

//snake_case
//check_post_code();

//どちらでも良いがキャメルケースの方が多い？

$postalCode = '123-4567';

function checkPostCode($str) {
    $replaced = str_replace('-', '', $str);
    $length = strlen($replaced);

    if ($length === 7) {
        return true;
    }
    return false;
}

var_dump(checkPostCode($postalCode));