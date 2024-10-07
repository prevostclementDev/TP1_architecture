<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Profile extends Entity
{
    protected $attributes = [
        'type' => null
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
