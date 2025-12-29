<?php

namespace App\Models\StudentGuide;

use CodeIgniter\Model;

class ExamDownloadModel extends Model
{
    protected $table = 'exam_downloads';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'title_text',
        'subtitle_text',
        'button_text',
        'banner_image',
        'department',
        'scheme',
        'semester',
        'category',
        'title',
        'file'
    ];
}
