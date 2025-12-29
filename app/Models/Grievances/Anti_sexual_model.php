<?php

namespace App\Models\Grievances;

use CodeIgniter\Model;

class Anti_sexual_model extends Model
{
    protected $table = 'anti_sexual';
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
