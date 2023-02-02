<?php

function get_post($key)
{
    $ret = '';

    if(isset($_POST[$key])){
        $ret = trim($_POST[$key]);
    }

    return $ret;
}

function check_words($word, $min_length, $max_length){
    if(mb_strlen($word) >= $min_length && mb_strlen($word) <= $max_length){
        return true;
    }else{
        return false;
    }
}

?>