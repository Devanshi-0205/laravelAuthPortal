<?php

use Illuminate\Support\Facades\Crypt;

if (! function_exists('encrypt')) {
    function encrypt($data)
    {
        return Crypt::encrypt($data);
    }
}

if (! function_exists('decrypt')) {
    function decrypt($data)
    {
        return Crypt::decrypt($data);
    }
}
