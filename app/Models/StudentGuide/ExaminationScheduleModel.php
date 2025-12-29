<?php

namespace App\Models\StudentGuide;

use CodeIgniter\Model;

class ExaminationScheduleModel extends Model
{
    protected $table = 'examination_schedule';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'department',
        'year_1st',
        'year_2nd',
        'year_3rd',
        'sort_order',
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'banner_image'
    ];
}
