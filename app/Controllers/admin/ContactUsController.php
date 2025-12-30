<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactUsModel;

class ContactUsController extends BaseController
{
    protected $contactUsModel;

    public function __construct()
    {
        $this->contactUsModel = new ContactUsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Contact Us',
            'contact' => $this->contactUsModel->first()
        ];
        return view('admin/contact_us/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');
        $data = $this->request->getPost();

        // Handle arrays and JSON encoding
        $data['phone_numbers'] = json_encode(array_filter($data['phone_numbers'] ?? [])); // Remove empty strings
        $data['emails'] = json_encode(array_filter($data['emails'] ?? [])); // Remove empty strings
        
        // Handle branches
        $branches = [];
        if (isset($data['branch_name'])) {
            $count = count($data['branch_name']);
            for ($i = 0; $i < $count; $i++) {
                if (!empty($data['branch_name'][$i])) {
                    $branches[] = [
                        'branch_name' => $data['branch_name'][$i],
                        'branch_location' => $data['branch_location'][$i] ?? '',
                        'branch_address' => $data['branch_address'][$i] ?? '',
                    ];
                }
            }
        }
        $data['branches'] = json_encode($branches);

        // Handle Branch Image
        $file = $this->request->getFile('branch_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'public/uploads/contact_us', $newName);
            $data['branch_image'] = 'public/uploads/contact_us/' . $newName;
        } else {
            // Keep existing image if not uploading new one
             if (empty($id)) {
                 $data['branch_image'] = ''; 
             } else {
                 // Remove it from data so it doesn't overwrite with null if not provided
                 unset($data['branch_image']);
             }
        }
        
        // Unset raw array fields to avoid database errors
        unset($data['branch_name']);
        unset($data['branch_location']);
        unset($data['branch_address']);

        if ($id) {
            $this->contactUsModel->update($id, $data);
        } else {
            $this->contactUsModel->insert($data);
        }

        return redirect()->to(base_url('admin/contact_us'))->with('success', 'Contact Us saved successfully');
    }

    public function getContactUsJson()
    {
        $contact = $this->contactUsModel->first();
        if ($contact) {
            $contact['phone_numbers'] = json_decode($contact['phone_numbers'], true);
            $contact['emails'] = json_decode($contact['emails'], true);
            $contact['branches'] = json_decode($contact['branches'], true);
            
            // Normalize image URL
            if (!empty($contact['branch_image'])) {
                $contact['branch_image_url'] = base_url($contact['branch_image']);
            }

            return $this->response->setJSON(['status' => true, 'data' => $contact]);
        }
        return $this->response->setJSON(['status' => false, 'message' => 'Contact Us data not found']);
    }
}
