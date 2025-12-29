<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table = 'campus_gallery';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'item',
        'image',
        'hero_title',      
        'hero_subtitle',    
        'banner_image',
    ];

    protected $useTimestamps = true;
}
