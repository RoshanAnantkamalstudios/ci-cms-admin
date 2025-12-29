<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniPageModel extends Model
{
    protected $table = 'alumni_page_sections';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'content',
        'image',
        'extra_data',
        'order',
        'status'
    ];
}
