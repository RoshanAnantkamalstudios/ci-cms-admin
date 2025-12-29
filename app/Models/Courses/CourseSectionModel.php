<?php

namespace App\Models\Courses;

use CodeIgniter\Model;

class CourseSectionModel extends Model
{
    protected $table = 'course_sections';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'course_slug',
        'section_type',
        'title',
        'subtitle',
        'content',
        'button_text',
        'image'
    ];
    protected $useTimestamps = true;
}
