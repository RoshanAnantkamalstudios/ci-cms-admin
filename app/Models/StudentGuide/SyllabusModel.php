<?php

namespace App\Models\StudentGuide;

use CodeIgniter\Model;

class SyllabusModel extends Model
{
    protected $table = 'syllabus_content';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'section_type',
        'department',
        'scheme',
        'semester',
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'banner_image',
        'file',
        'sort_order',
    ];

    protected $useTimestamps = true;

    /**
     * Get all syllabus entries grouped by department and scheme
     */
    public function getSyllabusByDepartment()
    {
        return $this->where('section_type', 'syllabus')
            ->orderBy('department, scheme, sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Get hero section data (should return a single row)
     */
    public function getHeroSection()
    {
        return $this->where('section_type', 'hero')->first();
    }
}
