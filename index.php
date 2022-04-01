<?php

function attrs($attrs)
{
    $attrs = array_map('chainValues', $attrs);

    return Html::attr($attrs);
}

function chainValues($value)
{
    if (is_array($value)) {
        $values = [];

        // Get valid values
        foreach ($value as $token => $condition) {
            if ($condition === true) {
                $values[] = $token;
            }
        }

        // Remove empty values
        $values = array_filter($values);

        return implode(' ', $values);
    }

    return $value;
}
