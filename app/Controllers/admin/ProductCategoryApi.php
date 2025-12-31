<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductCategoryModel;

class ProductCategoryApi extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ProductCategoryModel();
    }

    /**
     * GET ALL CATEGORIES OR SINGLE BY SLUG
     * /api/categories
     * /api/categories/{slug}
     */
    public function index($slug = null)
    {
        if ($slug) {
            $category = $this->model
                ->where('slug', $slug)
                ->where('status', 1)
                ->first();

            if (!$category) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Category not found'
                ])->setStatusCode(404);
            }

            return $this->response->setJSON([
                'status' => true,
                'data'   => $category
            ]);
        }

        // 🔹 All categories
        $categories = $this->model
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'count'  => count($categories),
            'data'   => $categories
        ]);
    }
}
