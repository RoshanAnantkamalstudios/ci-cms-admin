<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\ProductCategoryModel;

class ProductsApi extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel  = new ProductModel();
        $this->categoryModel = new ProductCategoryModel();
    }

public function productBySlug($slug = null)
{
    // 🔹 SINGLE PRODUCT
    if ($slug) {
        $record = $this->productModel->where('slug', $slug)->first();

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
    $records = $this->productModel->orderBy('id', 'DESC')->findAll();

    return $this->response->setJSON([
        'status' => true,
        'message' => 'Products fetched successfully',
        'total' => count($records),
        'data' => array_map([$this, 'formatProduct'], $records)
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
