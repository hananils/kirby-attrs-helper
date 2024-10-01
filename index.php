<?php

use Kirby\Cms\App as Kirby;
use Kirby\Cms\Html;

/**
 * Helper to conditionally create attributes for HTML elements. It takes an
 * associative array with the keys specifying the attribute names and the values
 * specifying the corresponing attribute values. If the value itself is an
 * array, the keys will be used a attribute values, joined by a separator.
 * Before joining keys, the assigned value will be used as a condition that
 * either has to evaluate to `true` or `false`. Keys that have their condition
 * return `false` will be discarded on not be included in the attribute value.
 * Empty attributes will also be discarded. If you want to include a boolean
 * attribute, that does not have a value, set the value to `true`.
 *
 * @param $attrs Array of attributes.
 * @param $separator The separator used to join attribute values.
 */
function attrs(array $attrs, string $separator = ' '): string
{
    if (empty($attrs)) {
        return '';
    }

    foreach ($attrs as $name => $tokens) {
        if (!is_array($tokens)) {
            continue;
        }

        // Remove tokens with untrue conditions
        $tokens = array_filter($tokens);

        /**
         * Set valid tokens as value.
         *
         * @note Don't use `array_keys` because there might be plain values
         * without condition. This loop will keep string values already present
         * in the array values.
         */
        foreach ($tokens as $token => $condition) {
            if (is_bool($condition)) {
                $tokens[$token] = $token;
            }
        }

        $attrs[$name] = implode($separator, $tokens);
    }

    return Html::attr(array_filter($attrs)) ?? '';
}

Kirby::plugin('hananils/attrs-helper', []);
