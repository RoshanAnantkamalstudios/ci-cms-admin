<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'background_image',
        'category_name',
        'heading',
        'description'
    ];

    protected $useTimestamps = true;

    public function getSingle()
    {
        return $this->orderBy('id', 'DESC')->first();
    }
}
