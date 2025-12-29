<?php

namespace App\Models\Grievances;

use CodeIgniter\Model;

class GrievanceModel extends Model
{
    protected $table = 'grievance_committee';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'background_image',
        'name',
        'designation',
        'associated_with',
        'sort_order',
        'status'
    ];
}
