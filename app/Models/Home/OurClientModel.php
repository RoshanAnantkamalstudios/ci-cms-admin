<?php

namespace App\Models\Home;

use CodeIgniter\Model;

class OurClientModel extends Model
{
     protected $table = 'home_ourclients';
   protected $primaryKey = 'id';

    protected $allowedFields = [
        'icon',
        'short_title',
        'heading',
        'cards',
        'status'
    ];

    protected $useTimestamps = true;
}
