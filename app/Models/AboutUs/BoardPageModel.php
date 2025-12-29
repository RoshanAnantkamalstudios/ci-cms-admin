<?php

namespace App\Models\AboutUs;

use CodeIgniter\Model;

class BoardPageModel extends Model
{
    protected $table = 'board_page';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'type',
        'title',
        'subtitle',
        'image',
        'name',
        'designation',
        'role',
        'message',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
