<?php

namespace App\Controllers\Admin;

use App\Models\AddcarModel;
use App\Controllers\BaseController;
use App\Models\Facility\CafeteriaModel;
use App\Models\Facility\CulturalFiestaModel;
use App\Models\Facility\HostelFacilityModel;
use App\Models\Facility\LibraryFacilityModel;
use App\Models\Facility\SportsFacilityModel;
use App\Models\Facility\TransportationModel;

class Facilities extends BaseController
{
    public function Library()
    {
        $model = new LibraryFacilityModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['content'] = $model->where('section_type', 'content')->first();
        $data['images'] = $model->where('section_type', 'image')->findAll();
        return view('admin/facilities/library', $data);
    }

    public function saveLibrary()
    {
        $model = new LibraryFacilityModel();
        $section = $this->request->getPost('section_type');

        if ($section === 'hero') {
            $data = [
                'section_type' => 'hero',
                'title' => $this->request->getPost('title'),
                'subtitle' => $this->request->getPost('subtitle'),
                'button_text' => $this->request->getPost('button_text'),
            ];
            $file = $this->request->getFile('image');
            if ($file && $file->isValid()) {
                $newName = $file->getRandomName();
                $file->move('uploads/banner/', $newName);
                $data['image'] = $newName;
            }

            $id = $this->request->getPost('id');
            $id ? $model->update($id, $data) : $model->insert($data);
        } elseif ($section === 'content') {
            $data = [
                'section_type' => 'content',
                'description' => $this->request->getPost('description'),
            ];
            $id = $this->request->getPost('id');
            $id ? $model->update($id, $data) : $model->insert($data);
        } elseif ($section === 'image') {
            $files = $this->request->getFiles();
            foreach ($files['images'] as $file) {
                if ($file->isValid()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/library/', $newName);
                    $model->insert([
                        'section_type' => 'image',
                        'image' => $newName,
                    ]);
                }
            }
        }

        return redirect()->to(base_url('library_admin'))->with('message', 'Saved successfully.');
    }

    public function deleteImageLibrary($id)
    {
        $model = new LibraryFacilityModel();
        $data = $model->find($id);

        if ($data && $data['section_type'] === 'image') {
            @unlink('uploads/library/' . $data['image']);
            $model->delete($id);
        }

        return redirect()->to(base_url('library_admin'))->with('message', 'Image deleted.');
    }


    public function Hostel()
    {
        $model = new HostelFacilityModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['content'] = $model->where('section_type', 'content')->first();
        $data['images_girls'] = $model->where(['section_type' => 'image', 'group_type' => 'girls'])->findAll();
        $data['images_boys'] = $model->where(['section_type' => 'image', 'group_type' => 'boys'])->findAll();
        return view('admin/facilities/hostel', $data);
    }

    public function saveHostelFacility()
    {
        $model = new HostelFacilityModel();
        $section = $this->request->getPost('section_type');

        if ($section === 'hero') {
            $data = [
                'section_type' => 'hero',
                'title'        => $this->request->getPost('title'),
                'subtitle'     => $this->request->getPost('subtitle'),
                'button_text'  => $this->request->getPost('button_text'),
            ];
            $file = $this->request->getFile('image');
            if ($file && $file->isValid()) {
                $newName = $file->getRandomName();
                $file->move('uploads/banner/', $newName);
                $data['image'] = $newName;
            }

            $id = $this->request->getPost('id');
            $id ? $model->update($id, $data) : $model->insert($data);
        } elseif ($section === 'content') {
            $data = [
                'section_type' => 'content',
                'description' => $this->request->getPost('description')
            ];
            $id = $this->request->getPost('id');
            $id ? $model->update($id, $data) : $model->insert($data);
        } elseif ($section === 'image') {
            $files = $this->request->getFiles();
            $types = $this->request->getPost('group_type');

            foreach ($files['images'] as $index => $file) {
                if ($file->isValid()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/hostel/', $newName);
                    $model->insert([
                        'section_type' => 'image',
                        'image'        => $newName,
                        'group_type'   => $types[$index] ?? '',
                    ]);
                }
            }
        }

        return redirect()->to(base_url('hostel_admin'))->with('message', 'Saved successfully.');
    }

