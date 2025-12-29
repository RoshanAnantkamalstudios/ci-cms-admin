<?php

namespace App\Models\StudentGuide;

use CodeIgniter\Model;

class AcademicCalendarModel extends Model
{
    protected $table = 'academic_calendar';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'background_image',
        'activity',
        'second_third_year_period',
        'first_year_period',
        'sort_order',
        'status'
    ];
}
