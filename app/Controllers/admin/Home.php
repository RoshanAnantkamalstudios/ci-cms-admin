<?php

namespace App\Controllers\Admin;

use App\Models\AddcarModel;
use App\Controllers\BaseController;

use App\Controllers\Frontend\AboutUs;
use App\Models\Home\AboutBvcteModel;
use App\Models\Home\AdmissionSectionModel;
use App\Models\Home\FacilityModel;
use App\Models\Home\FacultyModel;
use App\Models\Home\GalleryModel;
use App\Models\Home\HeroModel;
use App\Models\Home\HeroSectionModel;
use App\Models\Home\OurCoursesModel;
use App\Models\Home\RecruiterModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new HeroSectionModel();
        $data['hero_sections'] = $model->findAll();
        // print_r($data);die; 
        return view('admin/home/carousel', $data);
    }

    public function courosel_section()
    {
        $model = new HeroSectionModel();
        $id = $this->request->getPost('id');
        $data = [
            'title' => $this->request->getPost('title'),
            'sub_title' => $this->request->getPost('sub_title'),
            'btn_text' => $this->request->getPost('btn_text'),
            'btn_link' => $this->request->getPost('btn_link'),
        ];

        // Handle image upload
        $file = $this->request->getFile('banner_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/hero_banners/', $newName);
            $data['banner_image'] = 'uploads/hero_banners/' . $newName;
        }

        if ($id) {
            // Update
            if (empty($data['banner_image'])) {
                unset($data['banner_image']); // Prevent overwriting with null
            }
            $model->update($id, $data);
            session()->setFlashdata('message', 'Hero section updated successfully');
        } else {
            // Insert
            $model->insert($data);
            session()->setFlashdata('message', 'Hero section added successfully');
        }

        return redirect()->to(base_url('hero-section'));
    }

    public function get_hero_data($id)
    {
        $model = new HeroSectionModel();
        return $this->response->setJSON($model->find($id));
    }

    public function deleteHeroSection($id)
    {
        $model = new HeroSectionModel();
        $hero = $model->find($id);

        if (!$hero) {
            return redirect()->back()->with('error', 'Hero section not found.');
        }

        // Optionally delete image from disk
        if (!empty($hero['banner_image']) && file_exists($hero['banner_image'])) {
            unlink($hero['banner_image']);
        }

        $model->delete($id);

        return redirect()->to(base_url('hero-section'))->with('message', 'Hero section deleted successfully.');
    }



    public function aboutsection()
    {
        $model = new AboutBvcteModel();
        $data['data'] = $model->first();
        return view('admin/home/aboutsection', $data);
    }

    public function saveAbout_us()
    {
        $model = new AboutBvcteModel();
        $id = $this->request->getPost('id');

        $data = [
            'overview'     => $this->request->getPost('overview'),
            'approachable' => $this->request->getPost('approachable'),
            'features'     => $this->request->getPost('features'),
            'subtitle'     => $this->request->getPost('subtitle'),
            'btn_link'     => $this->request->getPost('btn_link')
        ];

        // Handle file upload
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/about/', $newName);
            $data['image'] = 'uploads/about/' . $newName;
        }

        if ($id) {
            if (empty($data['image'])) unset($data['image']);
            $model->update($id, $data);
            session()->setFlashdata('message', 'Section updated successfully.');
        } else {
            $model->insert($data);
            session()->setFlashdata('message', 'Section added successfully.');
        }

        return redirect()->to(base_url('aboutsection'));
    }

    public function coursessection()
    {
        $model = new OurCoursesModel();
        $data['courses'] = $model->findAll();
        return view('admin/home/coursessection', $data);
    }

    public function saveour_courses()
    {
        $model = new OurCoursesModel();
        $id = $this->request->getPost('id');

        $data = [
            'title'     => $this->request->getPost('title'),
            'subtitle'  => $this->request->getPost('subtitle'),
            'content'   => $this->request->getPost('content'),
            'btn_text'  => $this->request->getPost('btn_text'),
            'btn_link'  => $this->request->getPost('btn_link'),
        ];

        // Handle file upload
        $file = $this->request->getFile('icon_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/courses/', $newName);
            $data['icon_image'] = 'uploads/courses/' . $newName;
        }

        if ($id) {
            if (empty($data['icon_image'])) unset($data['icon_image']);
            $model->update($id, $data);
            session()->setFlashdata('message', 'Course updated successfully');
        } else {
            $model->insert($data);
            session()->setFlashdata('message', 'Course added successfully');
        }

        return redirect()->to(base_url('coursessection'));
    }

    public function deleteour_courses($id)
    {
        $model = new OurCoursesModel();
        $course = $model->find($id);

        if ($course && !empty($course['icon_image']) && file_exists($course['icon_image'])) {
            unlink($course['icon_image']);
        }

        $model->delete($id);
        session()->setFlashdata('message', 'Course deleted successfully');
        return redirect()->to(base_url('coursessection'));
    }



    public function facilitiessection()
    {
        $model = new FacilityModel();
        $data['facilities'] = $model->findAll();
        return view('admin/home/facilitiessection', $data);
    }

    public function saveFacility()
    {
        $model = new FacilityModel();

        $id = $this->request->getPost('id');
        $data = [
            'heading' => $this->request->getPost('heading'),
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'image' => $this->request->getPost('image'),
            'button_name' => $this->request->getPost('button_name'),
            'button_link' => $this->request->getPost('button_link')
        ];

        // Image Upload
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/facilities/', $newName);
            $data['image'] = 'uploads/facilities/' . $newName;
        }

        if ($id) {
            $model->update($id, $data);
            session()->setFlashdata('message', 'Facility updated successfully!');
        } else {
            $model->insert($data);
            session()->setFlashdata('message', 'Facility added successfully!');
        }

        return redirect()->to(base_url('facilitiessection'));
    }

    public function deleteFacility($id)
    {
        $model = new FacilityModel();
        $facility = $model->find($id);

        if ($facility && file_exists($facility['image'])) {
            unlink($facility['image']);
        }

        $model->delete($id);
        session()->setFlashdata('message', 'Facility deleted.');
        return redirect()->to(base_url('facilitiessection'));
    }


    public function gallerySection()
    {
        $model = new GalleryModel();
        $data['gallery'] = $model->orderBy('id', 'DESC')->findAll();
        return view('admin/home/gallerySection', $data);
    }

    public function saveGallery()
    {
        $model = new GalleryModel();
        $id = $this->request->getPost('id');

        $data = [
            'title'     => $this->request->getPost('title'),
            'btn_text'  => $this->request->getPost('btn_text'),
            // 'image'  => $this->request->getPost('image'),
        ];

        // Handle image upload
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = time() . '_' . $file->getRandomName();
            $file->move('uploads/gallery', $newName);
            $data['image'] = 'uploads/gallery/' . $newName;

            // Delete old image if editing
            if (!empty($id)) {
                $oldData = $model->find($id);
                if (!empty($oldData['image']) && file_exists($oldData['image'])) {
                    unlink($oldData['image']);
                }
            }
        }

        if (!empty($id)) {
            $model->update($id, $data);
            session()->setFlashdata('message', 'Gallery updated successfully.');
        } else {
            $model->insert($data);
            session()->setFlashdata('message', 'Gallery added successfully.');
        }

        return redirect()->to(base_url('gallerySection'));
    }

    public function deleteGallery___($id)
    {
        $model = new GalleryModel();
        $data = $model->find($id);

        if ($data) {
            if (!empty($data['image']) && file_exists($data['image'])) {
                unlink($data['image']);
            }
            $model->delete($id);
            session()->setFlashdata('message', 'Gallery deleted successfully.');
        }

        return redirect()->to(base_url('gallerySection'));
    }


    public function registration()
    {
        $model = new AdmissionSectionModel();
        $data['admission'] = $model->first();
        return view('admin/home/registration', $data);
    }

    public function saveregistration()
    {
        $model = new AdmissionSectionModel();

        $id = $this->request->getPost('id');
        $data = [
            'heading'        => $this->request->getPost('heading'),
            'description'    => $this->request->getPost('description'),
            'end_date'       => $this->request->getPost('end_date'),
            'form_title'     => $this->request->getPost('form_title'),
            'form_subtitle'  => $this->request->getPost('form_subtitle'),
        ];

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        return redirect()->to(base_url('registration'))->with('message', 'Admission section saved successfully.');
        // return redirect()->back()->with('message', 'Admission section saved successfully.');
    }


    public function expertStaff()
    {
        $model = new FacultyModel();
        $data['section'] = $model->where('id', 1)->first();
        $data['faculties'] = $model->where('id !=', 1)->orderBy('sort_order', 'ASC')->findAll();
        return view('admin/home/expertStaff', $data);
    }

    public function saveFaculty()
    {
        $model = new FacultyModel();
        $id = $this->request->getPost('id');

        $data = [
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'department' => $this->request->getPost('department'),
            'description' => $this->request->getPost('description'),
            'sort_order' => $this->request->getPost('sort_order'),
            'status' => $this->request->getPost('status'),
        ];

        // Image Upload
        $img = $this->request->getFile('image');
        if ($img && $img->isValid()) {
            $imageName = $img->getRandomName();
            $img->move('uploads/faculty', $imageName);
            $data['image'] = $imageName;
        }

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('expertStaff'))->with('message', 'Saved successfully');

        // return redirect()->to(base_url('expertStaff'));
        // return redirect()->back();
    }

    public function updateTitleFaculty()
    {
        $model = new FacultyModel();

        $data = [
            'main_title' => $this->request->getPost('main_title'),
            'sub_title' => $this->request->getPost('sub_title'),
        ];

        // Check if id = 1 exists
        $existing = $model->find(1);

        if ($existing) {
            $model->update(1, $data);
        } else {
            // Manually set ID to 1
            $data['id'] = 1;
            $model->insert($data);
        }

        return redirect()->to(base_url('expertStaff'))->with('message', 'Section title saved successfully');
    }


    public function deleteFaculty($id)
    {
        $model = new FacultyModel();
        $model->delete($id);
        return redirect()->to(base_url('expertStaff'));
        // return redirect()->back();
    }

    public function getFaculty($id)
    {
        $model = new FacultyModel();
        return $this->response->setJSON($model->find($id));
    }



    public function placementsSection()
    {
        $model = new RecruiterModel();
        $data['section'] = $model->where('section_title !=', Null)->first();
        // print_r($data);die;
        $data['recruiters'] = $model->where('section_title =', Null)->orderBy('sort_order', 'ASC')->findAll();
        return view('admin/home/placementsSection', $data);
    }


    public function saveRecruiter()
    {
        $model = new RecruiterModel();
        $id = $this->request->getPost('id');

        $data = [
            'alt_text' => $this->request->getPost('alt_text'),
            'sort_order' => $this->request->getPost('sort_order'),
            'status' => $this->request->getPost('status'),
        ];

        $img = $this->request->getFile('image');
        if ($img && $img->isValid()) {
            $imageName = $img->getRandomName();
            $img->move('uploads/recruiters', $imageName);
            $data['image'] = $imageName;
        }

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        return redirect()->to(base_url('placementsSection'))->with('message', 'Saved successfully');
    }

    public function updateTitleRecruiter()
    {
        $model = new RecruiterModel();

        $data = [
            'section_title' => $this->request->getPost('section_title'),
        ];
        // Insert or update logic
        $exists = $model->find(1);
        if ($exists) {
            $model->update(1, $data);
        } else {
            $data['id'] = 1;
            // print_r($data);die;
            $model->insert($data);
        }

        return redirect()->to(base_url('placementsSection'))->with('message', 'Section title updated');
    }


    public function deleteRecruiter($id)
    {
        $model = new RecruiterModel();
        $model->delete($id);
        return redirect()->to(base_url('placementsSection'))->with('message', 'Deleted');
    }

    public function getRecruiter($id)
    {
        $model = new RecruiterModel();
        return $this->response->setJSON($model->find($id));
    }
}
