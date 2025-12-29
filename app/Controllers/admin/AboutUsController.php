<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AboutUsModel;
use CodeIgniter\HTTP\ResponseInterface;

class AboutUsController extends BaseController
{
    protected $db;
       public function __construct()
    { 
        $this->aboutUsModel = new AboutUsModel();
        $this->db = \Config\Database::connect();
    }
    protected $aboutUsModel;
    public function index()
    {
        //
    } 
    public function aboutUs()
    {
        $record = $this->aboutUsModel->orderBy('id', 'DESC')->first();
        
        if ($record) {
            $record['about_cards'] = json_decode($record['about_cards'], true) ?? [];
            $record['quality_cards'] = json_decode($record['quality_cards'], true) ?? [];
            $record['vision_cards'] = json_decode($record['vision_cards'], true) ?? [];
            $record['values_cards'] = json_decode($record['values_cards'], true) ?? [];
            $record['questions'] = json_decode($record['questions'], true) ?? [];
        }
        
        $data['record'] = $record;
        return view('admin/aboutUs', $data);
    }
    public function saveAboutUs()
    {
        $existingRecord = $this->aboutUsModel->orderBy('id', 'DESC')->first();
        
        $data = [
            'about_icon' => $this->request->getPost('about_icon'),
            'about_heading' => $this->request->getPost('about_heading'),
            'quality_bg_image' => $existingRecord['quality_bg_image'] ?? null,
            'quality_icon' => $this->request->getPost('quality_icon'),
            'quality_heading' => $this->request->getPost('quality_heading'),
            'values_image' => $existingRecord['values_image'] ?? null,
            'values_heading' => $this->request->getPost('values_heading'),
        ];

        // Handle Single Images
        $fileFields = ['quality_bg_image', 'values_image'];
        foreach ($fileFields as $field) {
            $file = $this->request->getFile($field);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/about_us', $newName);
                $data[$field] = $newName;
            }
        }

        // Helper to handle card arrays with images
        $processCards = function($prefix, $imageField = 'image') use ($existingRecord) {
            $cards = $this->request->getPost($prefix) ?? [];
            $processedCards = [];
            
            // Check if we have any cards
            if (!empty($cards)) {
                // Re-structure post array
                // The post data comes as array of arrays if named like name="about_cards[0][description]"
                // Or separate arrays like name="about_cards_description[]"
                // Assuming name="about_cards[index][field]" structure
                
                foreach ($cards as $index => $card) {
                    $processedCard = $card;
                    
                    // Handle Image
                    $file = $this->request->getFile("{$prefix}.{$index}.{$imageField}");
                    if ($file && $file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move('uploads/about_us', $newName);
                        $processedCard[$imageField] = $newName;
                    } else {
                        // Keep existing image if present in hidden field
                        $processedCard[$imageField] = $card["existing_{$imageField}"] ?? null;
                    }
                    
                    // Remove temporary fields
                    unset($processedCard["existing_{$imageField}"]);
                    
                    $processedCards[] = $processedCard;
                }
            }
            return json_encode(array_values($processedCards));
        };

        $data['about_cards'] = $processCards('about_cards');
        $data['quality_cards'] = $processCards('quality_cards');
        
        // Vision cards (icon is text/class, no image upload mentioned but "icon" usually implies class here as per prompt "icon - fontawesome")
        // Prompt says: "Vision & Mission Cards - [] - icon - card_name - description - textarea"
        // So no image upload for vision cards? "icon" usually FA.
        $data['vision_cards'] = json_encode(array_values($this->request->getPost('vision_cards') ?? []));

        $data['values_cards'] = $processCards('values_cards', 'value_image');
        $data['questions'] = $processCards('questions', 'question_image');

        if ($existingRecord) {
            $this->aboutUsModel->update($existingRecord['id'], $data);
            $message = 'About Us updated successfully';
        } else {
            $this->aboutUsModel->insert($data);
            $message = 'About Us created successfully';
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $message
        ])->setStatusCode(200);
    }
    public function getAboutUsJson()
    {
        try {
            $record = $this->aboutUsModel->orderBy('id', 'DESC')->first();
            
            if (!$record) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Not found'])->setStatusCode(404);
            }

            // Helper to format URLs
            $formatCards = function($json, $imageField = 'image') {
                $cards = json_decode($json, true) ?? [];
                foreach ($cards as &$card) {
                    if (!empty($card[$imageField])) {
                        $card[$imageField . '_url'] = base_url('uploads/about_us/' . $card[$imageField]);
                    }
                }
                return $cards;
            };

            $data = [
                'id' => $record['id'],
                'about' => [
                    'icon' => $record['about_icon'],
                    'heading' => $record['about_heading'],
                    'cards' => $formatCards($record['about_cards'])
                ],
                'quality' => [
                    'bg_image_url' => !empty($record['quality_bg_image']) ? base_url('uploads/about_us/' . $record['quality_bg_image']) : null,
                    'icon' => $record['quality_icon'],
                    'heading' => $record['quality_heading'],
                    'cards' => $formatCards($record['quality_cards'])
                ],
                'vision_mission' => json_decode($record['vision_cards'], true) ?? [],
                'values' => [
                    'image_url' => !empty($record['values_image']) ? base_url('uploads/about_us/' . $record['values_image']) : null,
                    'heading' => $record['values_heading'],
                    'cards' => $formatCards($record['values_cards'], 'value_image')
                ],
                'questions' => $formatCards($record['questions'], 'question_image'),
                'created_at' => $record['created_at'],
                'updated_at' => $record['updated_at']
            ];

            return $this->response->setJSON([
                'status' => 'success',
                'data' => $data
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error fetching data'])->setStatusCode(500);
        }
    }
}
