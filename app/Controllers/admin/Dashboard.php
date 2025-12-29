<?php

namespace App\Controllers\Admin;

use App\Models\AlumniPageModel;
use App\Controllers\BaseController;
use App\Models\AdmissionModel;

class Dashboard extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function dashboard()
    {
        return view('admin/dasboard');
    }
    public function Alumini()
    {
        $model = new AlumniPageModel();
        $data['sections'] = $model->orderBy('section_type')->findAll();
        return view('admin/alumini');
    }

    public function store()
    {
        $model = new AlumniPageModel();
        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads', $imageName);
        }

        $extraData = [
            'year' => $this->request->getPost('year'),
            'role' => $this->request->getPost('role'),
        ];

        $model->save([
            'section_type' => $this->request->getPost('section_type'),
            'title'        => $this->request->getPost('title'),
            'subtitle'     => $this->request->getPost('subtitle'),
            'content'      => $this->request->getPost('content'),
            'image'        => $imageName,
            'extra_data'   => json_encode($extraData),
            'order'        => $this->request->getPost('order') ?? 0,
            'status'       => $this->request->getPost('status') ?? 1
        ]);
        return redirect()->to(base_url('alumeni'))->with('message', 'Section added successfully!');
    }

    public function update($id)
    {
        $model = new AlumniPageModel();
        $section = $model->find($id);

        $image = $this->request->getFile('image');
        $imageName = $section['image'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            if (!empty($imageName) && file_exists('uploads/' . $imageName)) {
                unlink('uploads/' . $imageName);
            }
            $imageName = $image->getRandomName();
            $image->move('uploads', $imageName);
        }

        $extraData = [
            'year' => $this->request->getPost('year'),
            'role' => $this->request->getPost('role'),
        ];

        $model->update($id, [
            'section_type' => $this->request->getPost('section_type'),
            'title'        => $this->request->getPost('title'),
            'subtitle'     => $this->request->getPost('subtitle'),
            'content'      => $this->request->getPost('content'),
            'image'        => $imageName,
            'extra_data'   => json_encode($extraData),
            'order'        => $this->request->getPost('order'),
            'status'       => $this->request->getPost('status')
        ]);
        return redirect()->to(base_url('alumeni'))->with('message', 'Section updated successfully!');
    }

    public function delete($id)
    {
        $model = new AlumniPageModel();
        $section = $model->find($id);

        if ($section && !empty($section['image']) && file_exists('uploads/' . $section['image'])) {
            unlink('uploads/' . $section['image']);
        }

        $model->delete($id);
        return redirect()->to(base_url('alumeni'))->with('message', 'Section deleted successfully!');
    }
    public function Admision_enquiri()
    {
        $model = new AdmissionModel();
        $data['hero'] =$model->first();
        return view('admin/admision_enquiri', $data);
    }

    public function save_HeroSection()
    {
        helper(['form', 'url']);
        $model = new AdmissionModel();

        $id = $this->request->getPost('id');
        $data = [
            'title' => $this->request->getPost('hero_title'),
            'subtitle' => $this->request->getPost('hero_subtitle'),
            'button_text' => $this->request->getPost('hero_button')
        ];

        $file = $this->request->getFile('hero_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/hero/', $newName);
            $data['image'] = $newName;
        }

        if ($id) {
            $model->update($id, $data);
            $msg = 'Hero section updated successfully.';
        } else {
            $model->insert($data);
            $msg = 'Hero section added successfully.';
        }

        return redirect()->to(base_url('admision_enquiri'))->with('success', $msg);
    }
}
