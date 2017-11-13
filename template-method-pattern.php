<?php

abstract class Transformer {

    protected function responseJson($array)
    {
        return json_encode($array);
    }

    abstract public function transform($item);
}

class UserTransformer extends Transformer {

    public function transform($item)
    {
        return $this->responseJson(['name' => $item['name']]);
    }
}

class ProductTransformer extends transformer {

    public function transform($item)
    {
        return $this->responseJson(['name' => $item['product_name']]);
    }
}

$userTransformer = new UserTransformer();
print_r($userTransformer->transform(['id' => 1, 'name' => 'im4aLL']));

$productTransformer = new ProductTransformer();
print_r($productTransformer->transform(['id' => 1, 'product_name' => 'Sample product']));