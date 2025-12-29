<?php

namespace App\Models\Facility;

use CodeIgniter\Model;

class CafeteriaModel extends Model
{
    protected $table = 'cafeteria';
    protected $primaryKey = 'id';
    protected $allowedFields = ['section_type', 'title', 'subtitle', 'button_text', 'image', 'description'];
}
