<?php

namespace App\Formats;


use App\Contracts\OutputFormatContract;

class Html implements OutputFormatContract
{
    public function print($products)
    {
        header('Content-Type: text/html; charset=utf-8');
        $html = "<table>";

        foreach ($products as $product) {
            $html .= "<tr>";
            foreach (get_object_vars($product) as $prop) {
                $html .= "<td>" . $prop . "<td>";
            }
            $html .= "<tr>";
        }

        $html .= "</table>";


        echo $html;
    }
}
