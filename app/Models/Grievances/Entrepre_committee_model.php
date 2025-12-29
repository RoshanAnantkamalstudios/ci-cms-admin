<?php

namespace App\Models\Grievances;

use CodeIgniter\Model;

class Entrepre_committee_model extends Model
{
    protected $table = 'entrepre_committee';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'background_image',
        'name',
        'appointed_as',
        'contact',
        'designation',
        'sort_order',
        'status'
    ];
    protected $useTimestamps = true;
}
