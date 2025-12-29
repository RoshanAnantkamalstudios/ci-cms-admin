<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class AdmissionSectionModel extends Model
{
    protected $table = 'admission_section';
    protected $primaryKey = 'id';
    protected $allowedFields = ['heading', 'description', 'end_date', 'form_title', 'form_subtitle'];
}
