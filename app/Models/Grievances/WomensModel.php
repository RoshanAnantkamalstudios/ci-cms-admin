<?php

namespace App\Models\Grievances;

use CodeIgniter\Model;

class WomensModel extends Model
{
    protected $table = 'womens_committee';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'background_image',
        'name',
        'designation',
        'sort_order',
        'status'
    ];
    protected $useTimestamps = true;
}
