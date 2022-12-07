<?php

function formatCpf($cpf): string
{
    return preg_replace(
        "/([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{2})/",
        "$1.$2.$3-$4",
        $cpf
    );
}

function formatCellphone($cellphone): string
{
    return preg_replace(
        "/([0-9]{2})([0-9])([0-9]{4})([0-9]{4})/",
        "($1) $2 $3-$4",
        $cellphone
    );
}