<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class AboutBvcteModel extends Model
{
    protected $table = 'about_bvcte';
    protected $primaryKey = 'id';
    protected $allowedFields = ['overview', 'approachable', 'features', 'subtitle','btn_link', 'image'];
}
