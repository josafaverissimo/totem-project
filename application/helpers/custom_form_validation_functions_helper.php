<?php
function valid_cpf($cpf)
{
    $cpf = preg_replace('/[^0-9]/', "", $cpf);

    if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
        return false;
    }

    $FIRST_DIGIT_INDEX = 9;
    $SECOND_DIGIT_INDEX = 10;

    $firstDigitWeight = 1;
    $secondDigitWeight = 0;

    $firstDigitSum = 0;
    $secondDigitSum = 0;

    for ($index = 0; $index < 9; $index++) {
        $firstDigitSum += $cpf[$index] * $firstDigitWeight++;
    }

    for ($index = 0; $index < 10; $index++) {
        $secondDigitSum += $cpf[$index] * $secondDigitWeight++;
    }

    $firstDigit = $firstDigitSum % 11;
    $firstDigit = $firstDigit == 10 ? 0 : $firstDigit;

    if ($firstDigit != $cpf[$FIRST_DIGIT_INDEX]) return false;

    $secondDigit = $secondDigitSum % 11;
    $secondDigit = $secondDigit == 10 ? 0 : $secondDigit;

    if ($secondDigit != $cpf[$SECOND_DIGIT_INDEX]) return false;

    return true;
}

function valid_cellphone($cellphone)
{
    if (strlen($cellphone) == 11) return true;

    return false;
}