<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactUsModel extends Model
{
    protected $table            = 'contact_us';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'address_title',
        'address',
        'phone_title',
        'phone_numbers',
        'emails_title',
        'emails',
        'contact_heading',
        'contact_btn_name',
        'contact_btn_url',
        'branch_image',
        'branch_heading',
        'branches',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
