<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contact_content';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'type',
        'title',
        'subtitle',
        'banner_image',
        'description',
        'extra_data',
        'name',
        'email',
        'subject',
        'message',
    ];
    protected $useTimestamps = true;
}
