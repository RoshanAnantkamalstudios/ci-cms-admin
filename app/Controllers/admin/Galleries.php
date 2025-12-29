<?php

namespace App\Controllers\Admin;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\Home\GalleryModel;
use App\Models\Home\Home_model;

class Galleries extends BaseController
{
    public function _construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    protected $galleryModel;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
    }
    public function Index()
    {
        $data['gallery'] = $this->galleryModel->where('type', 'item')->findAll();
        $data['hero'] = $this->galleryModel->where('type', 'hero')->first();
        return view('admin/galleries', $data);
    }


    public function storeGallery()
    {
        $files = $this->request->getFiles();
        if ($files && isset($files['image']) && is_array($files['image'])) {
            foreach ($files['image'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads', $newName);
                    $this->galleryModel->save([
                        'image' => $newName,
                        'type' => 'item'
                    ]);
                }
            }
        }

        return redirect()->to(base_url('galleries'))->with('message', 'Gallery images added successfully.');
    }

    public function updateGallery($id)
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'btn_text' => $this->request->getPost('btn_text'),
            'btn_link' => $this->request->getPost('btn_link'),
        ];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);
            $data['image'] = $newName;
        }

        $this->galleryModel->update($id, $data);

        return redirect()->to(base_url('galleries'))->with('message', 'Gallery item updated successfully.');
    }

    public function deleteGallery($id)
    {
        $this->galleryModel->delete($id);
        return redirect()->to(base_url('galleries'))->with('message', 'Gallery item deleted successfully.');
    }

    public function updateGalleryHero()
    {
        $title = $this->request->getPost('hero_title');
        $subtitle = $this->request->getPost('hero_subtitle');
        $file = $this->request->getFile('banner_image');

        $data = [
            'hero_title' => $title,
            'hero_subtitle' => $subtitle,
            'type' => 'hero'
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);
            $data['banner_image'] = $newName;
        }

        $existing = $this->galleryModel->where('type', 'hero')->first();

        if ($existing) {
            $this->galleryModel->update($existing['id'], $data);
        } else {
            $this->galleryModel->save($data);
        }
        return redirect()->to(base_url('galleries'))->with('message', 'Hero section updated successfully.');
    }
}
