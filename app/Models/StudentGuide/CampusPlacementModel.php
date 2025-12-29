<?php

namespace App\Models\StudentGuide;

use CodeIgniter\Model;

class CampusPlacementModel extends Model
{
    protected $table = 'campus_placements';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section',
        'title',
        'subtitle',
        'image',
        'icon',
        'description',
        'status'
    ];
}
