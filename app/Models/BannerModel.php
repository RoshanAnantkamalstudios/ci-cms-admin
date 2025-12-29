<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table      = 'banner_section';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'page_key',
        'title',
        'subtitle',
        'banner_image',
        'status'
    ];

    protected $useTimestamps = true;
}
