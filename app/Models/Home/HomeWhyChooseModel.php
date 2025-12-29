<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class HomeWhyChooseModel extends Model
{
    protected $table = 'homewhychooseus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['heading', 'cards'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getData()
    {
        $data = $this->first();
        
        if ($data) {
            // Decode JSON cards
            $data['cards'] = json_decode($data['cards'], true) ?? [];
        } else {
            $data = [
                'heading' => '',
                'cards' => []
            ];
        }
        
        return $data;
    }

    public function saveData($heading, $cards)
    {
        $data = [
            'heading' => $heading,
            'cards' => json_encode($cards)
        ];

        $existing = $this->first();
        
        if ($existing) {
            return $this->update(1, $data);
        } else {
            return $this->insert($data);
        }
    }
}
