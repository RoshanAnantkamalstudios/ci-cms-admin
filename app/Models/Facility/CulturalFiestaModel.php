<?php

namespace App\Models\Facility;

use CodeIgniter\Model;

class CulturalFiestaModel extends Model
{
    protected $table = 'cultural_fiesta';
    protected $primaryKey = 'id';
    protected $allowedFields = ['section_type', 'title', 'subtitle', 'button_text', 'description', 'image'];
    protected $useTimestamps = true;
}
