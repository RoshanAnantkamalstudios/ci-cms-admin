<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class HeroSectionModel extends Model
{
    protected $table = 'hero_sections';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'sub_title', 'btn_text', 'btn_link', 'banner_image'];
}
