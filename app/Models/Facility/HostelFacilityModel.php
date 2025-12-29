<?php

namespace App\Models\Facility;

use CodeIgniter\Model;

class HostelFacilityModel extends Model
{
    protected $table = 'hostel_facility';
    protected $primaryKey = 'id';
    protected $allowedFields = ['section_type', 'title', 'subtitle', 'button_text', 'description', 'image', 'group_type', 'created_at'];
    protected $useTimestamps = false;
}
