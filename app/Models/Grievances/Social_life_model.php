<?php

namespace App\Models\Grievances;

use CodeIgniter\Model;

class Social_life_model extends Model
{
    protected $table = 'social_life';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'background_image',
        'name',
        'designation',
        'appointed_as',
        'contact',
        'sort_order',
        'status'
    ];
    protected $useTimestamps = true;
}