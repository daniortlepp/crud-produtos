<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    public function allProducts() {
        return Product::all();
    }

    public function getProducts($string) {
        return Product::where('name', 'LIKE', '%' . $string . '%')->orWhere('description', 'LIKE', '%' . $string . '%')->get();
    }

    public function storeProduct($data) {
        return Product::create($data);
    }

    public function findProduct($id) {
        return Product::find($id);
    }

    public function updateProduct($data, $id) {
        $data->save();
    }

    public function destroyProduct($id) {
        $product = Product::find($id);
        $product->delete();
    }
}