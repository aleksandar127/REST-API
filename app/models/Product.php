<?php

namespace App\Models;

use Core\DB;
use JsonSerializable;

class Product extends Model implements JsonSerializable
{

    protected $db, $table = "products", $modelName = 'Product';


    public function __construct()
    {
        $this->db = new DB;
    }

    public function jsonSerialize()
    {
        return ['id' => $this->id, 'name' => $this->name, 'description' => $this->description, 'category' => $this->category];
    }
}
