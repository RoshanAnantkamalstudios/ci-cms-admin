<?php

namespace App\Models\Grievances;

use CodeIgniter\Model;

class AntiRaggingModel extends Model
{
    protected $table = 'anti_ragging_data';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section_type',
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'background_image',
        'name',
        'designation',
        'email',
        'sort_order',
        'status'
    ];
    protected $useTimestamps = true;
}
