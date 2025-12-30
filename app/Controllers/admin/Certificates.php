<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CertificateModel;

class Certificates extends BaseController
{
    protected $certModel;

    public function __construct()
    {
        $this->certModel = new CertificateModel();
    }

    public function index()
    {
        $data['record'] = $this->certModel->first();
        return view('admin/certificates', $data);
    }

   public function saveCertificates()
{
    $uploadPath = FCPATH . 'uploads/certificates/';
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    // 🔹 ICON
    $iconName = $this->request->getPost('existing_icon');
    $icon = $this->request->getFile('icon');
    if ($icon && $icon->isValid()) {
        $iconName = $icon->getRandomName();
        $icon->move($uploadPath, $iconName);
    }

    // 🔹 ITEMS (THIS IS THE FIX)
    $finalItems = [];
    $postedItems = $this->request->getPost('items');

    if ($postedItems) {
        foreach ($postedItems as $i => $item) {

            // keep old file if no new upload
            $fileName = $item['existing_file'] ?? null;
            $file = $this->request->getFile("items.$i.file");

            if ($file && $file->isValid()) {
                $fileName = $file->getRandomName();
                $file->move($uploadPath, $fileName);
            }

            // ❗ skip empty rows
            if (empty($item['title']) && empty($fileName)) {
                continue;
            }

            $finalItems[] = [
                'title' => $item['title'],
                'file'  => $fileName
            ];
        }
    }

    $data = [
        'icon'        => $iconName,
        // 'short_title' => $this->request->getPost('short_title'),
        'heading'     => $this->request->getPost('heading'),
        'description' => $this->request->getPost('description'),
        'items'       => json_encode($finalItems)
    ];

    // 🔹 SINGLE ROW LOGIC
    $existing = $this->certModel->first();
    if ($existing) {
        $this->certModel->update($existing['id'], $data);
    } else {
        $this->certModel->insert($data);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Certificates updated successfully'
    ]);
}

    public function getcertificatedata()
    {
          $certModel = new CertificateModel();
        $record = $certModel->first();

        if (!$record) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'No certificate data found',
                'data' => null
            ]);
        }

        // Decode items JSON
        $items = [];
        if (!empty($record['items'])) {
            $items = json_decode($record['items'], true);

            // Add full URL to files
            foreach ($items as &$item) {
                if (!empty($item['file'])) {
                    $item['file_url'] = base_url('uploads/certificates/' . $item['file']);
                } else {
                    $item['file_url'] = null;
                }
            }
        }

        $data = [
            'id'           => (int) $record['id'],
            'icon'         => $record['icon']
                                ? base_url('uploads/certificates/' . $record['icon'])
                                : null,
            // 'short_title'  => $record['short_title'],
            'heading'      => $record['heading'],
            'description'  => $record['description'],
            'items'        => $items
        ];

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Certificates data fetched successfully',
            'data' => $data
        ]);
    }

}
