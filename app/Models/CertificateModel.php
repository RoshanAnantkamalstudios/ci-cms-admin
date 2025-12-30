<?php

namespace App\Models;
use CodeIgniter\Model;

class CertificateModel extends Model
{
    protected $table = 'cms_certificates';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'icon',
        'short_title',
        'heading',
        'description',
        'items'
    ];
}
