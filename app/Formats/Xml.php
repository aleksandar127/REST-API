<?php

namespace App\Formats;


use App\Contracts\OutputFormatContract;

class Xml implements OutputFormatContract
{
    public function print($products)
    {

        header('Content-Type: text/xml; charset=utf-8');
        $obj = strtolower(explode("\\", get_class($products[0]))[2]);
        $xml = "<?xml version='1.0' standalone='yes' ?>";
        $xml .= "<" . $obj . "s>";
        foreach ($products as $product) {
            $xml .= "<" . $obj . ">";
            $properties = array_keys(get_object_vars($product));
            foreach (get_object_vars($product) as $val) {
                $xml .= "<" . current($properties) . ">" . $val . "</" . current($properties) . ">";
                next($properties);
            }
            $xml .= "</" . $obj . ">";
        }
        $xml .= "</" . $obj . "s>";
        echo $xml;
    }
}
