<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PisumProductModel;
use App\Models\ProductCategoryModel;

class ProductsApi extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel  = new PisumProductModel();
        $this->categoryModel = new ProductCategoryModel();
    }

public function productBySlug($slug = null)
{
    // 🔹 SINGLE PRODUCT
    if ($slug) {
        $record = $this->productModel->where('slug', $slug)->where('status', 1)->first();

        if (!$record) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Product not found',
                'data' => null
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Product fetched successfully',
            'data' => $this->formatProduct($record)
        ]);
    }

    // 🔹 ALL PRODUCTS
    $records = $this->productModel->where('status', 1)->orderBy('id', 'DESC')->findAll();

    return $this->response->setJSON([
        'status' => true,
        'message' => 'Products fetched successfully',
        'total' => count($records),
        'data' => array_map([$this, 'formatProduct'], $records)
    ]);
}

public function productsByCategory($categorySlug)
{
    // 🔹 Find category by slug
    $category = $this->categoryModel
        ->where('slug', urldecode($categorySlug))
        ->where('status', 1)
        ->first();

    if (!$category) {
        return $this->response->setJSON([
            'status'  => false,
            'message' => 'Category not found',
            'data'    => []
        ])->setStatusCode(404);
    }

    // 🔹 Get products under this category
    $records = $this->productModel
        ->where('category_id', $category['id'])
        ->where('status', 1)
        ->orderBy('id', 'DESC')
        ->findAll();

    return $this->response->setJSON([
        'status'   => true,
        'message'  => 'Products fetched successfully',
        'category' => [
            'id'   => $category['id'],
            'name' => $category['category_name'],
            'slug' => $category['slug']
        ],
        'total' => count($records),
        'data'  => array_map([$this, 'formatProduct'], $records)
    ]);
}



    private function formatProduct($record)
    {
        $category = $this->categoryModel->find($record['category_id']);

        return [
            'id' => (int)$record['id'],
            'title' => $record['title'],
            'slug' => $record['slug'],
            'category_name' => $category['category_name'] ?? null,
            'market_demand' => $record['market_demand'],
            'specifications' => json_decode($record['specifications'], true) ?? [],
            'ingredients' => json_decode($record['ingredients'], true) ?? [],
            'uses_benefits' => $record['uses_benefits'],
            'image_url' => $record['image']
                ? base_url('uploads/products/' . $record['image'])
                : null
        ];
    }
}