    public function deleteHostelImage($id)
    {
        $model = new HostelFacilityModel();
        $row = $model->find($id);
        if ($row && $row['section_type'] === 'image') {
            @unlink('uploads/hostel/' . $row['image']);
            $model->delete($id);
        }
        return redirect()->to(base_url('hostel_admin'))->with('message', 'Image deleted.');
    }


    public function Sports()
    {
        $model = new SportsFacilityModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['content'] = $model->where('section_type', 'content')->first();
        $data['images'] = $model->where('section_type', 'image')->findAll();

        return view('admin/facilities/sports', $data);
    }

    public function saveSports()
    {
        $model = new SportsFacilityModel();
        $section = $this->request->getPost('section_type');

        if ($section === 'hero') {
            $data = [
                'section_type' => 'hero',
                'title'        => $this->request->getPost('title'),
                'subtitle'     => $this->request->getPost('subtitle'),
                'button_text'  => $this->request->getPost('button_text'),
            ];
            $file = $this->request->getFile('image');
            if ($file && $file->isValid()) {
                $newName = $file->getRandomName();
                $file->move('uploads/banner/', $newName);
                $data['image'] = $newName;
            }
            $id = $this->request->getPost('id');
            $id ? $model->update($id, $data) : $model->insert($data);
        } elseif ($section === 'content') {
            $data = [
                'section_type' => 'content',
                'description'  => $this->request->getPost('description'),
            ];
            $id = $this->request->getPost('id');
            $id ? $model->update($id, $data) : $model->insert($data);
        } elseif ($section === 'image') {
            $files = $this->request->getFiles();
            foreach ($files['images'] as $file) {
                if ($file->isValid()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/sports/', $newName);
                    $model->insert([
                        'section_type' => 'image',
                        'image'        => $newName,
                    ]);
                }
            }
        }

        return redirect()->to(base_url('sports_admin'))->with('message', 'Saved successfully.');
    }

    public function deleteImageSports($id)
    {
        $model = new SportsFacilityModel();
        $row = $model->find($id);
        if ($row && $row['section_type'] === 'image') {
            @unlink('uploads/sports/' . $row['image']);
            $model->delete($id);
        }
        return redirect()->to(base_url('sports_admin'))->with('message', 'Image deleted.');
    }


    public function Cafeteria()
    {
        $model = new CafeteriaModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['about'] = $model->where('section_type', 'about')->first();
        $data['images'] = $model->where('section_type', 'image')->findAll();
        return view('admin/facilities/cafeteria', $data);
    }

