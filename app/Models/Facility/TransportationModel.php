<?php

namespace App\Models\Facility;

use CodeIgniter\Model;

class TransportationModel extends Model
{
    protected $table = 'transportation';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'description',
        'image'
    ];
}
