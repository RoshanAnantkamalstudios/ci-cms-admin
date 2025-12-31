<?php

namespace App\Controllers\Admin;

use App\Models\AlumniPageModel;
use App\Controllers\BaseController;
use App\Models\AdmissionModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class Dashboard extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function dashboard()
    {
        $categoryModel = new CategoryModel();
        $productModel = new ProductModel();

        $categoryCount = $categoryModel->countAllResults();
        $productCount = $productModel->countAllResults();

        $recentCategories = $categoryModel->orderBy('created_at', 'DESC')->limit(6)->find();
        $recentProducts = $productModel->orderBy('created_at', 'DESC')->limit(6)->find();

        $categoryIds = array_unique(array_column($recentProducts, 'category_id'));
        $categoryMap = [];
        if (!empty($categoryIds)) {
            $cats = $categoryModel->whereIn('id', $categoryIds)->findAll();
            foreach ($cats as $c) {
                $categoryMap[$c['id']] = $c['name'];
            }
        }

        foreach ($recentProducts as &$p) {
            $imgs = json_decode($p['images'] ?? '[]', true) ?: [];
            $p['thumb'] = isset($imgs[0]) ? base_url('uploads/products/' . $imgs[0]) : null;
            $p['category_name'] = $categoryMap[$p['category_id']] ?? '-';
        }

        return view('admin/dasboard', [
            'category_count' => $categoryCount,
            'product_count' => $productCount,
            'recent_categories' => $recentCategories,
            'recent_products' => $recentProducts,
        ]);
    }
}
