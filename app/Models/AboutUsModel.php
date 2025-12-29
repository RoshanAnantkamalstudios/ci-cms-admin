<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutUsModel extends Model
{
    protected $table            = 'about_us';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'about_icon',
        'about_heading',
        'about_cards',
        'quality_bg_image',
        'quality_icon',
        'quality_heading',
        'quality_cards',
        'vision_cards',
        'values_image',
        'values_heading',
        'values_cards',
        'questions',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
