<?php

namespace App\Models\AboutUs;

use CodeIgniter\Model;

class VisionMissionModel extends Model
{
    protected $table = 'vision_mission';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'hero_heading',
        'hero_subheading',
        'hero_button_text',
        'hero_button_link',
        'hero_banner_image', 
        'section_heading',
        'section_subheading', 
        'belief_title',
        'belief_description',
        'belief_icon', 
        'vision_title',
        'vision_description',
        'vision_icon', 
        'mission_title',
        'mission_description',
        'mission_icon' 
    ];
}
