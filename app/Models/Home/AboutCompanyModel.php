<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class AboutCompanyModel extends Model
{
    protected $table = 'about_our_company';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'icon', 
        'short_title', 
        'heading', 
        'description', 
        'about_sections',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
