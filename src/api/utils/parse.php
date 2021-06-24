<?php

function parseBody($body) {
    return json_decode($body, true);
}

function parseQueryValues($unformattedValues) {
    $formattedValues = array();

    foreach($unformattedValues as $value) {
        array_push($formattedValues, is_numeric($value) ? $value : "'" . $value . "'");
    }

    return $formattedValues;
}

function parseQueryKeyValue($body) {
    $setValues = "";

    foreach($body as $key => $value) {
        $setValues .= $key . " = " . (is_numeric($value) ? $value . ", " : "'" . $value . "', ");
    }

    return trim($setValues, ', ');
}