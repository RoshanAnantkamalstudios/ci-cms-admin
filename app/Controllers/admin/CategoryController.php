<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'categories' => $this->categoryModel->getTree(),
            'flat_categories' => $this->categoryModel->orderBy('level', 'ASC')->orderBy('name', 'ASC')->findAll()
        ];
        return view('admin/category/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'name' => 'required|min_length[2]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getPost('name');
        $parentId = $this->request->getPost('parent_id') ?: null;

        // Calculate level
        $level = 0;
        if ($parentId) {
            $parent = $this->categoryModel->find($parentId);
            if ($parent) {
                $level = $parent['level'] + 1;
            }
        }

        // Handle Image
        $imageName = null;
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/category', $imageName);
        }

        $data = [
            'parent_id' => $parentId,
            'name'      => $name,
            'slug'      => url_title($name, '-', true),
            'level'     => $level,
            'status'    => 1
        ];

        if ($imageName) {
            $data['image'] = $imageName;
        }

        if ($id) {
            // Update
            // If image is not uploaded, keep old one? The model handles this if we don't pass 'image' key, 
            // but here we are building $data.
            // If $imageName is null, we shouldn't overwrite unless we want to delete it.
            // For now, only update image if new one provided.

            // Check if we are moving a parent into itself (circular dependency check could be added here)
            if ($id == $parentId) {
                return redirect()->back()->with('error', 'Category cannot be its own parent.');
            }

            $this->categoryModel->update($id, $data);
            $message = 'Category updated successfully';
        } else {
            $this->categoryModel->insert($data);
            $message = 'Category created successfully';
        }

        return redirect()->to(base_url('admin/categories'))->with('success', $message);
    }

    public function delete($id)
    {
        $category = $this->categoryModel->find($id);
        if ($category) {
            // Check for children
            $children = $this->categoryModel->where('parent_id', $id)->findAll();
            if (!empty($children)) {
                return redirect()->back()->with('error', 'Cannot delete category with subcategories. Delete them first.');
            }

            if ($category['image'] && file_exists(FCPATH . 'uploads/category/' . $category['image'])) {
                unlink(FCPATH . 'uploads/category/' . $category['image']);
            }
            $this->categoryModel->delete($id);
        }
        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    // API for dynamic dropdowns
    public function getSubcategories($parentId)
    {
        $subcategories = $this->categoryModel->where('parent_id', $parentId)->findAll();
        return $this->response->setJSON($subcategories);
    }

    // Frontend APIs
    public function getCategoriesTreeJson()
    {
        try {
            $tree = $this->categoryModel->getTree();
            $map = function ($nodes) use (&$map) {
                return array_map(function ($n) use ($map) {
                    $item = [
                        'id' => $n['id'],
                        'parent_id' => $n['parent_id'],
                        'name' => $n['name'],
                        'slug' => $n['slug'],
                        'level' => $n['level'],
                        'status' => (int)($n['status'] ?? 1),
                        'image_url' => !empty($n['image']) ? base_url('uploads/category/' . $n['image']) : null,
                    ];
                    if (!empty($n['children'])) {
                        $item['children'] = $map($n['children']);
                    }
                    return $item;
                }, $nodes);
            };

            return $this->response->setJSON([
                'status' => 'success',
                'data' => $map($tree),
            ])->setStatusCode(200);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error fetching categories',
            ])->setStatusCode(500);
        }
    }

    public function getCategoriesFlatJson()
    {
        try {
            $rows = $this->categoryModel->orderBy('level', 'ASC')->orderBy('name', 'ASC')->findAll();
            $data = array_map(function ($n) {
                return [
                    'id' => $n['id'],
                    'parent_id' => $n['parent_id'],
                    'name' => $n['name'],
                    'slug' => $n['slug'],
                    'level' => $n['level'],
                    'status' => (int)($n['status'] ?? 1),
                    'image_url' => !empty($n['image']) ? base_url('uploads/category/' . $n['image']) : null,
                ];
            }, $rows);

            return $this->response->setJSON([
                'status' => 'success',
                'data' => $data,
            ])->setStatusCode(200);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error fetching categories',
            ])->setStatusCode(500);
        }
    }

    public function getSubcategoriesApi($parentId)
    {
        try {
            $rows = $this->categoryModel->where('parent_id', $parentId)->orderBy('name', 'ASC')->findAll();
            $data = array_map(function ($n) {
                return [
                    'id' => $n['id'],
                    'parent_id' => $n['parent_id'],
                    'name' => $n['name'],
                    'slug' => $n['slug'],
                    'level' => $n['level'],
                    'status' => (int)($n['status'] ?? 1),
                    'image_url' => !empty($n['image']) ? base_url('uploads/category/' . $n['image']) : null,
                ];
            }, $rows);

            return $this->response->setJSON([
                'status' => 'success',
                'data' => $data,
            ])->setStatusCode(200);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error fetching subcategories',
            ])->setStatusCode(500);
        }
    }
}
