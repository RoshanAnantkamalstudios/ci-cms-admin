<?php

namespace App\Models;

use CodeIgniter\Model;

class AdmissionModel extends Model
{
    protected $table = 'admission_enquiry';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'subtitle', 'button_text', 'image'];
    protected $useTimestamps = true;
}
