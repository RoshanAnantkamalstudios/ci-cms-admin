<?php

namespace App\Models\AboutUs;

use CodeIgniter\Model;

class PrincipalDeskModel extends Model
{
    protected $table = 'principal_desk_page';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'message',
        'principal_name',
        'designation',
        'address',
        'mobile_no',
        'principal_image',
    ];
}
