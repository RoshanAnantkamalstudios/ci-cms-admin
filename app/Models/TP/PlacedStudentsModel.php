<?php

namespace App\Models\TP;

use CodeIgniter\Model;

class PlacedStudentsModel extends Model
{
    protected $table = 'placed_students';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'name',
        'branch',
        'company',
        'title',
        'subtitle',
        'button_text',
        'image'
    ];
}
