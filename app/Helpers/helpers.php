<?php

use App\Models\Message;

if (! function_exists('moneyFormat')) {    
    /**
     * moneyFormat
     *
     * @param  mixed $str
     * @return void
     */
    function moneyFormat($str) {
        return 'Rp ' . number_format($str, '0', '', '.');
    }
}

class Helper {
    public static function messageList()
    {
        return Message::whereNull('read_at')->orderBy('created_at', 'desc')->get();
    }
}

?>