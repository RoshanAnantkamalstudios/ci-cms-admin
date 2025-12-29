<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class FacilityModel extends Model
{
    protected $table = 'facilities';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'heading',
        'title',
        'subtitle',
        'button_name',
        'button_link',
        'image'
    ];
}
