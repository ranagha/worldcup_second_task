<?php

function language_list(...$x)
{
    if (empty($x)) {
        return $x;
    }
    return $x;
}

function add_to_language_list($list, $x) {
    $list[] = $x;
    return $list;
} 

function prune_language_list($list) {
    $newList = [];
    foreach($list as $index => $el) {
        if($index !== 0) {
            $newList[] = $el;
        }
    }
    return $newList;
}

function current_language($list) {
    return $list[0];
}

function language_list_length($list){
    return count($list);
}