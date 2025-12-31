<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Home\OurClientModel;

class OurClientsApi extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new OurClientModel();
    }

    // 🔹 GET OUR CLIENTS SECTION
    public function index()
    {
        $record = $this->model->first();

        if (!$record) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'No data found',
                'data'    => null
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => [
                'id'          => (int)$record['id'],
                'short_title' => $record['short_title'],
                'heading'     => $record['heading'],
                'icon'        => $record['icon']
                    ? base_url($record['icon'])
                    : null,
                'cards'       => $this->formatCards($record['cards'])
            ]
        ]);
    }

    // 🔹 Format cards JSON
    private function formatCards($cards)
    {
        $cards = json_decode($cards, true) ?? [];

        $data = [];
        foreach ($cards as $card) {
            $data[] = [
                'id'          => $card['id'] ?? null,
                'icon'        => !empty($card['icon'])
                    ? base_url($card['icon'])
                    : null,
                'title'       => $card['aboutTitle'] ?? '',
                'description' => $card['aboutDescription'] ?? ''
            ];
        }

        return $data;
    }
}
