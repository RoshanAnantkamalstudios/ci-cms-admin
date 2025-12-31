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

    // Load page
    public function index()
    {
        return view('admin/bannersection');
    }

    // 🔹 DataTable fetch (ONLY ACTIVE RECORDS)
    public function fetch()
    {
        $rows = $this->bannersection
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->findAll();

        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                esc($row['page_key']),
                esc($row['title']),
                '<img src="' . base_url('uploads/cms/' . $row['banner_image']) . '" height="40">',

                // Actions
                '
                <button class="btn btn-sm btn-warning edit"
                        data-id="' . $row['id'] . '" title="Edit">
                    <i class="fa fa-pen"></i>
                </button>

                <button class="btn btn-sm btn-danger delete"
                        data-id="' . $row['id'] . '" title="Delete">
                    <i class="fa fa-trash"></i>
                </button>
                '
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    // 🔹 Add / Update banner
    public function save()
    {
        $id    = $this->request->getPost('id');
        $image = $this->request->getPost('old_image');

        $file = $this->request->getFile('banner_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $image = $file->getRandomName();
            $file->move('uploads/cms', $image);
        }

        $data = [
            'page_key'     => $this->request->getPost('page_key'),
            'title'        => $this->request->getPost('title'),
            'subtitle'     => $this->request->getPost('subtitle'),
            'banner_image' => $image,
            'status'       => 1
        ];

        if ($id) {
            $this->bannersection->update($id, $data);
        } else {
            $this->bannersection->insert($data);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Banner saved successfully'
        ]);
    }

    // 🔹 Edit banner (ONLY IF ACTIVE)
    public function edit($id)
    {
        $data = $this->bannersection
            ->where('id', $id)
            ->where('status', 1)
            ->first();

        if (!$data) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Banner not found'
            ]);
        }

        return $this->response->setJSON($data);
    }

    // 🔹 SOFT DELETE
    public function delete($id)
    {
        $this->bannersection->update($id, [
            'status' => 0
        ]);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Banner deleted successfully'
        ]);
    }

    // 🔹 Frontend API (ONLY ACTIVE BANNERS)
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

    // 🔹 OPTIONAL: Restore deleted banner
    public function restore($id)
    {
        $this->bannersection->update($id, [
            'status' => 1
        ]);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Banner restored successfully'
        ]);
    }
}
