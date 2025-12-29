<?php

namespace App\Models\AboutUs;

use CodeIgniter\Model;

class BoardGovernanceModel extends Model
{
    protected $table = 'board_governance';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'type',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'name',
        'designation',
        'background',
        'photo',
        'display_order'
    ];
}