    public function saveCafeteria()
    {
        $model = new CafeteriaModel();
        $section = $this->request->getPost('section_type');

        if ($section === 'hero') {
            $id = $this->request->getPost('id');
            $data = [
                'section_type' => 'hero',
                'title'        => $this->request->getPost('title'),
                'subtitle'     => $this->request->getPost('subtitle'),
                'button_text'  => $this->request->getPost('button_text'),
            ];

            $file = $this->request->getFile('image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/banner/', $newName);
                $data['image'] = $newName;
            }

            if (!empty($id)) {
                $model->update($id, $data);
            } else {
                $model->insert($data);
            }
        } elseif ($section === 'image') {
            $files = $this->request->getFiles();
            $descriptions = $this->request->getPost('descriptions');

            if (!empty($files['images'])) {
                foreach ($files['images'] as $index => $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move('uploads/cafeteria/', $newName);
                        $model->insert([
                            'section_type' => 'image',
                            'image'        => $newName,
                            'description'  => $descriptions[$index] ?? '',
                        ]);
                    }
                }
            }
        } elseif ($section === 'about') {
            $id = $this->request->getPost('id');
            $data = [
                'section_type' => 'about',
                'title'        => $this->request->getPost('title'),
                'description'  => $this->request->getPost('description'),
            ];

            if (!empty($id)) {
                $model->update($id, $data);
            } else {
                $model->insert($data);
            }
        }

        return redirect()->to(base_url('cafeteria_admin'))->with('success', 'Saved successfully.');
    }

    public function deleteCafeteria($id)
    {
        $model = new CafeteriaModel();
        $entry = $model->find($id);

        if ($entry) {
            if (!empty($entry['image'])) {
                $folder = $entry['section_type'] === 'hero' ? 'banner' : 'cafeteria';
                $path = FCPATH . 'uploads/' . $folder . '/' . $entry['image'];
                if (file_exists($path)) {
                    @unlink($path);
                }
            }

            $model->delete($id);
        }

        return redirect()->to(base_url('cafeteria_admin'))->with('success', 'Deleted successfully.');
    }


    public function Transport()
    {
        $model = new TransportationModel();
        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['content'] = $model->where('section_type', 'content')->first();
        $data['images'] = $model->where('section_type', 'image')->findAll();
        return view('admin/facilities/transport', $data);
    }

    public function saveTransport()
    {
        $model = new TransportationModel();
        $section = $this->request->getPost('section_type');

        if ($section === 'hero') {
            $data = [
                'section_type' => 'hero',
                'title'        => $this->request->getPost('title'),
                'subtitle'     => $this->request->getPost('subtitle'),
                'button_text'  => $this->request->getPost('button_text'),
            ];
            $file = $this->request->getFile('image');
            if ($file && $file->isValid()) {
                $newName = $file->getRandomName();
                $file->move('uploads/banner/', $newName);
                $data['image'] = $newName;
            }
            $id = $this->request->getPost('id');
            $id ? $model->update($id, $data) : $model->insert($data);
        } elseif ($section === 'content') {
            $data = [
                'section_type' => 'content',
                'description'  => $this->request->getPost('description')
            ];
            $id = $this->request->getPost('id');
            $id ? $model->update($id, $data) : $model->insert($data);
        } elseif ($section === 'image') {
            $files = $this->request->getFiles();
            foreach ($files['images'] as $file) {
                if ($file->isValid()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/transport/', $newName);
                    $model->insert([
                        'section_type' => 'image',
                        'image'        => $newName
                    ]);
                }
            }
        }

        return redirect()->to(base_url('transport_admin'))->with('message', 'Saved successfully.');
    }

    public function deleteImageTransport($id)
    {
        $model = new TransportationModel();
        $row = $model->find($id);
        if ($row && $row['section_type'] === 'image') {
            @unlink('uploads/transport/' . $row['image']);
            $model->delete($id);
        }
        return redirect()->to(base_url('transport_admin'))->with('message', 'Image deleted.');
    }


    public function Cultural_fiesta()
    {
        $model = new CulturalFiestaModel();

        $data['hero'] = $model->where('section_type', 'hero')->first();
        $data['about'] = $model->where('section_type', 'about')->first();
        $data['images'] = $model->where('section_type', 'image')->findAll();
        return view('admin/facilities/cultural_fiesta',$data);
    }

    public function saveCulturalFiesta()
    {
        $model = new CulturalFiestaModel();
        $section = $this->request->getPost('section_type');

        if ($section == 'hero') {
            $data = [
                'section_type' => 'hero',
                'title' => $this->request->getPost('title'),
                'subtitle' => $this->request->getPost('subtitle'),
                'button_text' => $this->request->getPost('button_text'),
            ];
            $file = $this->request->getFile('image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/fiesta/', $newName);
                $data['image'] = $newName;
            }

            $existing = $model->where('section_type', 'hero')->first();
            if ($existing) $model->update($existing['id'], $data);
            else $model->insert($data);
        } elseif ($section == 'about') {
            $data = [
                'section_type' => 'about',
                'description' => $this->request->getPost('description'),
            ];
            $existing = $model->where('section_type', 'about')->first();
            if ($existing) $model->update($existing['id'], $data);
            else $model->insert($data);
        } elseif ($section == 'image') {
            $files = $this->request->getFiles();
            $descriptions = $this->request->getPost('descriptions');

            if (!empty($files['images'])) {
                foreach ($files['images'] as $index => $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move('uploads/fiesta/', $newName);
                        $model->insert([
                            'section_type' => 'image',
                            'image' => $newName,
                            'description' => $descriptions[$index] ?? '',
                        ]);
                    }
                }
            }
        }

        return redirect()->to(base_url('cultural_fiesta_admin'))->with('message', 'Saved Successfully');
    }

    public function deleteCulturalFiesta($id)
    {
        $model = new CulturalFiestaModel();
        $entry = $model->find($id);
        if ($entry && $entry['image']) {
            @unlink('uploads/fiesta/' . $entry['image']);
        }
        $model->delete($id);

        return redirect()->to(base_url('cultural_fiesta_admin'))->with('message', 'Deleted');
    }
}
