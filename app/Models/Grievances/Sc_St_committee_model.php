<?php

namespace App\Models\Grievances;

use CodeIgniter\Model;

class Sc_St_committee_model extends Model
{
    protected $table = 'sc_st_committee';
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
