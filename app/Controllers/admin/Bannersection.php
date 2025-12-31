<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;

class Bannersection extends BaseController
{
    protected $bannersection;

    public function __construct()
    {
        $this->bannersection = new BannerModel();
    }

    public function index()
    {
        return view('admin/bannersection');
    }

    // DataTable fetch
    // public function fetch()
    // {
    //     $rows = $this->bannersection->findAll();
    //     $data = [];

    //     foreach ($rows as $row) {
    //         $data[] = [
    //             $row['page_key'],
    //             $row['title'],
    //             '<img src="'.base_url('uploads/cms/'.$row['banner_image']).'" height="40">',
    //             '
    //             <button class="btn btn-sm btn-primary edit" data-id="'.$row['id'].'">Edit</button>
    //             <button class="btn btn-sm btn-danger delete" data-id="'.$row['id'].'">Delete</button>
    //             '
    //         ];
    //     }

    //     return $this->response->setJSON(['data' => $data]);
    // }

    public function fetch()
{
    $rows = $this->bannersection->findAll();
    $data = [];

    foreach ($rows as $row) {
        $data[] = [
            esc($row['page_key']),
            esc($row['title']),
            '<img src="'.base_url('uploads/cms/'.$row['banner_image']).'" height="40">',

            // ACTIONS (Font Awesome)
            '
            <button class="btn btn-sm btn-warning edit"
                    data-id="'.$row['id'].'"
                    title="Edit">
                <i class="fa fa-pen"></i>
            </button>

            <button class="btn btn-sm btn-danger delete"
                    data-id="'.$row['id'].'"
                    title="Delete">
                <i class="fa fa-trash"></i>
            </button>
            '
        ];
    }

    return $this->response->setJSON(['data' => $data]);
}


    // Add / Edit
    public function save()
    {
        $id = $this->request->getPost('id');
        $image = $this->request->getPost('old_image');

        $file = $this->request->getFile('banner_image');
        if ($file && $file->isValid()) {
            $image = $file->getRandomName();
            $file->move('uploads/cms', $image);
        }

        $data = [
            'page_key' => $this->request->getPost('page_key'),
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'banner_image' => $image,
            'status' => 1
        ];

        if ($id) {
            $this->bannersection->update($id, $data);
        } else {
            $this->bannersection->insert($data);
        }

        return $this->response->setJSON(['status' => true]);
    }

    public function edit($id)
    {
        return $this->response->setJSON($this->bannersection->find($id));
    }

    public function delete($id)
    {
        $this->bannersection->delete($id);
        return $this->response->setJSON(['status' => true]);
    }

    //get data 

     public function banner_data()
    {
        $data = $this->bannersection
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'total'  => count($data),
            'data'   => $data
        ]);
    }
}
