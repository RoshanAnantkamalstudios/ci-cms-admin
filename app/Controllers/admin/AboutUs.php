<?php

namespace App\Controllers\Admin;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\AboutUs\BoardGovernanceModel;
use App\Models\AboutUs\BoardPageModel;
use App\Models\AboutUs\PresidentDeskModel;
use App\Models\AboutUs\PrincipalDeskModel;
use App\Models\AboutUs\VisionMissionModel;

class AboutUs extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function boardmember()
    {
        $model = new BoardPageModel();
        $hero = $model->where('type', 'hero')->first();
        $members = $model->where('type', 'member')->findAll();

        return view('admin/aboutus/boardmember', [
            'hero' => $hero,
            'members' => $members
        ]);
    }

    public function saveHeroBoardMember()
    {
        $model = new BoardPageModel();
        $data = [
            'type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
        ];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/hero', $newName);
            $data['image'] = 'uploads/hero/' . $newName;
        }

        // Update if already exists
        $existing = $model->where('type', 'hero')->first();
        if ($existing) {
            $model->update($existing['id'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('boardmember'))->with('message', 'Hero section saved successfully.');
    }

    public function saveBoardMember()
    {
        $model = new BoardPageModel();
        $id = $this->request->getPost('id');

        $data = [
            'type' => 'member',
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'role' => $this->request->getPost('role'),
            'message' => $this->request->getPost('message'),
        ];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/members', $newName);
            $data['image'] = 'uploads/members/' . $newName;
        }

        if (!empty($id)) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('boardmember'))->with('message', 'Member saved successfully.');
    }

    public function deleteBoardMember($id)
    {
        $model = new BoardPageModel();
        $model->delete($id);
        return redirect()->to(base_url('boardmember'))->with('message', 'Member deleted successfully.');
    }




    public function president_desk()
    {
        $model = new PresidentDeskModel();
        $data['data'] = $model->first();
        return view('admin/aboutus/president_desk', $data);
    }

    public function save_board_page()
    {
        $model = new PresidentDeskModel();
        $data = [];

        // Upload hero background image
        $heroImage = $this->request->getFile('hero_image');
        if ($heroImage && $heroImage->isValid() && !$heroImage->hasMoved()) {
            $heroImageName = $heroImage->getRandomName();
            $heroImage->move('uploads/president/', $heroImageName);
            $data['hero_image'] = 'uploads/president/' . $heroImageName;
        }

        // Upload president image
        $presidentImage = $this->request->getFile('image');
        if ($presidentImage && $presidentImage->isValid() && !$presidentImage->hasMoved()) {
            $presidentImageName = $presidentImage->getRandomName();
            $presidentImage->move('uploads/president/', $presidentImageName);
            $data['president_image'] = 'uploads/president/' . $presidentImageName;
        }

        // Get form data
        $data['hero_title'] = $this->request->getPost('hero_title');
        $data['hero_subtitle'] = $this->request->getPost('hero_subtitle');
        $data['overview'] = $this->request->getPost('overview');
        $data['president_name'] = $this->request->getPost('president_name');
        $data['designation'] = $this->request->getPost('designation');
        $data['address'] = $this->request->getPost('address');
        $data['mobile_no'] = $this->request->getPost('mobile_no');

        // Check if a record exists
        $existing = $model->first();

        if ($existing) {
            // Update
            $model->update($existing['id'], $data);
            return redirect()->to(base_url('president_desk'))->with('message', 'President Desk Page updated successfully.');
        } else {
            // Insert
            $model->insert($data);
            return redirect()->to(base_url('president_desk'))->with('message', 'President Desk Page created successfully.');
        }
    }




    public function principal_desk()
    {
        $model = new PrincipalDeskModel();
        $data['data'] = $model->first();
        // print_r($data);die;
        return view('admin/aboutus/principal_desk', $data);
    }

    public function save_principal_desk()
    {
        $model = new PrincipalDeskModel();
        $data = [];

        // Upload hero image
        $heroImage = $this->request->getFile('hero_image');
        if ($heroImage && $heroImage->isValid() && !$heroImage->hasMoved()) {
            $heroImageName = $heroImage->getRandomName();
            $heroImage->move('uploads/principal/', $heroImageName);
            $data['hero_image'] = 'uploads/principal/' . $heroImageName;
        }

        // Upload principal image
        $principalImage = $this->request->getFile('principal_image');
        if ($principalImage && $principalImage->isValid() && !$principalImage->hasMoved()) {
            $principalImageName = $principalImage->getRandomName();
            $principalImage->move('uploads/principal/', $principalImageName);
            $data['principal_image'] = 'uploads/principal/' . $principalImageName;
        }

        // Form data
        $data['hero_title'] = $this->request->getPost('hero_title');
        $data['hero_subtitle'] = $this->request->getPost('hero_subtitle');
        $data['message'] = $this->request->getPost('message');
        $data['principal_name'] = $this->request->getPost('principal_name');
        $data['designation'] = $this->request->getPost('designation');
        $data['address'] = $this->request->getPost('address');
        $data['mobile_no'] = $this->request->getPost('mobile_no');

        $existing = $model->first();
        if ($existing) {
            $model->update($existing['id'], $data);
            return redirect()->to(base_url('principal_desk'))->with('message', 'Principal Desk updated successfully.');
        } else {
            $model->insert($data);
            return redirect()->to(base_url('principal_desk'))->with('message', 'Principal Desk created successfully.');
        }
    }



    public function governing_body()
    {
        $model = new BoardGovernanceModel();

        $hero = $model->where('type', 'hero')->first();
        $members = $model->where('type', 'member')->orderBy('display_order', 'ASC')->findAll();
        return view('admin/aboutus/governing_body', compact('hero', 'members'));
    }

    public function save_herogoverning_body()
    {
        $model = new BoardGovernanceModel();
        $existing = $model->where('type', 'hero')->first();

        $data = [
            'type' => 'hero',
            'hero_title' => $this->request->getPost('hero_title'),
            'hero_subtitle' => $this->request->getPost('hero_subtitle'),
        ];

        $file = $this->request->getFile('hero_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/board/', $newName);
            $data['hero_image'] = 'uploads/board/' . $newName;
        } else {
            $data['hero_image'] = $existing['hero_image'] ?? '';
        }

        if ($existing) {
            $model->update($existing['id'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(base_url('governing_body'))->with('success', 'Hero section saved');
    }

    public function save_membergoverning_body()
    {
        $model = new BoardGovernanceModel();

        $data = [
            'type' => 'member',
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'background' => $this->request->getPost('background'),
            'display_order' => $this->request->getPost('display_order') ?? 0
        ];

        $data['photo'] = null;
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/board/', $newName);
            $data['photo'] = 'uploads/board/' . $newName;
        }


        $model->insert($data);
        return redirect()->to(base_url('governing_body'))->with('success', 'Member added');
    }
    public function update_member($id)
    {
        $model = new BoardGovernanceModel();
        $member = $model->find($id);

        $data = [
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'background' => $this->request->getPost('background'),
            'display_order' => $this->request->getPost('display_order'),
        ];

        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/board/', $newName);
            $data['photo'] = 'uploads/board/' . $newName;
        }

        $model->update($id, $data);
        return redirect()->to(base_url('governing_body'))->with('message', 'Member updated successfully');
    }


    public function delete_member($id)
    {
        $model = new BoardGovernanceModel();
        $model->delete($id);
        return redirect()->to(base_url('governing_body'))->with('success', 'Member deleted');
    }

    public function vision_mission()
    {
        $model = new VisionMissionModel();
        $data['vm'] = $model->first();
        return view('admin/aboutus/vision_mission', $data);
    }
    public function save_vision_mssion()
    {
        $model = new VisionMissionModel();

        $data = $this->request->getPost([
            'hero_heading',
            'hero_subheading',
            'hero_button_text',
            'hero_button_link',
            'section_heading',
            'section_subheading',
            'belief_title',
            'belief_description',
            'belief_icon',
            'vision_title',
            'vision_description',
            'vision_icon',
            'mission_title',
            'mission_description',
            'mission_icon'
        ]);

        $existing = $model->first();

        // Handle file upload
        $file = $this->request->getFile('hero_banner_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('public/uploads/', $newName);
            $data['hero_banner_image'] = $newName;

            // Delete old banner image
            if ($existing && !empty($existing['hero_banner_image'])) {
                @unlink(FCPATH . 'public/uploads/' . $existing['hero_banner_image']);
            }
        }

        if ($existing) {
            $model->update($existing['id'], $data);
            $msg = 'Vision & Mission updated successfully.';
        } else {
            $model->insert($data);
            $msg = 'Vision & Mission added successfully.';
        }

        return redirect()->to(base_url('vision_mission'))->with('success', $msg);
    }
}
