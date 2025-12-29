<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class HomeHeroModel extends Model
{
    protected $table = 'home_hero';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'small_title',
        'main_title',
        'sub_title',
        'description',
        'button_text',
        'button_link',
        'images',
        'status'
    ];
}
