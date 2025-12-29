<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StudentGuide\AcademicCalendarModel;
use App\Models\StudentGuide\CampusPlacementModel;
use App\Models\StudentGuide\ExamDownloadModel;
use App\Models\StudentGuide\ExaminationModel;
use App\Models\StudentGuide\ExaminationScheduleModel;
use App\Models\StudentGuide\SyllabusModel;

class Examination extends BaseController
{
    public function examination()
    {
        $model = new ExaminationModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['exams'] = $model->where('section_type', 'exam')->orderBy('sort_order', 'asc')->findAll();
        return view('admin/Examination/examination', $data);
    }

    public function saveHeroExamination()
    {
        $model = new ExaminationModel();
        $data = [
            'section_type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
        ];

        // Handle image upload
        $file = $this->request->getFile('background_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/banner/', $newName);
            $data['background_image'] = $newName;
        }

        $id = $this->request->getPost('id');
        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('examination'))->with('success', 'Hero section saved successfully');
    }

    public function saveExamination()
    {
        $model = new ExaminationModel();
        $data = [
            'section_type' => 'exam',
            'activity' => $this->request->getPost('activity'),
            'period_second_year' => $this->request->getPost('period_second_year'),
            'period_first_year' => $this->request->getPost('period_first_year'),
            'sort_order' => $this->request->getPost('sort_order'),
        ];
        // echo "<pre>";
        // print_r($data);die;
        $id = $this->request->getPost('id');
        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('examination'))->with('success', 'Exam entry saved successfully');
    }

    public function deleteExamination($id)
    {
        $model = new ExaminationModel();
        $model->delete($id);

        return redirect()->to(base_url('examination'))->with('success', 'Exam entry deleted successfully');
    }



    public function academiccalendar()
    {
        $model = new AcademicCalendarModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['calendar'] = $model->where('section_type', 'calendar')->orderBy('sort_order')->findAll();
        return view('admin/Examination/academiccalendar', $data);
    }

    public function saveAcademicHero()
    {
        $model = new AcademicCalendarModel();

        $data = $this->request->getPost();
        $data['section_type'] = 'hero';

        $file = $this->request->getFile('background_image');
        if ($file && $file->isValid()) {
            $name = $file->getRandomName();
            $file->move('uploads/banner', $name);
            $data['background_image'] = $name;
        }

        if (!empty($data['id'])) {
            $model->update($data['id'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('academiccalendar'))->with('success', 'Hero section updated');
    }

    public function saveAcademicEvent()
    {
        $model = new AcademicCalendarModel();

        $data = $this->request->getPost();
        $data['section_type'] = 'calendar';

        if (!empty($data['id'])) {
            $model->update($data['id'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('academiccalendar'))->with('success', 'Calendar event saved');
    }

    public function deleteAcademicEvent($id)
    {
        $model = new AcademicCalendarModel();
        $model->delete($id);
        return redirect()->to(base_url('academiccalendar'))->with('success', 'Event deleted');
    }



    public function examinationschedule()
    {
        $model = new ExaminationScheduleModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['schedules'] = $model->where('section_type', 'schedule')->orderBy('sort_order')->findAll();
        return view('admin/Examination/examinationschedule', $data);
    }

    public function saveHeroExam_schedule()
    {
        $model = new ExaminationScheduleModel();
        $data = $this->request->getPost();

        if ($file = $this->request->getFile('banner_image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $name = $file->getRandomName();
                $file->move('uploads/banner', $name);
                $data['banner_image'] = $name;
            }
        }

        $data['section_type'] = 'hero';

        if ($this->request->getPost('id')) {
            $model->update($this->request->getPost('id'), $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('examinationschedule'))->with('success', 'Hero section saved.');
    }

    public function saveScheduleExam_schedule()
    {
        $model = new ExaminationScheduleModel();
        $data = $this->request->getPost();
        $data['section_type'] = 'schedule';

        if (!empty($data['id'])) {
            $model->update($data['id'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('examinationschedule'))->with('success', 'Schedule saved.');
    }

    public function deleteScheduleExam_schedule($id)
    {
        $model = new ExaminationScheduleModel();
        $model->delete($id);
        return redirect()->to(base_url('examinationschedule'))->with('success', 'Deleted.');
    }



    public function syllabusdownload()
    {
        $model = new SyllabusModel();

        $data['hero'] = $model->getHeroSection();
        $data['entries'] = $model->where('section_type', 'syllabus')->orderBy('department')->findAll();
        return view('admin/Examination/syllabusdownload', $data);
    }

    public function saveHeroSyllabus()
    {
        $model = new SyllabusModel();
        $data = $this->request->getPost();
        $data['section_type'] = 'hero';

        // Handle banner image upload
        $file = $this->request->getFile('banner_image');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move('uploads/banners/', $newName);
            $data['banner_image'] = $newName;
        }

        if (!empty($data['id'])) {
            $model->update($data['id'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('syllabusdownload'))->with('success', 'Hero section saved.');
    }

    public function saveEntrySyllabus()
    {
        $model = new SyllabusModel();
        $data = $this->request->getPost();
        $data['section_type'] = 'syllabus';

        // Handle syllabus file
        $file = $this->request->getFile('file');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move('uploads/syllabus/', $newName);
            $data['file'] = $newName;
        }

        if (!empty($data['id'])) {
            $model->update($data['id'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('syllabusdownload'))->with('success', 'Syllabus entry saved.');
    }

    public function deleteEntrySyllabus($id)
    {
        $model = new SyllabusModel();
        $model->delete($id);

        return redirect()->to(base_url('syllabusdownload'))->with('success', 'Entry deleted.');
    }

    public function getEntry($id)
    {
        $model = new SyllabusModel();
        return $this->response->setJSON($model->find($id));
    }


    public function examdownloads()
    {
        $model = new ExamDownloadModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['entries'] = $model->where('section_type', 'download')->findAll();
        return view('admin/Examination/examdownloads', $data);
    }

    public function saveHeroExamDownload()
    {
        $model = new ExamDownloadModel();
        $data = $this->request->getPost();
        $data['section_type'] = 'hero';

        $file = $this->request->getFile('banner_image');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move('uploads/banners/', $newName);
            $data['banner_image'] = $newName;
        }

        if (!empty($data['id'])) {
            $model->update($data['id'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('examdownloads'))->with('success', 'Hero section saved');
    }

    public function saveEntryExamination()
    {
        $model = new ExamDownloadModel();
        $data = $this->request->getPost();
        $data['section_type'] = 'download';

        $file = $this->request->getFile('file');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move('uploads/downloads/', $newName);
            $data['file'] = $newName;
        }

        if (!empty($data['id'])) {
            $model->update($data['id'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('examdownloads'))->with('success', 'Download saved');
    }

    public function deleteExamDownload($id)
    {
        $model = new ExamDownloadModel();
        $model->delete($id);
        return redirect()->to(base_url('examdownloads'))->with('success', 'Entry deleted');
    }

    public function campusrecruitment()
    {
        $model = new CampusPlacementModel();
        $data['hero'] = $model->where('section', 'hero')->first();
        $data['recruiters'] = $model->where('section', 'recruiter')->findAll();
        $data['process'] = $model->where('section', 'process')->findAll();
        $data['about']      = $model->where('section', 'about')->first();
        return view('admin/Examination/campusrecruitment', $data);
    }

    public function saveCampus()
    {
        $model = new CampusPlacementModel();
        $id = $this->request->getPost('id');
        $data = [
            'section'     => $this->request->getPost('section'),
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'icon'        => $this->request->getPost('icon'),
            'description' => $this->request->getPost('description'),
        ];

        if ($file = $this->request->getFile('image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $name = $file->getRandomName();
                $file->move('uploads/placements/', $name);
                $data['image'] = $name;
            }
        }

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('campusrecruitment'))->with('success', 'Saved successfully');
    }

    public function deleteCampus($id)
    {
        $model = new CampusPlacementModel();
        $model->delete($id);
        return redirect()->to(base_url('campusrecruitment'))->with('success', 'Deleted successfully');
    }
}
