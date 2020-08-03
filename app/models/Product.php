<?php

namespace App\Models;

use Core\DB;

class Product extends Model
{

    protected $db, $table = "products", $modelName = 'Product';


    public function __construct()
    {
        $this->db = new DB;
    }
}
