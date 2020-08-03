<?php

namespace App\Formats;


use App\Contracts\OutputFormatContract;

class Json implements OutputFormatContract
{
    public function print($products)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($products);
    }
}
