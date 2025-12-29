<?php

namespace App\Models\TP;

use CodeIgniter\Model;

class TpoTeamModel extends Model
{
    protected $table = 'tpo_team';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'image',
        'name',
        'department',
        'designation',
    ];
}
