<?php

function validation($data) {
    $error = [];
    //ローカル変数
    
    if (empty($data['your_name'])) {
        $error[] = '氏名は必須';
    }

    return $error;
}