<?php

namespace App\Controllers\Admin;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\TP\MouModel;
use App\Models\TP\PlacedStudentsModel;
use App\Models\TP\TpoTeamModel;
use App\Models\TP\TpSectionModel;

class Training extends BaseController
{
    protected $mouModel;
    protected $tpoModel;
    protected $model;

    protected $aboutmodel;

    public function __construct()
    {
        $this->aboutmodel = new TpSectionModel();
        $this->mouModel = new MouModel();
        $this->tpoModel = new TpoTeamModel();
        $this->model = new PlacedStudentsModel();
    }
    public function about_tpo()
    {
        $data = [
            'hero'      => $this->aboutmodel->where('section_type', 'hero')->first(),
            'profile'   => $this->aboutmodel->where('section_type', 'profile')->first(),
            'about'     => $this->aboutmodel->where('section_type', 'about')->first(),
            'procedure' => $this->aboutmodel->where('section_type', 'procedure')->first(),
            'carousel'  => $this->aboutmodel->where('section_type', 'carousel')->findAll(),
        ];
        return view('admin/Training/about_tpo', $data);
    }

    public function saveAboutTpo()
    {
        $id = $this->request->getPost('id');
        $section_type = $this->request->getPost('section_type');
        $data = [
            'section_type' => $section_type,
            'title'        => $this->request->getPost('title'),
            'subtitle'     => $this->request->getPost('subtitle'),
            'button_text'  => $this->request->getPost('button_text'),
            'description'  => $this->request->getPost('description'),
            'extra'        => $this->request->getPost('extra'),
        ];

        // Upload
        $img = $this->request->getFile('image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move('uploads', $newName);
            $data['image'] = $newName;
        } else {
            $existing = $this->request->getPost('existing_image');
            if ($existing) $data['image'] = $existing;
        }

        if ($id) {
            $this->aboutmodel->update($id, $data);
        } else {
            $this->aboutmodel->insert($data);
        }

        return redirect()->to(base_url('about_tpo'))->with('success', 'Saved successfully!');
    }

    public function deleteAboutTpo($id)
    {
        $this->aboutmodel->delete($id);
        return redirect()->to(base_url('about_tpo'))->with('success', 'Deleted!');
    }


    public function tpo_team()
    {
        $data = [
            'hero'     => $this->tpoModel->where('section_type', 'hero')->first(),
            'members'  => $this->tpoModel->where('section_type', 'member')->findAll(),
            'carousel' => $this->tpoModel->where('section_type', 'carousel')->findAll(),
        ];
        $data['entries'] = $this->tpoModel->findAll();
        return view('admin/Training/tpo_team', $data);
    }

    public function saveTpoTeam()
    {
        $id = $this->request->getPost('id');
        $data = [
            'section_type' => $this->request->getPost('section_type'),
            'title'        => $this->request->getPost('title'),
            'subtitle'     => $this->request->getPost('subtitle'),
            'button_text'  => $this->request->getPost('button_text'),
            'name'         => $this->request->getPost('name'),
            'department'   => $this->request->getPost('department'),
            'designation'  => $this->request->getPost('designation'),
        ];

        // Handle Image
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads/', $filename);
            $data['image'] = $filename;
        }

        if ($id) {
            $this->tpoModel->update($id, $data);
        } else {
            $this->tpoModel->insert($data);
        }
        return redirect()->to(base_url('tpo_team'))->with('success', 'Saved successfully');
    }

    public function deleteTpoTeam($id)
    {
        $this->tpoModel->delete($id);
        return redirect()->to(base_url('tpo_team'))->with('success', 'Deleted successfully');
    }


    public function campus_placements()
    {

        $data = [
            'hero' => $this->model->where('section_type', 'hero')->first(),
            'students' => $this->model->where('section_type', 'student')->findAll(),
            'carousel' => $this->model->where('section_type', 'carousel')->findAll(),
        ];

        return view('admin/Training/campus_placements', $data);
    }

    public function saveCampusPlacement()
    {
        $file = $this->request->getFile('image');
        $imageName = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move('uploads', $imageName);
        }

        $this->model->save([
            'id' => $this->request->getPost('id'),
            'section_type' => $this->request->getPost('section_type'),
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'name' => $this->request->getPost('name'),
            'branch' => $this->request->getPost('branch'),
            'company' => $this->request->getPost('company'),
            'image' => $imageName ?: $this->request->getPost('existing_image'),
        ]);

        return redirect()->to(base_url('campus_placements'))->with('msg', 'Saved successfully!');
    }

    public function deleteCampusPlacement($id)
    {
        $entry = $this->model->find($id);
        if ($entry && $entry['image'] && file_exists('uploads/' . $entry['image'])) {
            unlink('uploads/' . $entry['image']);
        }

        $this->model->delete($id);
        return redirect()->to(base_url('campus_placements'))->with('msg', 'Deleted');
    }



    public function mous_()
    {
        $data = [
            'hero'     => $this->mouModel->where('section_type', 'hero')->first(),
            'mous'     => $this->mouModel->where('section_type', 'mou')->findAll(),
            'carousel' => $this->mouModel->where('section_type', 'carousel')->findAll(),
        ];
        return view('admin/Training/mous_', $data);
    }

    public function saveMous()
    {
        $id           = $this->request->getPost('id');
        $sectionType  = $this->request->getPost('section_type');

        $data = [
            'section_type' => $sectionType,
            'title'        => $this->request->getPost('title'),
            'subtitle'     => $this->request->getPost('subtitle'),
            'button_text'  => $this->request->getPost('button_text'),
            'extra'        => $this->request->getPost('extra'),
        ];

        // Handle file uploads
        if ($sectionType === 'hero') {
            $video = $this->request->getFile('content');
            if ($video && $video->isValid() && !$video->hasMoved()) {
                $videoName = $video->getRandomName();
                $video->move('uploads/mou/images', $videoName);
                $data['image'] = 'uploads/mou/images/' . $videoName;
            }
        }

        if ($sectionType === 'carousel') {
            $image = $this->request->getFile('image');
            if ($image && $image->isValid() && !$image->hasMoved()) {
                $imgName = $image->getRandomName();
                $image->move('uploads/mou/images', $imgName);
                $data['image'] = 'uploads/mou/images/' . $imgName;
            }
        }

        if ($id) {
            $this->mouModel->update($id, $data);
        } else {
            $this->mouModel->insert($data);
        }

        return redirect()->to(base_url('mous_'))->with('success', 'Saved successfully');
    }

    // Delete MOU, Hero, or Carousel item
    public function deleteMous($id)
    {
        $this->mouModel->delete($id);
        return redirect()->to(base_url('mous_'))->with('success', 'Deleted successfully');
    }
}
