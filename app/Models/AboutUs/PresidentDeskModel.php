<?php

namespace App\Models\AboutUs;

use CodeIgniter\Model;

class PresidentDeskModel extends Model
{
    protected $table = 'president_desk_page';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'overview',
        'president_image',
        'president_name',
        'designation',
        'address',
        'mobile_no',
    ];
}
