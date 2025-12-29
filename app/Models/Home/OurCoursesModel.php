<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class OurCoursesModel extends Model
{
    protected $table = 'our_courses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'subtitle', 'content', 'btn_text', 'btn_link', 'icon_image'];
}
