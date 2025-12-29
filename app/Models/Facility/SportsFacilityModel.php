<?php

namespace App\Models\Facility;

use CodeIgniter\Model;

class SportsFacilityModel extends Model
{
    protected $table = 'sports_facility';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'description',
        'image',
    ];
}
