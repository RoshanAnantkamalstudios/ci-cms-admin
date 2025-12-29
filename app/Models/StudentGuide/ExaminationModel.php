<?php

namespace App\Models\StudentGuide;

use CodeIgniter\Model;

class ExaminationModel extends Model
{
    protected $table = 'examination_content';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'background_image',
        'activity',
        'period_second_year',
        'period_first_year',
        'sort_order'
    ];
}
