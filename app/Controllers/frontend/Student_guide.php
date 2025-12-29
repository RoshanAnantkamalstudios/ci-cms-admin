<?php

namespace App\Controllers\Frontend;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\StudentGuide\AcademicCalendarModel;
use App\Models\StudentGuide\CampusPlacementModel;
use App\Models\StudentGuide\ExamDownloadModel;
use App\Models\StudentGuide\ExaminationModel;
use App\Models\StudentGuide\ExaminationScheduleModel;
use App\Models\StudentGuide\SyllabusModel;

class Student_guide extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function Index()
    {
        $model = new ExaminationModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['exam_rows'] = $model->where('section_type', 'exam')->orderBy('sort_order', 'asc')->findAll();
        return view('frontend/student_guide/examination_notice', $data);
    }

    public function academic_calendar()
    {
        $model = new AcademicCalendarModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['calendar'] = $model->where('section_type', 'calendar')->orderBy('sort_order')->findAll();
        return view('frontend/student_guide/academic_calendar', $data);
    }

    public function examination_schedule()
    {
        $model = new ExaminationScheduleModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['schedules'] = $model->where('section_type', 'schedule')->orderBy('sort_order')->findAll();
        return view('frontend/student_guide/examination_schedule', $data);
    }

    public function syllabus_downloads()
    {
        $model = new SyllabusModel();

        // Get the hero section content
        $data['hero'] = $model->where('section_type', 'hero')->first();

        // Get all syllabus entries
        $data['entries'] = $model->where('section_type', 'syllabus')
            ->orderBy('department')
            ->orderBy('scheme')
            ->orderBy('semester')
            ->findAll();
        return view('frontend/student_guide/syllabus_downloads', $data);
    }

    public function exam_downloads()
    {
        $model = new ExamDownloadModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();

        $entries = $model->where('section_type', 'download')->findAll();

        $grouped = [];

        foreach ($entries as $entry) {
            $dept = trim($entry['department']);
            $cat = trim($entry['category']);

            $grouped[$dept][$cat][] = $entry;
        }

        $data['downloads'] = $grouped;

        return view('frontend/student_guide/exam_downloads', $data);
    }

    public function campus_recruitment()
    {
        $model = new CampusPlacementModel();

        $data['hero'] = $model->where('section', 'hero')->first();
        $data['recruiters'] = $model->where('section', 'recruiter')->findAll();
        $data['process'] = $model->where('section', 'process')->findAll();
        $data['about']      = $model->where('section', 'about')->first();
        return view('frontend/student_guide/campus_recruitment',$data);
    }
}
