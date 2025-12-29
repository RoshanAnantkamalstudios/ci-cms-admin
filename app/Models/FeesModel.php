<?php

namespace App\Models;

use CodeIgniter\Model;

class FeesModel extends Model
{
    protected $table = 'fees_regulation';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'type',          
        'title',         
        'subtitle',      
        'banner_image',      
        'year',          
        'first_year_fee',
        'second_year_fee',
        'status',
        'meeting_date'
    ];

    protected $useTimestamps = true;
}
