<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class HomeWhyChooseModel extends Model
{
    protected $table = 'homewhychooseus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['heading', 'cards'];
    protected $useTimestamps = true;

    public function getData()
    {
        $row = $this->first();

        if ($row) {
            $row['cards'] = json_decode($row['cards'], true) ?? [];
            return $row;
        }

        return [
            'heading' => '',
            'cards' => []
        ];
    }

    public function saveData($heading, $cards)
    {
        $data = [
            'heading' => $heading,
            'cards' => json_encode($cards)
        ];

        $existing = $this->first();
        if ($existing) {
            return $this->update($existing['id'], $data);
        }

        return $this->insert($data);
    }
}
