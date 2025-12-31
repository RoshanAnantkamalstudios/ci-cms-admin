<?php namespace App\Models;

use CodeIgniter\Model;

class PisumProductModel extends Model
{
    protected $table = 'products_grocery';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'category_id',
        'title',
        'slug',
        'image',
        'market_demand',
        'specifications',
        'ingredients',
        'uses_benefits',
        'heading',
        'description',
        'other_section',
         'status' // 👈 REQUIRED
    ];
    
    protected $useTimestamps = true;

    // Get all products or single by ID
    public function getProducts($id = false)
    {
        if ($id === false) {
            return $this->orderBy('id', 'DESC')->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }

    // Get single product by slug
    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
}

