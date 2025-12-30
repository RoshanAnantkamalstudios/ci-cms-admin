<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\ServiceModel;

class ServiceController extends BaseController
{
    protected $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
    }

    public function index()
    {
        $type = $this->request->getGet('type');
        $query = $this->serviceModel->orderBy('created_at', 'DESC');
        if ($type) {
            $query->where('service_type', $type);
        }
        $services = $query->findAll();
        return view('admin/service/index', [
            'services' => $services,
            'selected_type' => $type
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');
        $serviceType = $this->request->getPost('service_type');
        $name = $this->request->getPost('name');

        $uploadBase = FCPATH . 'uploads/services';
        if (!is_dir($uploadBase)) {
            mkdir($uploadBase, 0777, true);
        }

        $sections = $this->request->getPost('service_section') ?? [];
        $builtSections = [];
        foreach ($sections as $i => $section) {
            $iconFile = $this->request->getFile('section_icon_' . $i);
            $iconName = null;
            if ($iconFile && $iconFile->isValid() && !$iconFile->hasMoved()) {
                $iconName = $iconFile->getRandomName();
                $iconFile->move($uploadBase, $iconName);
            }

            $images = [];
            $imageFiles = $this->request->getFileMultiple('section_images_' . $i);
            if ($imageFiles) {
                foreach ($imageFiles as $imgFile) {
                    if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
                        $newName = $imgFile->getRandomName();
                        $imgFile->move($uploadBase, $newName);
                        $images[] = $newName;
                    }
                }
            }

            $builtSections[] = [
                'title' => $section['title'] ?? '',
                'description' => $section['description'] ?? '',
                'icon' => $iconName,
                'images' => $images
            ];
        }

        $process = $this->request->getPost('process') ?? [];
        $builtProcess = [];
        foreach ($process as $i => $step) {
            $imgFile = $this->request->getFile('process_image_' . $i);
            $imgName = null;
            if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
                $imgName = $imgFile->getRandomName();
                $imgFile->move($uploadBase, $imgName);
            }
            $builtProcess[] = [
                'stepNo' => isset($step['stepNo']) ? (int) $step['stepNo'] : null,
                'title' => $step['title'] ?? '',
                'description' => $step['description'] ?? '',
                'image' => $imgName
            ];
        }

        $why = $this->request->getPost('why_choose_us') ?? [];
        $why = array_values(array_filter($why, fn($v) => trim((string)$v) !== ''));

        $data = [
            'service_type' => $serviceType,
            'name' => $name,
            'slug' => $name ? url_title($name, '-', true) : null,
            'service_section' => json_encode($builtSections),
            'process' => json_encode($builtProcess),
            'why_choose_us' => json_encode($why),
            'status' => 1
        ];

        if ($id) {
            $this->serviceModel->update($id, $data);
            $message = 'Service updated successfully';
        } else {
            $this->serviceModel->insert($data);
            $message = 'Service created successfully';
        }

        return redirect()->to(base_url('admin/services?type=' . ($serviceType ?: '')))->with('success', $message);
    }

    public function delete($id)
    {
        $svc = $this->serviceModel->find($id);
        if ($svc) {
            $sections = json_decode($svc['service_section'] ?? '[]', true) ?: [];
            foreach ($sections as $sec) {
                if (!empty($sec['icon']) && file_exists(FCPATH . 'uploads/services/' . $sec['icon'])) {
                    unlink(FCPATH . 'uploads/services/' . $sec['icon']);
                }
                foreach (($sec['images'] ?? []) as $img) {
                    $p = FCPATH . 'uploads/services/' . $img;
                    if ($img && file_exists($p)) {
                        unlink($p);
                    }
                }
            }
            $proc = json_decode($svc['process'] ?? '[]', true) ?: [];
            foreach ($proc as $step) {
                if (!empty($step['image']) && file_exists(FCPATH . 'uploads/services/' . $step['image'])) {
                    unlink(FCPATH . 'uploads/services/' . $step['image']);
                }
            }
            $this->serviceModel->delete($id);
        }
        return redirect()->back()->with('success', 'Service deleted successfully');
    }

    public function getServicesJson()
    {
        $rows = $this->serviceModel->orderBy('created_at', 'DESC')->findAll();
        return $this->response->setJSON([
            'status' => true,
            'data' => array_map(fn($r) => $this->mapService($r), $rows)
        ])->setStatusCode(200);
    }

    public function getServiceJson($id)
    {
        $svc = $this->serviceModel->find($id);
        if (!$svc) {
            return $this->response->setJSON(['status' => false, 'message' => 'Not found'])->setStatusCode(404);
        }
        return $this->response->setJSON(['status' => true, 'data' => $this->mapService($svc)])->setStatusCode(200);
    }

    public function getServicesByTypeJson($type)
    {
        $rows = $this->serviceModel->where('service_type', $type)->orderBy('created_at', 'DESC')->findAll();
        return $this->response->setJSON([
            'status' => true,
            'data' => array_map(fn($r) => $this->mapService($r), $rows)
        ])->setStatusCode(200);
    }

    private function mapService(array $r): array
    {
        $sections = json_decode($r['service_section'] ?? '[]', true) ?: [];
        $sections = array_map(function ($sec) {
            $urls = array_map(fn($img) => base_url('uploads/services/' . $img), $sec['images'] ?? []);
            return [
                'title' => $sec['title'] ?? '',
                'description' => $sec['description'] ?? '',
                'icon' => $sec['icon'] ?? null,
                'image_urls' => $urls
            ];
        }, $sections);

        $process = json_decode($r['process'] ?? '[]', true) ?: [];
        $process = array_map(function ($p) {
            return [
                'stepNo' => $p['stepNo'] ?? null,
                'title' => $p['title'] ?? '',
                'description' => $p['description'] ?? '',
                'image' => !empty($p['image']) ? base_url('uploads/services/' . $p['image']) : null
            ];
        }, $process);

        $why = json_decode($r['why_choose_us'] ?? '[]', true) ?: [];

        return [
            'id' => $r['id'],
            'service' => $r['service_type'],
            'name' => $r['name'],
            'slug' => $r['slug'],
            'service_section' => $sections,
            'process' => $process,
            'whyChooseUs' => $why
        ];
    }
}
