<?php

function getFieldsIfNotEmpty($fields, $array)
{
    $newArray = [];
    foreach ($fields as $field):
        if (!empty($array[$field])):
            $newArray[$field] = $array[$field];
        endif;
    endforeach;

    return $newArray;
}