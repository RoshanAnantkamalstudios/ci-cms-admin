<?php

namespace App\Models\TP;

use CodeIgniter\Model;

class MouModel extends Model
{
    protected $table      = 'mou_sections';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'content',
        'image',
        'extra'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
