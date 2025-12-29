<?php

namespace App\Controllers\Admin;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\ContactModel;
use App\Models\Home\Home_model;

class Contactus extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    protected $contactModel;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
    }

    public function Index()
    {
        $data['hero'] = $this->contactModel->where('type', 'hero')->first();
        $data['communication'] = $this->contactModel->whereIn('type', ['central_office', 'campus_address', 'accessibility'])->findAll();
        return view('admin/contact_us', $data);
    }

    public function saveHero()
    {
        $data = [
            'type' => 'hero',
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
        ];

        $image = $this->request->getFile('banner_image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('uploads', $newName);
            $data['banner_image'] = $newName;
        }

        $existing = $this->contactModel->where('type', 'hero')->first();
        if ($existing) {
            $this->contactModel->update($existing['id'], $data);
        } else {
            $this->contactModel->save($data);
        }

        return redirect()->to(base_url('contact_us'))->with('message', 'Hero section saved.');
    }

    public function saveCommunication()
    {
        $types = ['central_office', 'campus_address', 'accessibility'];
        foreach ($types as $type) {
            $data = [
                'type' => $type,
                'title' => $this->request->getPost($type . '_title'),
                'description' => $this->request->getPost($type . '_description'),
                'extra' => $this->request->getPost($type . '_extra'),
            ];

            $existing = $this->contactModel->where('type', $type)->first();
            if ($existing) {
                $this->contactModel->update($existing['id'], $data);
            } else {
                $this->contactModel->save($data);
            }
        }

        return redirect()->to(base_url('contact_us'))->with('message', 'Communication details updated.');
    }
}
