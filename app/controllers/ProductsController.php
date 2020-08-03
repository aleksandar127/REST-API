<?php

namespace App\Controllers;

use Core\Request;
use App\Models\Product;
use App\Contracts\OutputFormatContract;

class ProductsController extends Controller
{
    private $outputFormat;

    public function __construct(Request $request, OutputFormatContract $outputFormat)
    {

        $this->outputFormat = $outputFormat;
    }

    public function index()
    {

        $product = new Product();
        $products = $product->all();
        $response = $this->http_response($products, "show");
        $this->outputFormat->print($response);
    }

    public function show(Request $request)
    {

        $products = new Product();
        $product = $products->find(['condition' => 'id=?', 'bind' => $request->id]);
        $response = $this->http_response($product, "show");
        $this->outputFormat->print($response);
    }

    public function store()
    {
        $insert = $this->getInput();
        $product = new Product();
        $response = $this->http_response($product, "create");
        $this->outputFormat->print($response);
    }

    public function update(Request $request)
    {


        $insert = $this->getInput();
        $product = new Product();
        $response = $this->http_response($product, "show");
        $this->outputFormat->print($response);
    }

    public function delete(Request $request)
    {

        $product = new Product();
        $deleted = $product->find(['condition' => 'id=?', 'bind' => $request->id]);
        $response = $this->http_response($deleted, "show");
        $this->outputFormat->print($response);
    }

    private function getInput()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        $input = [];
        $product = new Product();
        $fields = $product->getFields();
        $keys = array_keys(get_object_vars($data));
        $values = array_values(get_object_vars($data));
        foreach ($keys as $key) {
            if (in_array($key, $fields)) {
                $input += [$key => $this->sanitize(current($values))];
            }
            next($values);
        }
        return $input;
    }

    private function sanitize($dirty)
    {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }

    private function http_response($obj, $operation, $code = 200)
    {
        // set response code - 200 ok
        http_response_code($code);
        if (!$obj) {
            // set response code - 503 service unavailable
            http_response_code(503);
            return ["message" => "Unable to " . $operation . " products."];
        }
        return $obj;
    }
}
