<?php

namespace App\Models\Facility;

use CodeIgniter\Model;

class LibraryFacilityModel extends Model
{
    protected $table = 'library_facility';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'image',
        'description',
        'group_type',
    ];
}
