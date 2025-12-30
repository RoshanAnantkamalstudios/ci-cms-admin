<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\ProductCategoryModel;

class Products extends BaseController
{
    protected $format = 'json';
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new ProductCategoryModel();
    }

    // List all products
    public function index()
    {
        $data['products'] = $this->productModel->getProducts();
        $data['categories'] = $this->categoryModel->findAll();
        return view('admin/products/product_index', $data);
    }

    // Show Add Product form
    public function create()
    {
        $data['categories'] = $this->categoryModel->findAll();
        return view('admin/products/product_form', $data);
    }

    // Store new product
    public function store()
    {
        $img = $this->request->getFile('image');
        $imgName = null;

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/products/', $imgName);
        }

        // Specifications & Ingredients
        $specifications = $this->request->getPost('specifications') ?? ['key'=>[], 'value'=>[]];
        $ingredients = $this->request->getPost('ingredients') ?? ['name'=>[], 'qty'=>[]];

        // Other Section
        $other_section = [];
        $other_titles = $this->request->getPost('other_title') ?? [];
        $other_descriptions = $this->request->getPost('other_description') ?? [];
        $other_images = $this->request->getFiles()['other_image'] ?? [];

        foreach ($other_titles as $i => $title) {
            $imageNameOther = null;
            if (isset($other_images[$i]) && $other_images[$i]->isValid() && !$other_images[$i]->hasMoved()) {
                $imageNameOther = $other_images[$i]->getRandomName();
                $other_images[$i]->move(FCPATH . 'uploads/products/', $imageNameOther);
            }
            $other_section[] = [
                'title' => $title,
                'description' => $other_descriptions[$i] ?? '',
                'image' => $imageNameOther
            ];
        }

        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', true);

        $this->productModel->save([
            'category_id'    => $this->request->getPost('category_id'),
            'title'          => $title,
            'slug'           => $slug,
            'image'          => $imgName,
            'market_demand'  => $this->request->getPost('market_demand'),
            'specifications' => json_encode($specifications),
            'ingredients'    => json_encode($ingredients),
            'uses_benefits'  => $this->request->getPost('uses_benefits'),
            'heading'        => $this->request->getPost('heading'),
            'description'    => $this->request->getPost('description'),
            'other_section'  => json_encode($other_section)
        ]);

        return redirect()->to(base_url('admin/products'))->with('success', 'Product added successfully');
    }

    // Show Edit form
    public function edit($id)
    {
        $product = $this->productModel->getProducts($id);

        // Decode JSON for form
        $product['specifications'] = json_decode($product['specifications'], true) ?? ['key'=>[], 'value'=>[]];
        $product['ingredients'] = json_decode($product['ingredients'], true) ?? ['name'=>[], 'qty'=>[]];
        $product['other_section'] = json_decode($product['other_section'], true) ?? [];

        $data['product'] = $product;
        $data['categories'] = $this->categoryModel->findAll();

        return view('admin/products/product_form', $data);
    }

    // Update product
    public function update($id)
    {
        $product = $this->productModel->getProducts($id);

        $img = $this->request->getFile('image');
        $imgName = $product['image'];

        if ($img && $img->isValid() && !$img->hasMoved()) {
            if ($imgName && file_exists(FCPATH . 'uploads/products/' . $imgName)) {
                unlink(FCPATH . 'uploads/products/' . $imgName);
            }
            $imgName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/products/', $imgName);
        }

        // Specifications & Ingredients
        $specifications = $this->request->getPost('specifications') ?? ['key'=>[], 'value'=>[]];
        $ingredients = $this->request->getPost('ingredients') ?? ['name'=>[], 'qty'=>[]];

        // Other Section
        $other_section = [];
        $other_titles = $this->request->getPost('other_title') ?? [];
        $other_descriptions = $this->request->getPost('other_description') ?? [];
        $other_images = $this->request->getFiles()['other_image'] ?? [];

        $existing_other = json_decode($product['other_section'], true) ?? [];

        foreach ($other_titles as $i => $title) {
            $imageNameOther = $existing_other[$i]['image'] ?? null;

            if (isset($other_images[$i]) && $other_images[$i]->isValid() && !$other_images[$i]->hasMoved()) {
                if ($imageNameOther && file_exists(FCPATH . 'uploads/products/' . $imageNameOther)) {
                    unlink(FCPATH . 'uploads/products/' . $imageNameOther);
                }
                $imageNameOther = $other_images[$i]->getRandomName();
                $other_images[$i]->move(FCPATH . 'uploads/products/', $imageNameOther);
            }

            $other_section[] = [
                'title' => $title,
                'description' => $other_descriptions[$i] ?? '',
                'image' => $imageNameOther
            ];
        }

        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', true);

        $this->productModel->update($id, [
            'category_id'    => $this->request->getPost('category_id'),
            'title'          => $title,
            'slug'           => $slug,
            'image'          => $imgName,
            'market_demand'  => $this->request->getPost('market_demand'),
            'specifications' => json_encode($specifications),
            'ingredients'    => json_encode($ingredients),
            'uses_benefits'  => $this->request->getPost('uses_benefits'),
            'heading'        => $this->request->getPost('heading'),
            'description'    => $this->request->getPost('description'),
            'other_section'  => json_encode($other_section)
        ]);

        return redirect()->to(base_url('admin/products'))->with('success', 'Product updated successfully');
    }

    // Delete product
    public function delete($id)
    {
        $product = $this->productModel->getProducts($id);

        if ($product && $product['image'] && file_exists(FCPATH . 'uploads/products/' . $product['image'])) {
            unlink(FCPATH . 'uploads/products/' . $product['image']);
        }

        $existing_other = json_decode($product['other_section'], true) ?? [];
        foreach ($existing_other as $other) {
            if (!empty($other['image']) && file_exists(FCPATH . 'uploads/products/' . $other['image'])) {
                unlink(FCPATH . 'uploads/products/' . $other['image']);
            }
        }

        $this->productModel->delete($id);

        return redirect()->to(base_url('admin/products'))->with('success', 'Product deleted successfully');
    }

    // Get product(s) by slug or all
    public function productBySlug($slug = null)
    {
        // SINGLE PRODUCT
        if ($slug) {
            $record = $this->productModel->where('slug', $slug)->first();

            if (!$record) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Product not found',
                    'data'    => null
                ]);
            }

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Product fetched successfully',
                'data'    => $this->formatProduct($record, true)
            ]);
        }

        // ALL PRODUCTS
        $records = $this->productModel->orderBy('id', 'DESC')->findAll();
        if (empty($records)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'No products found',
                'data'    => []
            ]);
        }

        $products = [];
        foreach ($records as $record) {
            $products[] = $this->formatProduct($record, false);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Products fetched successfully',
            'total'   => count($products),
            'data'    => $products
        ]);
    }

    // Helper to format product data
    private function formatProduct($record, $full = true)
    {
        $specifications = json_decode($record['specifications'], true) ?? [];
        $ingredients = json_decode($record['ingredients'], true) ?? [];
        $other_section = json_decode($record['other_section'], true) ?? [];

        // Add full URL for images in other_section
        foreach ($other_section as &$other) {
            if (!empty($other['image'])) {
                $other['image_url'] = base_url('uploads/products/' . $other['image']);
            } else {
                $other['image_url'] = null;
            }
        }

        $category = $this->categoryModel->find($record['category_id']);

        $data = [
            'id'            => (int) $record['id'],
            'title'         => $record['title'],
            'slug'          => $record['slug'],
            'category_name' => $category['category_name'] ?? null,
            'image_url'     => $record['image'] ? base_url('uploads/products/' . $record['image']) : null,
        ];

        if ($full) {
            $data['market_demand']  = $record['market_demand'];
            $data['specifications'] = $specifications;
            $data['ingredients']    = $ingredients;
            $data['uses_benefits']  = $record['uses_benefits'];
            $data['heading']        = $record['heading'];
            $data['description']    = $record['description'];
            $data['other_section']  = $other_section;
        }

        return $data;
    }
}
