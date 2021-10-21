<?php
if (!function_exists('form_error')) {
    function form_error($fieldName, $before = '', $after = '') {
        global $errors;
        if (!empty($errors) && array_key_exists($fieldName,$errors)) {
            return $before .$errors[$fieldName] .$after;
        } else {
            return false;
        }
    }
}