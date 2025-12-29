<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class FacultyModel extends Model
{
    protected $table = 'faculty_members';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'main_title',
        'sub_title',
        'name',
        'designation',
        'department',
        'description',
        'image',
        'sort_order',
        'status'
    ];
}
