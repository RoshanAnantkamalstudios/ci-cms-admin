<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class RecruiterModel extends Model
{
    protected $table = 'recruiters';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'main_title',
        'sub_title',
        'section_title', 
        'image',
        'alt_text',
        'sort_order',
        'status'
    ];
}
