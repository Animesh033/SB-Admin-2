<?php

if (!function_exists('format_amount')) {

    function format_amount($billinAmount)
    {
        return number_format((float)$billinAmount, 2, '.', '');
    }
}
