<?php

namespace App\Models\Courses;

use CodeIgniter\Model;

class ComputerTechnologyModel extends Model
{
    protected $table = 'computer_technology';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'sub_type',
        'title',
        'subtitle',
        'description',
        'icon',
        'image',
        'video',
        'button_text',
        'button_link',
        'extra_data',
        'sort_order',
        'status'
    ];
}
