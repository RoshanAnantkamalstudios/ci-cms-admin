<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $flatCategories = $this->categoryModel->orderBy('level', 'ASC')->orderBy('name', 'ASC')->findAll();
        $selectedCategory = $this->request->getGet('category_id');
        $products = [];
        if ($selectedCategory) {
            $products = $this->productModel->getByCategory($selectedCategory);
        }
        return view('admin/product/index', [
            'flat_categories' => $flatCategories,
            'selected_category' => $selectedCategory,
            'products' => $products
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');
        $categoryId = $this->request->getPost('category_id');
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');

        $images = [];
        $existingImages = $this->request->getPost('existing_images') ? json_decode($this->request->getPost('existing_images'), true) : [];
        if (is_array($existingImages)) {
            $images = $existingImages;
        }

        $uploadDir = FCPATH . 'uploads/products';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $files = $this->request->getFileMultiple('images');
        if ($files) {
            foreach ($files as $file) {
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move($uploadDir, $newName);
                    $images[] = $newName;
                }
            }
        }

        $data = [
            'category_id' => $categoryId ?: null,
            'name' => $name,
            'slug' => $name ? url_title($name, '-', true) : null,
            'description' => $description,
            'images' => json_encode($images),
            'status' => 1
        ];

        if ($id) {
            $this->productModel->update($id, $data);
            $message = 'Product updated successfully';
        } else {
            $this->productModel->insert($data);
            $message = 'Product created successfully';
        }

        return redirect()->to(base_url('admin/products?category_id=' . ($categoryId ?: '')))->with('success', $message);
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if ($product) {
            $images = json_decode($product['images'] ?? '[]', true);
            foreach ($images as $img) {
                $path = FCPATH . 'uploads/products/' . $img;
                if ($img && file_exists($path)) {
                    unlink($path);
                }
            }
            $this->productModel->delete($id);
        }
        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    // Ajax helper to list products by category
    public function listByCategory($categoryId)
    {
        $rows = $this->productModel->getByCategory($categoryId);
        return $this->response->setJSON([
            'status' => 'success',
            'data' => $rows
        ]);
    }

    public function getProductsJson()
    {
        $rows = $this->productModel->orderBy('created_at', 'DESC')->findAll();
        $data = array_map(function ($p) {
            $imgs = json_decode($p['images'] ?? '[]', true) ?: [];
            $urls = array_map(function ($img) {
                return base_url('uploads/products/' . $img);
            }, $imgs);
            return [
                'id' => $p['id'],
                'category_id' => $p['category_id'],
                'name' => $p['name'],
                'slug' => $p['slug'],
                'description' => $p['description'],
                'image_urls' => $urls,
                'created_at' => $p['created_at'],
                'updated_at' => $p['updated_at'],
            ];
        }, $rows);
        return $this->response->setJSON(['status' => 'success', 'data' => $data])->setStatusCode(200);
    }

    public function getProductsByCategoryJson($categoryId)
    {
        $rows = $this->productModel->getByCategory($categoryId);
        $data = array_map(function ($p) {
            return [
                'id' => $p['id'],
                'category_id' => $p['category_id'],
                'name' => $p['name'],
                'slug' => $p['slug'],
                'description' => $p['description'],
                'image_urls' => $p['image_urls'],
                'created_at' => $p['created_at'],
                'updated_at' => $p['updated_at'],
            ];
        }, $rows);
        return $this->response->setJSON(['status' => 'success', 'data' => $data])->setStatusCode(200);
    }

    public function getProductJson($id)
    {
        $p = $this->productModel->find($id);
        if (!$p) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Not found'])->setStatusCode(404);
        }
        $imgs = json_decode($p['images'] ?? '[]', true) ?: [];
        $urls = array_map(function ($img) {
            return base_url('uploads/products/' . $img);
        }, $imgs);
        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'id' => $p['id'],
                'category_id' => $p['category_id'],
                'name' => $p['name'],
                'slug' => $p['slug'],
                'description' => $p['description'],
                'image_urls' => $urls,
                'created_at' => $p['created_at'],
                'updated_at' => $p['updated_at'],
            ]
        ])->setStatusCode(200);
    }
}
