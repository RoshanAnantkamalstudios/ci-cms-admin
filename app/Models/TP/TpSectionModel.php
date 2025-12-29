<?php

namespace App\Models\TP;

use CodeIgniter\Model;

class TpSectionModel extends Model
{
    protected $table = 'tp_sections';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'description',
        'extra',
        'image',
        'created_at'
    ];
}
