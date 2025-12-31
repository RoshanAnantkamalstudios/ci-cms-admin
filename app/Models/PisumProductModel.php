<?php

namespace App\Models;

use CodeIgniter\Model;

class PisumProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category_id',
        'name',
        'slug',
        'description',
        'images',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getByCategory($categoryId)
    {
        $rows = $this->where('category_id', $categoryId)->orderBy('created_at', 'DESC')->findAll();
        foreach ($rows as &$row) {
            $imgs = json_decode($row['images'] ?? '[]', true);
            $row['image_urls'] = array_map(function ($img) {
                return base_url('uploads/products/' . $img);
            }, $imgs ?: []);
        }
        return $rows;
    }
}
