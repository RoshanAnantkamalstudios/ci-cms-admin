<?php

namespace App\Controllers\admin;

use App\Models\ProductCategoryModel;
use App\Controllers\BaseController;
class ProductCategory extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ProductCategoryModel();
    }

    // LIST + ADD FORM
    public function index()
    {
        return view('admin/product_category', [
            'categories' => $this->model->orderBy('id', 'DESC')->findAll(),
            'editData'   => null
        ]);
    }

    // SAVE
    public function save()
    {
        $image = $this->uploadImage();

        $this->model->insert([
            'background_image' => $image,
            'category_name'       => $this->request->getPost('category_name'),
            'heading'          => $this->request->getPost('heading'),
            'description'      => $this->request->getPost('description')
        ]);

        return redirect()->back()->with('message', 'Category added successfully');
    }

    // EDIT
    public function edit($id)
    {
        return view('admin/product_category', [
            'categories' => $this->model->orderBy('id', 'DESC')->findAll(),
            'editData'   => $this->model->find($id)
        ]);
    }

    // UPDATE
    public function update($id)
    {
        $old = $this->model->find($id);
        $image = $old['background_image'];

        $newImage = $this->uploadImage();
        if ($newImage) {
            $image = $newImage;
        }

        $this->model->update($id, [
            'background_image' => $image,
            'category_name'       => $this->request->getPost('category_name'),
            'heading'          => $this->request->getPost('heading'),
            'description'      => $this->request->getPost('description')
        ]);

        return redirect()->to('admin/product-category')
            ->with('message', 'Category updated successfully');
    }

    // DELETE
    public function delete($id)
    {
        $data = $this->model->find($id);

        if ($data && $data['background_image'] && file_exists($data['background_image'])) {
            unlink($data['background_image']);
        }

        $this->model->delete($id);

        return redirect()->back()->with('message', 'Category deleted successfully');
    }

    // IMAGE UPLOAD
    private function uploadImage()
    {
        $file = $this->request->getFile('background_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName();
            $file->move('uploads/categories', $name);
            return 'uploads/categories/' . $name;
        }
        return null;
    }
}
