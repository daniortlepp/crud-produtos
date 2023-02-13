<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Repositories\Interfaces\ProductRepositoryInterface;

use App\Services\UtilService;

class ProductController extends Controller
{
    private $productRepository;
    private $utilService;

    public function __construct(ProductRepositoryInterface $productRepository, UtilService $utilService) {
        $this->middleware('auth:api');

        $this->productRepository = $productRepository;
        $this->utilService = $utilService;
    }

    public function index(Request $request) {
        $products =  $this->productRepository->getProducts($request->search);

        return $this->utilService->getJSONReturn('success', null, $products, 200);
    }

    public function store(Request $request) {
        $product = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'value' => 'required|numeric|between:0,99.99',
            'active' => 'required|boolean'
        ]);

        $this->productRepository->storeProduct($product);

        return $this->utilService->getJSONReturn('success', 'Product created successfully', $product, 200);
    }

    public function show($id) {
        $product = $this->productRepository->findProduct($id);
        if ($product) {
            return $this->utilService->getJSONReturn('success', null, $product, 200);
        } else {
            return $this->utilService->getJSONReturn('error', 'Product not found', null, 400);
        }
    }

    public function update(Request $request, $id) {
        $product = $this->productRepository->findProduct($id);
        if (!$product) {
            return $this->utilService->getJSONReturn('error', 'Product not found', null, 400);
        }

        $product->name = $request->name ? $request->name : $product->name;
        $product->description = $request->description ? $request->description : $product->description;
        $product->value = $request->value ? $request->value : $product->value;
        $product->active = $request->active ? $request->active : $product->active;

        $this->productRepository->updateProduct($product, $id);

        return $this->utilService->getJSONReturn('success', 'Product updated successfully', $product, 200);
    }

    public function destroy($id) {
        if (!$this->productRepository->findProduct($id)) {
            return $this->utilService->getJSONReturn('error', 'Product not found', null, 400);
        }

        $this->productRepository->destroyProduct($id);

        return $this->utilService->getJSONReturn('success', 'Product deleted successfully', null, 200);
    }

}
