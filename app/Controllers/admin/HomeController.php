<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Home\AboutCompanyModel;
use App\Models\Home\TestimonialModel;
use App\Models\Home\YoutubeModel;

class HomeController extends BaseController
{
    protected $aboutModel;
    protected $testimonialModel;
    protected $youtubeModel;
    protected $db;

    public function __construct()
    {
        $this->aboutModel = new AboutCompanyModel();
        $this->testimonialModel = new TestimonialModel();
        $this->youtubeModel = new YoutubeModel();
        $this->db = \Config\Database::connect();
    }

    public function aboutOurCompany()
    { 
        $data['record'] = $this->aboutModel->orderBy('id', 'DESC')->first();
        
        if ($data['record']) {
            $data['record']['about_sections'] = json_decode($data['record']['about_sections'], true) ?? [];
        }
        
        return view('admin/home/aboutOurCompany', $data);
    } 
    public function aboutCompanyJson()
    {
        $record = $this->aboutModel->orderBy('id', 'DESC')->first();
        if (!$record) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Not found'
            ])->setStatusCode(404);
        }
        
        $sections = json_decode($record['about_sections'], true) ?? [];
        $iconValue = $record['icon'] ?? null;
        $isFA = is_string($iconValue) && strpos($iconValue, 'fa-') !== false;
        $iconUrl = $isFA ? null : ($iconValue ? base_url('uploads/about/' . $iconValue) : null);
        $iconClass = $isFA ? $iconValue : null;
        
        $normalizedSections = [];
        foreach ($sections as $section) {
            $secIcon = $section['icon'] ?? null;
            $secIsFA = is_string($secIcon) && strpos($secIcon, 'fa-') !== false;
            $normalizedSections[] = [
                'title' => $section['title'] ?? '',
                'description' => $section['description'] ?? '',
                'icon_url' => $secIsFA ? null : ($secIcon ? base_url('uploads/about/' . $secIcon) : null),
                'icon_class' => $secIsFA ? $secIcon : null
            ];
        }
        
        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'id' => $record['id'],
                'short_title' => $record['short_title'],
                'heading' => $record['heading'],
                'description' => $record['description'],
                'icon_url' => $iconUrl,
                'icon_class' => $iconClass,
                'about_sections' => $normalizedSections
            ]
        ])->setStatusCode(200);
    }
    public function saveAboutCompany()
    {
        $existingRecord = $this->aboutModel->orderBy('id', 'DESC')->first();

        $iconFile = $this->request->getFile('icon');
        $iconClass = trim($this->request->getPost('icon_class') ?? '');

        $validationRules = [
            'icon' => [
                'rules' => 'permit_empty|max_size[icon,2048]|ext_in[icon,svg,png]',
            ],
            'icon_class' => 'permit_empty|max_length[255]',
            'short_title' => 'required|max_length[255]',
            'heading' => 'required',
            'description' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        if (!$existingRecord) {
            $hasValidFile = $iconFile && $iconFile->isValid() && !$iconFile->hasMoved();
            if (!$hasValidFile && $iconClass === '') {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Either upload an icon file or enter a Font Awesome class',
                ])->setStatusCode(400);
            }
        }

        try {
            $uploadPath = FCPATH . 'uploads/about';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $iconName = $existingRecord['icon'] ?? null;

            if ($iconFile && $iconFile->isValid() && !$iconFile->hasMoved()) {
                if ($iconName && file_exists($uploadPath . '/' . $iconName)) {
                    unlink($uploadPath . '/' . $iconName);
                }
                $iconName = $iconFile->getRandomName();
                $iconFile->move($uploadPath, $iconName);
            } elseif ($iconClass !== '') {
                $iconName = $iconClass;
            }

            $aboutSections = [];
            $aboutIcons = $this->request->getFileMultiple('about_icon');
            $aboutTitles = $this->request->getPost('about_title');
            $aboutDescriptions = $this->request->getPost('about_description');
            $existingIconNames = $this->request->getPost('existing_section_icon') ?? [];

            if ($aboutTitles && $aboutDescriptions) {
                foreach ($aboutTitles as $index => $title) {
                    $aboutIconName = $existingIconNames[$index] ?? null;
                    
                    if (isset($aboutIcons[$index]) && $aboutIcons[$index]->isValid() && !$aboutIcons[$index]->hasMoved()) {
                        if ($aboutIconName && file_exists($uploadPath . '/' . $aboutIconName)) {
                            unlink($uploadPath . '/' . $aboutIconName);
                        }
                        $aboutIconName = $aboutIcons[$index]->getRandomName();
                        $aboutIcons[$index]->move($uploadPath, $aboutIconName);
                    }

                    $aboutSections[] = [
                        'icon' => $aboutIconName,
                        'title' => $title,
                        'description' => $aboutDescriptions[$index] ?? ''
                    ];
                }
            }

            $data = [
                'icon' => $iconName,
                'short_title' => $this->request->getPost('short_title'),
                'heading' => $this->request->getPost('heading'),
                'description' => $this->request->getPost('description'),
                'about_sections' => json_encode($aboutSections)
            ];

            if ($existingRecord) {
                $this->aboutModel->update($existingRecord['id'], $data);
                $id = $existingRecord['id'];
                $message = 'Updated successfully';
            } else {
                $id = $this->aboutModel->insert($data);
                $message = 'Created successfully';
            }

            $isClass = is_string($iconName) && strpos($iconName, 'fa-') !== false;

            return $this->response->setJSON([
                'status' => 'success',
                'message' => $message,
                'data' => [
                    'id' => $id,
                    'icon' => $isClass ? null : ($iconName ? base_url('uploads/about/' . $iconName) : null),
                    'icon_class' => $isClass ? $iconName : null,
                    'short_title' => $data['short_title'],
                    'heading' => $data['heading'],
                    'description' => $data['description'],
                    'about_sections' => $aboutSections
                ]
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error saving data'
            ])->setStatusCode(500);
        }
    }
    public function deleteMainIcon()
    {
        try {
            $record = $this->aboutModel->orderBy('id', 'DESC')->first();
            
            if (!$record) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Not found'])->setStatusCode(404);
            }

            if ($record['icon'] && file_exists(FCPATH . 'uploads/about/' . $record['icon'])) {
                unlink(FCPATH . 'uploads/about/' . $record['icon']);
            }

            $this->aboutModel->update($record['id'], ['icon' => null]);

            return $this->response->setJSON(['status' => 'success', 'message' => 'Icon deleted'])->setStatusCode(200);

        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error deleting'])->setStatusCode(500);
        }
    }
    public function deleteSectionIcon()
    {
        try {
            $sectionIndex = $this->request->getPost('section_index');
            
            if ($sectionIndex === null) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Index required'])->setStatusCode(400);
            }

            $record = $this->aboutModel->orderBy('id', 'DESC')->first();
            
            if (!$record) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Not found'])->setStatusCode(404);
            }

            $sections = json_decode($record['about_sections'], true) ?? [];
            
            if (!isset($sections[$sectionIndex])) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Section not found'])->setStatusCode(404);
            }

            if ($sections[$sectionIndex]['icon'] && file_exists(FCPATH . 'uploads/about/' . $sections[$sectionIndex]['icon'])) {
                unlink(FCPATH . 'uploads/about/' . $sections[$sectionIndex]['icon']);
            }

            $sections[$sectionIndex]['icon'] = null;

            $this->aboutModel->update($record['id'], ['about_sections' => json_encode($sections)]);

            return $this->response->setJSON(['status' => 'success', 'message' => 'Section icon deleted'])->setStatusCode(200);

        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error deleting'])->setStatusCode(500);
        }
    }

    // Product Strength
    public function productStrength()
    { 
        $builder = $this->db->table('product_strength');
        $data['record'] = $builder->orderBy('id', 'DESC')->limit(1)->get()->getRowArray();
        
        if ($data['record']) {
            $data['record']['cards'] = json_decode($data['record']['cards'], true) ?? [];
        }
        
        return view('admin/home/ourProducts', $data);
    }
    public function productStrengthSave()
    {
        $builder = $this->db->table('product_strength');
        $existingRecord = $builder->orderBy('id', 'DESC')->limit(1)->get()->getRowArray();
        
        $validationRules = [
            'page_image' => [
                'rules' => 'max_size[page_image,2048]|ext_in[page_image,png,jpg,jpeg,svg]',
                'errors' => [
                    'uploaded' => 'Page image is required',
                    'max_size' => 'Page image size must not exceed 2MB',
                    'ext_in' => 'Only PNG, JPG, JPEG, and SVG files are allowed'
                ]
            ],
            'heading' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        try {
            $uploadPath = FCPATH . 'uploads/product_strength';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $pageImageName = $existingRecord['page_image'] ?? null;

            // Handle page image upload
            $pageImageFile = $this->request->getFile('page_image');
            if ($pageImageFile && $pageImageFile->isValid() && !$pageImageFile->hasMoved()) {
                if ($pageImageName && file_exists($uploadPath . '/' . $pageImageName)) {
                    unlink($uploadPath . '/' . $pageImageName);
                }
                $pageImageName = $pageImageFile->getRandomName();
                $pageImageFile->move($uploadPath, $pageImageName);
            }

            // Handle cards
            $cards = [];
            $cardImages = $this->request->getFileMultiple('card_image');
            $cardHeadings = $this->request->getPost('card_heading');
            $cardDescriptions = $this->request->getPost('card_description');
            $existingCardImages = $this->request->getPost('existing_card_image') ?? [];

            if ($cardHeadings && $cardDescriptions) {
                foreach ($cardHeadings as $index => $heading) {
                    $cardImageName = $existingCardImages[$index] ?? null;
                    
                    if (isset($cardImages[$index]) && $cardImages[$index]->isValid() && !$cardImages[$index]->hasMoved()) {
                        if ($cardImageName && file_exists($uploadPath . '/' . $cardImageName)) {
                            unlink($uploadPath . '/' . $cardImageName);
                        }
                        $cardImageName = $cardImages[$index]->getRandomName();
                        $cardImages[$index]->move($uploadPath, $cardImageName);
                    }

                    $cards[] = [
                        'image' => $cardImageName,
                        'heading' => $heading,
                        'description' => $cardDescriptions[$index] ?? ''
                    ];
                }
            }

            // Prepare data
            $data = [
                'page_image' => $pageImageName,
                'heading' => $this->request->getPost('heading'),
                'cards' => json_encode($cards),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Insert or Update
            if ($existingRecord) {
                $builder->where('id', $existingRecord['id'])->update($data);
                $id = $existingRecord['id'];
                $message = 'Product strength updated successfully';
            } else {
                $data['created_at'] = date('Y-m-d H:i:s');
                $builder->insert($data);
                $id = $this->db->insertID();
                $message = 'Product strength created successfully';
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => $message,
                'data' => [
                    'id' => $id,
                    'page_image' => $pageImageName ? base_url('uploads/product_strength/' . $pageImageName) : null,
                    'heading' => $data['heading'],
                    'cards' => $cards
                ]
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            log_message('error', 'Error in save: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred while saving data',
                'error_details' => $e->getMessage()
            ])->setStatusCode(500);
        }
    } 
    public function productStrengthDeletePageImage()
    {
        try {
            $builder = $this->db->table('product_strength');
            $record = $builder->orderBy('id', 'DESC')->limit(1)->get()->getRowArray();
            
            if (!$record) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Record not found'
                ])->setStatusCode(404);
            }

            if ($record['page_image'] && file_exists(FCPATH . 'uploads/product_strength/' . $record['page_image'])) {
                unlink(FCPATH . 'uploads/product_strength/' . $record['page_image']);
            }

            $builder->where('id', $record['id'])->update(['page_image' => null, 'updated_at' => date('Y-m-d H:i:s')]);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Page image deleted successfully'
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred while deleting image'
            ])->setStatusCode(500);
        }
    } 
    public function productStrengthDeleteCardImage()
    {
        try {
            $cardIndex = $this->request->getPost('card_index');
            
            if ($cardIndex === null) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Card index is required'
                ])->setStatusCode(400);
            }

            $builder = $this->db->table('product_strength');
            $record = $builder->orderBy('id', 'DESC')->limit(1)->get()->getRowArray();
            
            if (!$record) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Record not found'
                ])->setStatusCode(404);
            }

            $cards = json_decode($record['cards'], true) ?? [];
            
            if (!isset($cards[$cardIndex])) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Card not found'
                ])->setStatusCode(404);
            }

            if ($cards[$cardIndex]['image'] && file_exists(FCPATH . 'uploads/product_strength/' . $cards[$cardIndex]['image'])) {
                unlink(FCPATH . 'uploads/product_strength/' . $cards[$cardIndex]['image']);
            }

            $cards[$cardIndex]['image'] = null;

            $builder->where('id', $record['id'])->update([
                'cards' => json_encode($cards),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Card image deleted successfully'
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred while deleting card image'
            ])->setStatusCode(500);
        }
    }  
    public function getProductStrenthJson()
    {
        try {
            $builder = $this->db->table('product_strength');
            $record = $builder->orderBy('id', 'DESC')->limit(1)->get()->getRowArray();
            
            if (!$record) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'No data found'
                ])->setStatusCode(404);
            }

            $cards = json_decode($record['cards'], true) ?? [];
            
            // Normalize cards data
            $normalizedCards = [];
            foreach ($cards as $card) {
                $normalizedCards[] = [
                    'image_url' => $card['image'] ? base_url('uploads/product_strength/' . $card['image']) : null,
                    'heading' => $card['heading'] ?? '',
                    'description' => $card['description'] ?? ''
                ];
            }

            return $this->response->setJSON([
                'status' => 'success',
                'data' => [
                    'id' => $record['id'],
                    'page_image_url' => $record['page_image'] ? base_url('uploads/product_strength/' . $record['page_image']) : null,
                    'heading' => $record['heading'],
                    'cards' => $normalizedCards,
                    'created_at' => $record['created_at'],
                    'updated_at' => $record['updated_at']
                ]
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            log_message('error', 'Error in getJson: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred while fetching data'
            ])->setStatusCode(500);
        }
    }

    // Testimonials
    public function testimonials()
    {
        $data['record'] = $this->testimonialModel->orderBy('id', 'DESC')->first();
        
        if ($data['record']) {
            $data['record']['cards'] = json_decode($data['record']['cards'], true) ?? [];
        }
        
        return view('admin/home/testimonials', $data);
    }
    public function saveTestimonial()
    {
        $existingRecord = $this->testimonialModel->orderBy('id', 'DESC')->first();

        // Validation - No required fields as per request, but good to validate uploads
        $validationRules = [
            'icon_image' => 'max_size[icon_image,2048]|ext_in[icon_image,png,jpg,jpeg,svg]',
            'title' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        try {
            $uploadPath = FCPATH . 'uploads/testimonials';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Handle Main Icon
            $iconType = $this->request->getPost('icon_type'); // 'class' or 'image'
            $iconClass = $this->request->getPost('icon_class');
            $iconImageFile = $this->request->getFile('icon_image');
            
            $finalIcon = $existingRecord['icon'] ?? null;

            if ($iconType === 'class') {
                // If switching to class, delete old image if exists and it wasn't a class
                if ($finalIcon && !str_starts_with($finalIcon, 'fa-') && file_exists($uploadPath . '/' . $finalIcon)) {
                     unlink($uploadPath . '/' . $finalIcon);
                }
                $finalIcon = $iconClass;
            } else {
                // Image type
                if ($iconImageFile && $iconImageFile->isValid() && !$iconImageFile->hasMoved()) {
                    // Delete old image if it exists and is not a class
                    if ($finalIcon && !str_starts_with($finalIcon, 'fa-') && file_exists($uploadPath . '/' . $finalIcon)) {
                        unlink($uploadPath . '/' . $finalIcon);
                    }
                    $finalIcon = $iconImageFile->getRandomName();
                    $iconImageFile->move($uploadPath, $finalIcon);
                }
            }

            // Handle Cards
            $cards = [];
            $cardHeadings = $this->request->getPost('card_heading');
            $cardDescriptions = $this->request->getPost('card_description');
            
            // Files
            $cardImages = $this->request->getFileMultiple('card_image');
            $cardProofImages = $this->request->getFileMultiple('card_proof_image');
            
            $existingCardImages = $this->request->getPost('existing_card_image') ?? [];
            $existingCardProofImages = $this->request->getPost('existing_card_proof_image') ?? [];

            if ($cardHeadings) {
                foreach ($cardHeadings as $index => $heading) {
                    // Card Image
                    $imgName = $existingCardImages[$index] ?? null;
                    if (isset($cardImages[$index]) && $cardImages[$index]->isValid() && !$cardImages[$index]->hasMoved()) {
                        if ($imgName && file_exists($uploadPath . '/' . $imgName)) {
                            unlink($uploadPath . '/' . $imgName);
                        }
                        $imgName = $cardImages[$index]->getRandomName();
                        $cardImages[$index]->move($uploadPath, $imgName);
                    }

                    // Proof Image
                    $proofName = $existingCardProofImages[$index] ?? null;
                    if (isset($cardProofImages[$index]) && $cardProofImages[$index]->isValid() && !$cardProofImages[$index]->hasMoved()) {
                        if ($proofName && file_exists($uploadPath . '/' . $proofName)) {
                            unlink($uploadPath . '/' . $proofName);
                        }
                        $proofName = $cardProofImages[$index]->getRandomName();
                        $cardProofImages[$index]->move($uploadPath, $proofName);
                    }

                    $cards[] = [
                        'image' => $imgName,
                        'heading' => $heading,
                        'description' => $cardDescriptions[$index] ?? '',
                        'proofImage' => $proofName
                    ];
                }
            }

            $data = [
                'icon' => $finalIcon,
                'title' => $this->request->getPost('title'),
                'cards' => json_encode($cards),
            ];

            if ($existingRecord) {
                $this->testimonialModel->update($existingRecord['id'], $data);
                $id = $existingRecord['id'];
                $message = 'Testimonial updated successfully';
            } else {
                $id = $this->testimonialModel->insert($data);
                $message = 'Testimonial created successfully';
            }

            // Prepare response data
            $isFA = $finalIcon && str_starts_with($finalIcon, 'fa-');
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => $message,
                'data' => [
                    'id' => $id,
                    'icon_url' => !$isFA && $finalIcon ? base_url('uploads/testimonials/' . $finalIcon) : null,
                    'icon_class' => $isFA ? $finalIcon : null,
                    'title' => $data['title'],
                    'cards' => $cards
                ]
            ])->setStatusCode(200);

        } catch (\Exception $e) {
             return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
    public function testimonialDeleteMainIcon()
    {
        try {
            $record = $this->testimonialModel->orderBy('id', 'DESC')->first();
            if (!$record) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Not found'])->setStatusCode(404);
            }

            if ($record['icon'] && !str_starts_with($record['icon'], 'fa-') && file_exists(FCPATH . 'uploads/testimonials/' . $record['icon'])) {
                unlink(FCPATH . 'uploads/testimonials/' . $record['icon']);
            }

            $this->testimonialModel->update($record['id'], ['icon' => null]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Icon deleted'])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error deleting'])->setStatusCode(500);
        }
    }
    public function testimonialDeleteCardImage()
    {
        try {
            $cardIndex = $this->request->getPost('card_index');
            $type = $this->request->getPost('type'); // 'image' or 'proofImage'

            if ($cardIndex === null || !$type) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid parameters'])->setStatusCode(400);
            }

            $record = $this->testimonialModel->orderBy('id', 'DESC')->first();
            if (!$record) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Not found'])->setStatusCode(404);
            }

            $cards = json_decode($record['cards'], true) ?? [];
            if (!isset($cards[$cardIndex])) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Card not found'])->setStatusCode(404);
            }

            $fileField = ($type === 'proofImage') ? 'proofImage' : 'image';
            $filename = $cards[$cardIndex][$fileField] ?? null;

            if ($filename && file_exists(FCPATH . 'uploads/testimonials/' . $filename)) {
                unlink(FCPATH . 'uploads/testimonials/' . $filename);
            }

            $cards[$cardIndex][$fileField] = null;
            
            $this->testimonialModel->update($record['id'], ['cards' => json_encode($cards)]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Image deleted'])->setStatusCode(200);

        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error deleting'])->setStatusCode(500);
        }
    }
    public function getTestimonialJson()
    {
        try {
            $record = $this->testimonialModel->orderBy('id', 'DESC')->first();
            if (!$record) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Not found'])->setStatusCode(404);
            }

            $cards = json_decode($record['cards'], true) ?? [];
            $normalizedCards = [];
            
            foreach ($cards as $card) {
                $normalizedCards[] = [
                    'image_url' => !empty($card['image']) ? base_url('uploads/testimonials/' . $card['image']) : null,
                    'heading' => $card['heading'] ?? '',
                    'description' => $card['description'] ?? '',
                    'proof_image_url' => !empty($card['proofImage']) ? base_url('uploads/testimonials/' . $card['proofImage']) : null,
                ];
            }

            $icon = $record['icon'];
            $isFA = $icon && str_starts_with($icon, 'fa-');

            return $this->response->setJSON([
                'status' => 'success',
                'data' => [
                    'id' => $record['id'],
                    'icon_url' => !$isFA && $icon ? base_url('uploads/testimonials/' . $icon) : null,
                    'icon_class' => $isFA ? $icon : null,
                    'title' => $record['title'],
                    'cards' => $normalizedCards,
                    'created_at' => $record['created_at'],
                    'updated_at' => $record['updated_at']
                ]
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error fetching data'])->setStatusCode(500);
        }
    }

    // Youtube Section
    public function youtube()
    {
        $data['record'] = $this->youtubeModel->orderBy('id', 'DESC')->first();
        
        if ($data['record']) {
            $data['record']['links'] = json_decode($data['record']['links'], true) ?? [];
        }
        
        return view('admin/home/youtube', $data);
    }

    public function saveYoutube()
    {
        $existingRecord = $this->youtubeModel->orderBy('id', 'DESC')->first();
        
        $links = $this->request->getPost('links');
        // Filter empty links
        $links = array_filter($links ?? [], function($link) {
            return !empty(trim($link));
        });
        // Re-index array
        $links = array_values($links);

        $data = [
            'heading' => $this->request->getPost('heading'),
            'links' => json_encode($links)
        ];

        if ($existingRecord) {
            $this->youtubeModel->update($existingRecord['id'], $data);
            $message = 'Youtube section updated successfully';
        } else {
            $this->youtubeModel->insert($data);
            $message = 'Youtube section created successfully';
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $message
        ])->setStatusCode(200);
    }

    public function getYoutubeJson()
    {
        try {
            $record = $this->youtubeModel->orderBy('id', 'DESC')->first();
            
            if (!$record) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Not found'
                ])->setStatusCode(404);
            }

            $links = json_decode($record['links'], true) ?? [];
            
            return $this->response->setJSON([
                'status' => 'success',
                'data' => [
                    'id' => $record['id'],
                    'heading' => $record['heading'],
                    'links' => $links,
                    'created_at' => $record['created_at'],
                    'updated_at' => $record['updated_at']
                ]
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error fetching data'])->setStatusCode(500);
        }
    }
}
