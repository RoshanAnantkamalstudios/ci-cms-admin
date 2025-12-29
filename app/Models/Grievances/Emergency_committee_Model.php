<?php

namespace App\Models\Grievances;

use CodeIgniter\Model;

class Emergency_committee_Model extends Model
{
    protected $table = 'emergency_committee';
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
